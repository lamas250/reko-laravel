<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventosController extends Controller
{
  public function list(Request $request){
      // $perfil = session()->get('perfil');

      // if($perfil->id){
      //   $projeto = DB::table('sports_actions')
      //     ->join('projects','projects.id','=','sports_actions.project_id')
      //     ->where('sports_actions.id',$request->acao_id)
      //     ->select('projects.id')
      //     ->first();
      // }
    $eventos = DB::table('events')->where('sport_action_id',$request->acao_id)->get();
      

      // return response()->json($projetos);
      if (request()->ajax()) {
        return datatables()->of($eventos)
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
          ->rawColumns(['remover', 'acessar'])
          ->make(true);
      }
    }

}
