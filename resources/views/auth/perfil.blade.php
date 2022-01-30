@extends('layouts.master-blank')

@section('content')

        @auth('web')
        <div class="home-btn d-none d-sm-block">
            <a href="index" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div>
        @endauth

        <div class="wrapper-page">
            <div class="card overflow-hidden account-card mx-3">
                <div class="bg-primary p-4 text-white text-center position-relative">
                    <h4 class="font-20 m-b-5">Para continuar</h4>
                    <p class="text-white-50 mb-4">Favor selecionar um perfil.</p>
                    <a href="index" class="logo logo-admin"><img src="{{ URL::asset('assets/images/logo-sm.png') }}" height="24" alt="logo"></a>
                </div>

                <div class="account-card-content"> 
                    <form class="form-horizontal m-t-20" action="{{route('perfilWeb')}}" method="POST">
                      @csrf
                        <div class="form-group">
                            <label for="perfil">Perfil</label>
                            <select class="form-control" name='perfil' id='perfil'>
                              <option value="">Selecione ..</option>
                            </select>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif

                        <div class="form-group m-t-20" style="display: flex; justify-content: center;">

                            <div>
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Selecionar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="m-t-40 text-center">
                <p>Não tem conta ? <a href="pages-register" class="font-500 text-primary"> Entre em contato </a> </p>
                <p>© {{date('Y')}} Empresa. </p>
            </div>

        </div>
        <!-- end wrapper-page -->
@endsection

@section('script')
<script type="text/javascript">
  
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $.ajax({
      url: "/perfisUsuario",
      dataType: 'json',
      success:function(html){
        for(var i = 0; i< html.length;i++){
          $('#perfil').append('<option value="'+html[i]['profile_id']+'">'+html[i]['trading_name']+' | '+html[i]['name']+' </option>');
        }
        console.log(html);
      }
    })
  });
</script>
@endsection