<?php

namespace App\Repositories\Implementation;

use App\Models\Transaction;
use App\Models\Room;
use App\Repositories\Interface\ReservationRepositoryInterface;
use Carbon\Carbon;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function getUnoccupiedRoom($request)
    {
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        
        return Room::with('type', 'roomStatus')
            ->where('capacity', '>=', $request->count_person)
            ->whereDoesntHave('transactions', function($query) use ($checkIn, $checkOut) {
                $query->where('status', '!=', 'Completed')
                      ->where(function($q) use ($checkIn, $checkOut) {
                          $q->where(function($inner) use ($checkIn, $checkOut) {
                              $inner->where('check_in', '<', $checkOut)
                                    ->where('check_out', '>', $checkIn);
                          });
                      });
            })
            ->when(!empty($request->sort_name), function ($query) use ($request) {
                $query->orderBy($request->sort_name, $request->sort_type);
            })
            ->orderBy('capacity')
            ->paginate(5);
    }

    public function countUnoccupiedRoom($request)
    {
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        
        return Room::where('capacity', '>=', $request->count_person)
            ->whereDoesntHave('transactions', function($query) use ($checkIn, $checkOut) {
                $query->where('status', '!=', 'Completed')
                      ->where(function($q) use ($checkIn, $checkOut) {
                          $q->where(function($inner) use ($checkIn, $checkOut) {
                              $inner->where('check_in', '<', $checkOut)
                                    ->where('check_out', '>', $checkIn);
                          });
                      });
            })
            ->count();
    }
}