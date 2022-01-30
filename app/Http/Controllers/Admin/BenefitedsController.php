<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class BenefitedsController extends Controller
{
  public function list(Request $request){
    $projeto = DB::table('project_has_benefiteds')
      ->join('benefiteds','benefiteds.id','=','project_has_benefiteds.benefited_id')
      ->where('project_id', $request->projeto_id)->get();

  
    dd($projeto);

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
