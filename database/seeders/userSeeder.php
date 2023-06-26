<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
			'number_id' => '1007192405',
			'name' => 'Jarol',
			'last_name' => 'Vidal',
            'address'=>'Kr 15 #8-31',
            'cellphone'=>'3192540642',
			'email' => 'jarol.vidal@utp.edu.co',
			'password' => bcrypt(12345678),
		]);
    }
}
