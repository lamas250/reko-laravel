<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Profiles Igor E Jose ADM
      $sistema_igor = DB::table('users')->where('name','Igor Lamas')->first();
      $sistema_jose = DB::table('users')->where('name','Jose Flavio')->first();
      $sistema_company = DB::table('companies')->where('company_name','SISTEMA')->first();
      $dev_role = DB::table('roles')->where('name','Desenvolvedor')->first();

      DB::table('user_has_profiles')->insert([
        'user_id' => $sistema_igor->id,
        'role_id' => $dev_role->id,
        'company_id' => $sistema_company->id
      ]);

      DB::table('user_has_profiles')->insert([
        'user_id' => $sistema_jose->id,
        'role_id' => $dev_role->id,
        'company_id' => $sistema_company->id
      ]);

      // MONTANDO PROFILE USER EXECUTORA
      $usuario_executor = DB::table('users')->where('name','Usuario Executor MG')->first();
      $empresa_executor = DB::table('companies')->where('company_name','Executora MG')->first();
      $role_executor = DB::table('roles')->where('name','Executor')->first();

      DB::table('user_has_profiles')->insert([
        'user_id' => $usuario_executor->id,
        'role_id' => $role_executor->id,
        'company_id' => $empresa_executor->id
      ]);

      // Profile secretaria
      $usuario_secretaria = DB::table('users')->where('name','Usuario Secretaria MG')->first();
      $empresa_secretaria = DB::table('companies')->where('company_name','Secretaria MG')->first();
      $role_secretaria = DB::table('roles')->where('name','Analista')->first();

      DB::table('user_has_profiles')->insert([
        'user_id' => $usuario_secretaria->id,
        'company_id' => $empresa_secretaria->id,
        'role_id' => $role_secretaria->id
      ]);
    }
}
