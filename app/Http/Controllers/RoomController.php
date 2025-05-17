<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Transaction;
use App\Models\Type;
use App\Models\ServicesH;
use App\Repositories\Interface\ImageRepositoryInterface;
use App\Repositories\Interface\RoomRepositoryInterface;
use App\Repositories\Interface\RoomStatusRepositoryInterface;
use App\Repositories\Interface\TypeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(
        private RoomRepositoryInterface $roomRepository,
        private TypeRepositoryInterface $typeRepository,
        private RoomStatusRepositoryInterface $roomStatusRepositoryInterface
    ) {
    }

    public function index(Request $request)
{
    if ($request->ajax()) {
        return $this->roomRepository->getRoomsDatatable($request);
    }

    $types = $this->typeRepository->getTypeList($request);
    $roomStatuses = $this->roomStatusRepositoryInterface->getRoomStatusList($request);
    $services = \App\Models\ServicesH::all(); 

    return view('room.index', [
        'types' => $types,
        'roomStatuses' => $roomStatuses,
        'services' => $services, 
    ]);
}

    public function create()
{
    $types = Type::all();
    $roomstatuses = RoomStatus::all();
    $services = ServicesH::all(); 
    
    $view = view('room.create', [
        'types' => $types,
        'roomstatuses' => $roomstatuses,
        'services' => $services, 
    ])->render();

    return response()->json([
        'view' => $view,
    ]);
}

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());

        return response()->json([
            'message' => 'Room '.$room->number.' created',
        ]);
    }

    public function show(Room $room)
    {
        $customer = [];
        $transaction = Transaction::where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()], ['room_id', $room->id]])->first();
        if (! empty($transaction)) {
            $customer = $transaction->customer;
        }

        return view('room.show', [
            'customer' => $customer,
            'room' => $room,
        ]);
    }

    public function edit(Room $room)
{
    $types = Type::all();
    $roomstatuses = RoomStatus::all();
    $services = ServicesH::all(); 
    
    $view = view('room.edit', [
        'room' => $room,
        'types' => $types,
        'roomstatuses' => $roomstatuses,
        'services' => $services, 
    ])->render();

    return response()->json([
        'view' => $view,
    ]);
}

    public function update(Room $room, StoreRoomRequest $request)
    {
        $room->update($request->all());

        return response()->json([
            'message' => 'Room '.$room->number.' udpated!',
        ]);
    }

    public function destroy(Room $room, ImageRepositoryInterface $imageRepository)
{
    try {
        $room->delete();

        $path = public_path('img/room/' . $room->number);

        if (is_dir($path)) {
            $imageRepository->destroy($path);
        }

        return response()->json([
            'message' => 'Room number ' . $room->number . ' deleted!',
        ]);
    } catch (\Exception $e) {
        $errorCode = $e->errorInfo[1] ?? 'unknown'; 
        return response()->json([
            'message' => 'Room number ' . $room->number . ' cannot be deleted! Error Code: ' . $errorCode,
        ], 500);
    }
}

}
