<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ChooseRoomRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewRoomReservationDownPayment;
use App\Repositories\Interface\CustomerRepositoryInterface;
use App\Repositories\Interface\PaymentRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionRoomReservationController extends Controller
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository
    ) {
    }

    public function pickFromCustomer(Request $request, CustomerRepositoryInterface $customerRepository)
    {
        $customers = $customerRepository->get($request);
        $customersCount = $customerRepository->count($request);

        return view('transaction.reservation.pickFromCustomer', [
            'customers' => $customers,
            'customersCount' => $customersCount,
        ]);
    }

    public function createIdentity()
    {
        return view('transaction.reservation.createIdentity');
    }

    public function storeCustomer(StoreCustomerRequest $request, CustomerRepositoryInterface $customerRepository)
    {
        $customer = $customerRepository->store($request);

        return redirect()
            ->route('transaction.reservation.viewCountPerson', ['customer' => $customer->id])
            ->with('success', 'Customer '.$customer->name.' created!');
    }

    public function viewCountPerson(Customer $customer)
    {
        return view('transaction.reservation.viewCountPerson', [
            'customer' => $customer,
        ]);
    }

    public function chooseRoom(ChooseRoomRequest $request, Customer $customer)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);

        $rooms = $this->reservationRepository->getUnoccupiedRoom($request);
$roomsCount = $this->reservationRepository->countUnoccupiedRoom($request);


        return view('transaction.reservation.chooseRoom', [
            'customer' => $customer,
            'rooms' => $rooms,
            'stayFrom' => $stayFrom,
            'stayUntil' => $stayUntil,
            'roomsCount' => $roomsCount,
        ]);
    }

    public function confirmation(Customer $customer, Room $room, $stayFrom, $stayUntil)
    {
        $price = $room->price;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $downPayment = ($price * $dayDifference) * 0.15;

        return view('transaction.reservation.confirmation', [
            'customer' => $customer,
            'room' => $room,
            'stayFrom' => $stayFrom,
            'stayUntil' => $stayUntil,
            'downPayment' => $downPayment,
            'dayDifference' => $dayDifference,
        ]);
    }

    public function payDownPayment(
        Customer $customer,
        Room $room,
        Request $request,
        TransactionRepositoryInterface $transactionRepository,
        PaymentRepositoryInterface $paymentRepository
    ) {
        $dayDifference = Helper::getDateDifference($request->check_in, $request->check_out);
        $minimumDownPayment = ($room->price * $dayDifference) * 0.15;
    
        $request->validate([
            'downPayment' => 'required|numeric|gte:' . $minimumDownPayment,
        ]);
    
        // Check if room is available for the requested dates
        $isAvailable = !$room->transactions()
            ->where('status', '!=', 'Completed')
            ->where(function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('check_in', '<', $request->check_out)
                      ->where('check_out', '>', $request->check_in);
                });
            })
            ->exists();
    
        if (!$isAvailable) {
            return redirect()->back()
                ->with('failed', 'Room '.$room->number.' is not available for the selected dates');
        }
    
        // Process the transaction
        $transaction = $transactionRepository->store($request, $customer, $room);
        $status = 'Down Payment';
        $payment = $paymentRepository->store($request, $transaction, $status);
    
        // Notifications and events
        $superAdmins = User::where('role', 'Super')->get();
        foreach ($superAdmins as $superAdmin) {
            $message = 'Reservation added by ' . $customer->name;
            $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
        }
        

        return redirect()->route('transaction.index')
            ->with('success', 'Room ' . $room->number . ' has been reserved by ' . $customer->name);
    }
    
    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        return Transaction::where(function ($query) use ($stayFrom, $stayUntil) {
            $query->where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
                ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
                ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]]);
        })
        ->where('status', '!=', 'Completed') // Only consider active or pending reservations
        ->pluck('room_id');
    }
    
}
