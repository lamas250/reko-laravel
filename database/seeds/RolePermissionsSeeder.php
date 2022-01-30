<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Permissoes perfil Dev
        $allPermissions = DB::table('permissions')->get();
        $dev_role = DB::table('roles')->where('slug','desenvolvedor')->first();

        foreach($allPermissions as $p){
          DB::table('role_has_permissions')->insert([
            'role_id' => $dev_role->id,
            'permission_id' => $p->id
          ]);
        }

        // Permissoes perfil analista
        $analista_role = DB::table('roles')->where('slug','analista')->first();
        $analista_modulos = ['projetos','beneficiados','equipe-profissional','empresa','acao-esportiva','evento'];
        $analista_modulos_collection = DB::table('modules')->whereIn('slug',$analista_modulos)->get();
        $array_analista_modules_ids = [];
        foreach($analista_modulos_collection as $item){
          $array_analista_modules_ids[] = $item->id;
        }

        $analistaPermissions = DB::table('permissions')->whereIn('module_id',$array_analista_modules_ids)->where('name','read')->get();
        foreach($analistaPermissions as $p){
          DB::table('role_has_permissions')->insert([
            'role_id' => $analista_role->id,
            'permission_id' => $p->id
          ]);
        }

        // Permissoes Executor 
        $executor_role = DB::table('roles')->where('slug','executor')->first();
        $executor_modulos = ['projetos','beneficiados','equipe-profissional','empresa','acao-esportiva','evento'];
        $executor_modulos_collection = DB::table('modules')->whereIn('slug',$executor_modulos)->get();
        $array_executor_modules_ids = [];
        foreach($executor_modulos_collection as $item){
          $array_executor_modules_ids[] = $item->id;
        }

        $executorPermissions = DB::table('permissions')->whereIn('module_id',$array_executor_modules_ids)->get();
        foreach($executorPermissions as $p){
          DB::table('role_has_permissions')->insert([
            'role_id' => $executor_role->id,
            'permission_id' => $p->id
          ]);
        }


    }
}
