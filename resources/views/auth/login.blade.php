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
                    <h4 class="font-20 m-b-5">Bem Vindo !</h4>
                    <p class="text-white-50 mb-4">Coloque suas credenciais para continuar.</p>
                    <a href="index" class="logo logo-admin"><img src="{{ URL::asset('assets/images/logo-sm.png') }}" height="24" alt="logo"></a>
                </div>

                <div class="account-card-content"> 
                    <form class="form-horizontal m-t-20" action="{{route('loginWeb')}}" method="POST">
                      @csrf
                        <div class="form-group">
                            <label for="username">CPF</label>
                            <input type="text" class="form-control mask-doc" id="username" name='cpf' placeholder="CPF">
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Senha</label>
                            <input type="password" class="form-control" name='password' id="userpassword" placeholder="Senha">
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Salvar</label>
                                </div>
                            </div>

                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Entrar</button>
                            </div>
                        </div>

                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <a href="pages-recoverpw"><i class="mdi mdi-lock"></i> Esqueceu a senha?</a>
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
{{-- <script type="text/javascript">
  $(document).ready(function(){
      $('.date').mask('00/00/0000');
      $('.time').mask('00:00:00');
      $('.date_time').mask('00/00/0000 00:00:00');
      $('#cep').mask('00000-000');
      $('.phone').mask('0000-0000');
      $('.phone_with_ddd').mask('(00) 0000-0000');
      $('.phone_us').mask('(000) 000-0000');
      $('.mixed').mask('AAA 000-S0S');
      $('.cpf').mask('000.000.000-00', {reverse: true});
      $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
      $('.money').mask('000.000.000.000.000,00', {reverse: true});
      $('.money2').mask("#.##0,00", {reverse: true});
      $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
          translation: {
              'Z': {
                  pattern: /[0-9]/, optional: true
              }
          }
      });
      $('.ip_address').mask('099.099.099.099');
      $('.percent').mask('##0,00%', {reverse: true});
      $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
      $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
      $('.fallback').mask("00r00r0000", {
          translation: {
              'r': {
                  pattern: /[\/]/,
                  fallback: '/'
              },
              placeholder: "__/__/____"
          }
      });
      $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
  });
</script> --}}
@endsection