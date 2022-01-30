<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $state_mg = DB::table('states')->where('letter','MG')->first();

      DB::table('companies')->insert([
        'company_name' => 'SISTEMA',
        'trading_name' => 'Sistema',
        'state_id' => $state_mg->id
      ]);

      DB::table('companies')->insert([
        'company_name' => 'Executora MG',
        'trading_name' => 'Exc MG',
        'state_id' => $state_mg->id
      ]);

      DB::table('companies')->insert([
        'company_name' => 'Secretaria MG',
        'trading_name' => 'Sec MG',
        'state_id' => $state_mg->id
      ]);

  }
}
