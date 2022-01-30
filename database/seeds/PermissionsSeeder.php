<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projeto_module = DB::table('modules')->where('slug','projetos')->first();

        DB::table('permissions')->insert([
          'module_id' => $projeto_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $projeto_module->id,
          'name' => 'write'
        ]);
        
        DB::table('permissions')->insert([
          'module_id' => $projeto_module->id,
          'name' => 'delete'
        ]);

        $beneficiados_module = DB::table('modules')->where('slug','beneficiados')->first();

        DB::table('permissions')->insert([
          'module_id' => $beneficiados_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $beneficiados_module->id,
          'name' => 'write'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $beneficiados_module->id,
          'name' => 'delete'
        ]);

        $equipe_module = DB::table('modules')->where('slug','equipe-profissional')->first();

        DB::table('permissions')->insert([
          'module_id' => $equipe_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $equipe_module->id,
          'name' => 'write'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $equipe_module->id,
          'name' => 'delete'
        ]);

        $empresa_module = DB::table('modules')->where('slug','empresa')->first();

        DB::table('permissions')->insert([
          'module_id' => $empresa_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $empresa_module->id,
          'name' => 'write'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $empresa_module->id,
          'name' => 'delete'
        ]);

        $perfil_module = DB::table('modules')->where('slug','perfis')->first();

        DB::table('permissions')->insert([
          'module_id' => $perfil_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $perfil_module->id,
          'name' => 'write'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $perfil_module->id,
          'name' => 'delete'
        ]);

        $permissoes_module = DB::table('modules')->where('slug','permissoes')->first();

        DB::table('permissions')->insert([
          'module_id' => $permissoes_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $permissoes_module->id,
          'name' => 'write'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $permissoes_module->id,
          'name' => 'delete'
        ]);

        $acao_module = DB::table('modules')->where('slug','acao-esportiva')->first();

        DB::table('permissions')->insert([
          'module_id' => $acao_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $acao_module->id,
          'name' => 'write'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $acao_module->id,
          'name' => 'delete'
        ]);

        $evento_module = DB::table('modules')->where('slug','evento')->first();

        DB::table('permissions')->insert([
          'module_id' => $evento_module->id,
          'name' => 'read'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $evento_module->id,
          'name' => 'write'
        ]);

        DB::table('permissions')->insert([
          'module_id' => $evento_module->id,
          'name' => 'delete'
        ]);
    }
}
