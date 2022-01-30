<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Tabela ROLES Perfis
      DB::table('roles')->insert([
        'name' => 'Desenvolvedor',
        'slug' => Str::slug('Desenvolvedor','-')
      ]);

      DB::table('roles')->insert([
        'name' => 'Sistema',
        'slug' => Str::slug('Sistema','-')
      ]);

      DB::table('roles')->insert([
        'name' => 'Analista',
        'slug' => Str::slug('Analista','-')
      ]);

      DB::table('roles')->insert([
        'name' => 'Executor',
        'slug' => Str::slug('Executor','-')
      ]);

      DB::table('roles')->insert([
        'name' => 'Coordenador Esportivo',
        'slug' => Str::slug('Coordenador Esportivo','-')
      ]);

      // Tabela tipos e subtipos para usar em modulos
      DB::table('types')->insert([
        'name' => 'Tipo Acesso Modulo'
      ]);

      $type_access_module = DB::table('types')->where('name','Tipo Acesso Modulo')->first();

      DB::table('subtypes')->insert([
        'name' => 'Menu Sidebar',
        'type_id' => $type_access_module->id
      ]);

      DB::table('subtypes')->insert([
        'name' => 'Rota',
        'type_id' => $type_access_module->id
      ]);

      $menu_access = DB::table('subtypes')->where('name','Menu Sidebar')->first();
      $rota_access = DB::table('subtypes')->where('name','Rota')->first();

      // Tablea de Modulos
      DB::table('modules')->insert([
        'name' => 'Projetos',
        'icon' => 'ti-home',
        'slug' => Str::slug('Projetos','-'),
        'uri' => '/projetos',
        'module_type' => $menu_access->id
      ]);

      DB::table('modules')->insert([
        'name' => 'Beneficiados',
        'icon' => 'ti-home',
        'slug' => Str::slug('Beneficiados','-'),
        'uri' => '/beneficiados',
        'module_type' => $menu_access->id
      ]);

      DB::table('modules')->insert([
        'name' => 'Equipe Profissional',
        'icon' => 'ti-home',
        'slug' => Str::slug('Equipe Profissional','-'),
        'uri' => '/equipe',
        'module_type' => $menu_access->id
      ]);

      DB::table('modules')->insert([
        'name' => 'Empresa',
        'icon' => 'ti-home',
        'slug' => Str::slug('Empresa','-'),
        'uri' => '/empresa',
        'module_type' => $menu_access->id
      ]);

      DB::table('modules')->insert([
        'name' => 'Perfis',
        'icon' => 'ti-home',
        'slug' => Str::slug('Perfis','-'),
        'uri' => '/perfis',
        'module_type' => $menu_access->id
      ]);

      DB::table('modules')->insert([
        'name' => 'Permissões',
        'icon' => 'ti-home',
        'slug' => Str::slug('Permissões','-'),
        'uri' => '/permissoes',
        'module_type' => $menu_access->id
      ]);

      DB::table('modules')->insert([
        'name' => 'Ação Esportiva',
        'icon' => 'ti-home',
        'slug' => Str::slug('Ação Esportiva','-'),
        'uri' => '/acao-esportiva',
        'module_type' => $rota_access->id
      ]);

      DB::table('modules')->insert([
        'name' => 'Evento',
        'icon' => 'ti-home',
        'slug' => Str::slug('Evento','-'),
        'uri' => '/evento',
        'module_type' => $rota_access->id
      ]);
    }
}
