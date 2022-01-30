<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
  public function login(Request $request)
  {
    $mensagens = [
      'cpf.required' => 'O campo CPF é obrigatório!',
      'password.required' => 'O campo Senha é obrigatório!',
    ];

    $rules = array(
      'cpf'             => 'required',                        
      'password'        => 'required',      
    );

    $validator = FacadesValidator::make($request->all(), $rules, $mensagens);

    if ($validator->fails()) {

      return redirect()->route('login')
          ->withErrors($validator);

    }
    
    try {
      $cpf = str_replace('-','',str_replace('.','',$request->cpf));
      $data = [
        'cpf' => $cpf,
        'password' => $request->password
      ];
      $credentials = $data;
      if (!auth()->attempt($credentials)) {
        return redirect()->route('login')->withErrors('Credenciais inválidas!');
      }

      return redirect()->route('perfil');
    } catch (\Throwable $th) {
      return redirect()->route('login')->withErrors('Falha no login, entre em contato');
    }
  }

  public function perfil(){
    return view('auth.perfil');
  }

  public function listProfiles(){
    $user = auth()->user();

    try {
      $profiles = DB::table('user_has_profiles')
        ->join('roles','roles.id','=','user_has_profiles.role_id')
        ->join('companies','companies.id','=','user_has_profiles.company_id')
        ->where('user_id', $user->id)
        ->select(['user_has_profiles.id as profile_id','roles.name','companies.trading_name'])
        ->get();

      return response()->json($profiles);
    } catch (\Throwable $th) {
      return response()->json('Falha ao listar profiles');
    }
  }

  public function setPerfil(Request $request){
    $user = auth()->user();
    
    if($request->perfil){
      $user = User::find($user->id);
      $user->profile_selected_id = $request->perfil;
      $user->save();

      $perfil = DB::table('user_has_profiles')
        ->join('roles','roles.id','=','user_has_profiles.role_id')
        ->join('companies', 'companies.id', '=', 'user_has_profiles.company_id')
        ->first();


      session()->put('perfil', $perfil);
    }

    return redirect()->route('index');
  }

  public function logout()
  {
    $user = User::find(auth()->user()->id);
    $user->profile_selected_id = null;
    $user->save();
    
    auth()->logout();

    if(auth()->user()){
      return response()->json(['message' => 'Falha ao deslogar']);
    }

     return redirect()->route('login');
  }

}
