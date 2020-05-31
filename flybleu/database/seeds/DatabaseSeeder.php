<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AirportDatabaseSeeder::class);
        $this->call(FlightDatabaseSeeder::class);
        $this->call(SeatDatabaseSeeder::class);
        $this->call(LuggageDatabaseSeeder::class);
    }
}
class AirportDatabaseSeeder extends Seeder{
    public function run(){
        DB::table('airport')->insert([
            ['name_airport'=>'Tân Sơn Nhất'],
            ['name_airport'=>'Nội Bài'],
            ['name_airport'=>'Đà Nẵng'],
            ['name_airport'=>'Vinh'],
            ['name_airport'=>'Buôn Ma Thuột']
        ]);
    }
}
class FlightDatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('flight')->insert([
            [
                'id_start_airport' => '1',
                'id_end_airport' => '2',
                'price_flight' => '1000000',
                'departure_date' => '2020-06-15',
                'departure_time' => '9:30'
            ],
            [
                'id_start_airport' => '2',
                'id_end_airport' => '1',
                'price_flight' => '1000000',
                'departure_date' => '2020-06-22',
                'departure_time' => '21:00'
            ],
        ]);
    }
}
class SeatDatabaseSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 2; $i++) {
            for ($j = 1; $j <= 30; $j++) {
                DB::table('seat')->insert([
                    [
                        'id_flight' => $i,
                        'id_seat_inline' => $j,
                        'status' => '0',
                    ],
                ]);
            }
        }
    }
}
class LuggageDatabaseSeeder extends Seeder{
    public function run(){
        DB::table('luggage')->insert([
            [
                'weight' => '15',
                'price_luggage' => '140000'
            ],
            [
                'weight' => '20',
                'price_luggage' => '160000'
            ],
            [
                'weight' => '25',
                'price_luggage' => '220000'
            ],
            [
                'weight' => '30',
                'price_luggage' => '320000'
            ],
            [
                'weight' => '35',
                'price_luggage' => '370000'
            ],
            [
                'weight' => '40',
                'price_luggage' => '420000'
            ],
        ]);
    }
}
