<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // User Seeder
      DB::table('users')->insert([
        'name' => 'Igor Lamas',
        'email' => 'igor@reko.com',
        'password' => bcrypt('123456'),
        'cpf' => '11845242629',
      ]);

      DB::table('users')->insert([
        'name' => 'Jose Flavio',
        'email' => 'jose@reko.com',
        'password' => bcrypt('123456'),
        'cpf' => '22245242629',
      ]);

      DB::table('users')->insert([
        'name' => 'Usuario Secretaria MG',
        'email' => 'secretariamg@reko.com',
        'password' => bcrypt('123456'),
        'cpf' => '33345242629',
      ]);

      DB::table('users')->insert([
        'name' => 'Usuario Executor MG',
        'email' => 'executormg@reko.com',
        'password' => bcrypt('123456'),
        'cpf' => '44445242629',
      ]);

    }
}
