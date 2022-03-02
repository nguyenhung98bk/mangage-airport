<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(AirportDatabaseSeeder::class);
        $this->call(FlightDatabaseSeeder::class);
        $this->call(SeatDatabaseSeeder::class);
        $this->call(LuggageDatabaseSeeder::class);
        $this->call(UserDatabaseSeeder::class);
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
                'id_start_airport' => '3',
                'id_end_airport' => '4',
                'price_flight' => '1200000',
                'departure_date' => '2022-03-1',
                'departure_time' => '10:00'
            ],
            [
                'id_start_airport' => '1',
                'id_end_airport' => '2',
                'price_flight' => '1000000',
                'departure_date' => '2022-03-15',
                'departure_time' => '9:30'
            ],
            [
                'id_start_airport' => '2',
                'id_end_airport' => '1',
                'price_flight' => '1000000',
                'departure_date' => '2022-03-22',
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
class UserDatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
           [
               'name' => 'Admin',
               'email' => 'admin@flybleu.com.vn',
               'password' => bcrypt('123456'),
               'type_user' => '0',
           ],
        ]);
    }
}
