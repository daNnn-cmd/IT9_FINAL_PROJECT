<?php

namespace Database\Seeders;

use App\Models\RoomStatus;
use Illuminate\Database\Seeder;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Vacant',
            'Occupied',
        ];

        $codes = [
            'V',
            'O',
        ];

        $informations = [
            'Vacant Room.',
            'Occupied',
        ];

        for ($i = 0; $i < count($codes); $i++) {
            RoomStatus::create([
                'name' => $names[$i],
                'code' => $codes[$i],
                'information' => $informations[$i],
            ]);
        }

        // In your database seeder
RoomStatus::create(['name' => 'Occupied', 'description' => 'Room is currently occupied by a guest']);
    }
}
