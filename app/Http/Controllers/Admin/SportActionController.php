<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportActionController extends Controller
{
  public function list(Request $request){
    $perfil = session()->get('perfil');

    if($perfil->id){
      $projeto = DB::table('profile_has_projects')
        ->where('profile_id',$perfil->id)
        ->where('project_id', $request->projeto_id)
        ->first();
    }

    if($projeto){
      $acoes = DB::table('sports_actions')->where('project_id',$projeto->project_id)->get();
    }

    // return response()->json($projetos);
    if (request()->ajax()) {
      return datatables()->of($acoes)
        ->addColumn('ativo',function($data){
          if($data->active == 1){
            return '
              <div>
                <span class="badge badge-pill badge-info">Ativo</span>
              </div>
            ';
          }
          return '-';
        })
        ->addColumn('remover', function ($data) {
          return '
          <div role="group" aria-label="Basic example" class="btn-group btn-group-sm">
              <button class="btn btn-success" id="editar" data-id="' . $data->id . '" style="cursor: pointer;">Editar</button>
              <button class="btn btn-danger" id="remover" data-id="' . $data->id . '" style="cursor: pointer;">Remover</button>
          </div>
          ';
        })
        ->addColumn('acessar', function ($data) {
          return '
            <div role="group" aria-label="Basic example" class="btn-group btn-group-sm">
                <a href="' . route('acoes.show', $data->id) . '">
                  <button class="btn btn-sm btn-primary " style="cursor: pointer;">Acessar</button>
                </a>
            </div>
            ';
        })
        ->rawColumns(['remover', 'acessar','ativo'])
        ->make(true);
    }
  }


  public function show($id){
    $sportAction = DB::table('sports_actions')->where('id', $id)->first();
    $projeto = Project::where('id', $sportAction->project_id)->first();

    return view('admin.projetos.acoesEsportivas.index', compact('sportAction','projeto'));
  }

}
