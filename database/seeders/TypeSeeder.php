<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Standard Room', 'information' => 'As the name suggests, the Standard Room is the most basic type of hotel room...'],
            ['name' => 'Superior Room', 'information' => 'Essentially, a Superior Room is slightly better than a Standard Room...'],
            ['name' => 'Deluxe Room', 'information' => 'A step above the Superior Room is the Deluxe Room...'],
            ['name' => 'Suite Room', 'information' => 'The Suite Room is a tier above the Junior Suite...'],
            ['name' => 'Presidential Suite', 'information' => 'The Presidential Suite is the best and most expensive type of hotel room...'],
            ['name' => 'Single Room', 'information' => 'The Single Room is the most common hotel room type...'],
            ['name' => 'Double Room', 'information' => 'Want a more comfortable stay with better facilities? You can book a Double Room...'],
            ['name' => 'Family Room', 'information' => 'Traveling with a large family or group of friends? The Family Room is a great choice...'],
            ['name' => 'Connecting Room', 'information' => 'The Connecting Room is ideal for those traveling with family...'],
            ['name' => 'Accessible Room', 'information' => 'This room type is designed for guests with disabilities...'],
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
