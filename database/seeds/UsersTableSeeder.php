<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'I Wayan Andika Pranayoga',
            'username' => 'andika',
            'password' => hash::make('nekopanda'),
            'hak_akses' => 'super admin',
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
