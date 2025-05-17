<?php

// app/Console/Commands/UpdateRoomStatuses.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Transaction;
use Carbon\Carbon;

class UpdateRoomStatuses extends Command
{
    protected $signature = 'rooms:update-statuses';
    protected $description = 'Update room statuses based on current reservations';

    public function handle()
    {
        $occupiedStatus = RoomStatus::where('name', 'Occupied')->first();
        $availableStatus = RoomStatus::where('name', 'Available')->first();
        
        if (!$occupiedStatus || !$availableStatus) {
            $this->error('Required room statuses not found!');
            return;
        }

        // Get all rooms with active transactions
        $occupiedRoomIds = Transaction::where('check_in', '<=', Carbon::now())
            ->where('check_out', '>=', Carbon::now())
            ->pluck('room_id')
            ->unique()
            ->toArray();

        // Update occupied rooms
        Room::whereIn('id', $occupiedRoomIds)
            ->where('room_status_id', '!=', $occupiedStatus->id)
            ->update(['room_status_id' => $occupiedStatus->id]);

        // Update available rooms
        Room::whereNotIn('id', $occupiedRoomIds)
            ->where('room_status_id', '!=', $availableStatus->id)
            ->update(['room_status_id' => $availableStatus->id]);

        $this->info('Room statuses updated successfully.');
    }
}
