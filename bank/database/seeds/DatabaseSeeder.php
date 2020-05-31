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
        DB::table('card')->insert([
            [
                'name_customer'=> 'Nguyễn Việt Hưng',
                'code_card' => '123456789',
                'password' => '123456',
                'balance' => '500000000'
            ],
        ]);
    }
}
