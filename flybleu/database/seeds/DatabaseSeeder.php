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
            [
                'id_start_airport' => '4',
                'id_end_airport' => '3',
                'price_flight' => '1200000',
                'departure_date' => '2022-03-25',
                'departure_time' => '12:00'
            ],
            [
                'id_start_airport' => '4',
                'id_end_airport' => '5',
                'price_flight' => '1100000',
                'departure_date' => '2022-03-22',
                'departure_time' => '10:00'
            ],
            [
                'id_start_airport' => '2',
                'id_end_airport' => '1',
                'price_flight' => '1000000',
                'departure_date' => '2022-03-17',
                'departure_time' => '10:00'
            ],
            [
                'id_start_airport' => '5',
                'id_end_airport' => '1',
                'price_flight' => '1200000',
                'departure_date' => '2022-03-13',
                'departure_time' => '22:00'
            ],
            [
                'id_start_airport' => '2',
                'id_end_airport' => '4',
                'price_flight' => '1200000',
                'departure_date' => '2022-03-17',
                'departure_time' => '19:00'
            ],
        ]);
    }
}
class SeatDatabaseSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 8; $i++) {
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
            [
                'name' => 'Khách hàng 1',
                'email' => 'kh1@gmail.com.vn',
                'password' => bcrypt('123456'),
                'type_user' => '2',
            ],
            [
                'name' => 'Khách hàng 2',
                'email' => 'kh2@gmail.com.vn',
                'password' => bcrypt('123456'),
                'type_user' => '2',
            ],
            [
                'name' => 'Khách hàng 3',
                'email' => 'kh3@gmail.com.vn',
                'password' => bcrypt('123456'),
                'type_user' => '2',
            ],
            [
                'name' => 'Khách 1',
                'email' => 'k1@gmail.com.vn',
                'password' => bcrypt('123456'),
                'type_user' => '2',
            ],
            [
                'name' => 'Khách 2',
                'email' => 'k2@gmail.com.vn',
                'password' => bcrypt('123456'),
                'type_user' => '2',
            ],
            [
                'name' => 'Khách 3',
                'email' => 'k3@gmail.com.vn',
                'password' => bcrypt('123456'),
                'type_user' => '2',
            ],
            [
                'name' => 'Khách hàng 4',
                'email' => 'kh4@gmail.com.vn',
                'password' => bcrypt('123456'),
                'type_user' => '2',
            ],
        ]);
    }
}
