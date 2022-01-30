<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProjetosController extends Controller
{
  
    public function index(){

      return view('admin.projetos.index');
    }

    public function projetosListar(Request $request){
      $perfil = session()->get('perfil');

      if($perfil->id){
        $projetos = DB::table('profile_has_projects')
          ->join('projects', 'projects.id','=','profile_has_projects.project_id' )
          ->get();
      }

      // return response()->json($projetos);
      if (request()->ajax()) {
        return datatables()->of($projetos)
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
                  <a href="' . route('projetos.acessar', $data->id) . '">
                    <button class="btn btn-sm btn-primary " style="cursor: pointer;">Acessar</button>
                  </a>
              </div>
              ';
          })
          ->rawColumns(['remover', 'acessar'])
          ->make(true);
      }
    }

    public function store(Request $request){
      $mensagens = [
        'project_name.required' => 'O campo Nome do Projeto é obrigatório!',
        'project_code.required' => 'O campo Codigo do Projeto é obrigatório!',
        'start_date.required' => 'O campo Data de início é obrigatório!',
      ];
  
      $rules = array(
        'project_name'             => 'required',                        
        'project_code'        => 'required',  
        'start_date'        => 'required',     
      );

      $validator = Validator::make($request->all(), $rules, $mensagens);

      if ($validator->fails()) {
        $messages = $validator->customMessages;


        return Response::json(array(
            'code'      =>  422,
            'message'   =>  $messages
        ), 422);
  
      }

      try {
        $projeto = new Project();
        $projeto->name = $request->project_name;
        $projeto->code_name = $request->project_code;
        $projeto->code_slug = (int) filter_var($request->project_code, FILTER_SANITIZE_NUMBER_INT);;
        $projeto->company_id = session()->get('perfil')->company_id;
        $projeto->start_date = $request->start_date;
        $projeto->save();

        DB::table('profile_has_projects')->insert([
          'profile_id' => session()->get('perfil')->id,
          'project_id' => $projeto->id
        ]);
  
        return Response::json(array(
            'code'      =>  200,
            'message'   =>  'Salvo com sucesso'
        ), 200);
      } catch (\Throwable $th) {
        return Response::json(array(
            'code'      =>  500,
            'message'   =>  $th
        ), 500);
      }

    }


    public function acessar($id){
      $projeto = Project::find($id);

      return view('admin.projetos.show', compact('projeto'));
    }
}
