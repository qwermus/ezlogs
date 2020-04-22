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
        DB::table('users')->insert([
            'name' => 'Руководитель Директорович',
            'email' => 'admin@crm.by',
            'password' => Hash::make('admin'),
            'api_token' => Str::random(60),
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);
    }
}
