@extends('layouts.master')

@section('css')

@endsection

@section('breadcrumb')
<div class="col-sm-6">
     <h4 class="page-title">{{$projeto->name}}</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Código projeto: {{$projeto->code_name}}</li>
     </ol>
</div>
@endsection

@section('content')
  <input id='projeto_id' type="hidden" value="{{$projeto->id}}" />
  <div class="row">
    <div class="card" style="width: 100%">
      <div class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
              <li class="nav-item">

              </li>
              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#aulas" role="tab" id="aulastab">
                      <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                      <span class="d-none d-sm-block">Ações Esportivas</span> 
                  </a>
              </li>
              <li class="nav-item">

              </li>
              <li class="nav-item">

              </li>
          </ul>

          <!-- Tab PRIMARIA -->
          <div class="tab-content">
              <div class="tab-pane p-3 active" id="aulas" role="tabpanel">

                {{-- INICIO TAB SECUNDARIA --}}
                  <p class="page-title">Gestão da ação esportiva: {{$sportAction->name}}</p>
                    <ul class="nav nav-pills nav-justified" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#eventos" role="tab" id="eventosTab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Eventos</span> 
                        </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#integrantes" role="tab" id="integrantesTab">
                              <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                              <span class="d-none d-sm-block">Integrantes</span> 
                          </a>
                      </li>
                      {{-- <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#calendario" role="tab" id="calendarioTab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Calendário</span> 
                        </a>
                      </li> --}}
                  </ul>
        
                  <!-- Tab panes -->
                  <div class="tab-content">
                      <div class="tab-pane p-3" id="eventos" role="tabpanel">
                        @include('admin.projetos.acoesEsportivas.tabs.eventos')
                      </div>
                      <div class="tab-pane p-3" id="integrantes" role="tabpanel">
                        @include('admin.projetos.acoesEsportivas.tabs.integrantes')
                      </div>
                      {{-- <div class="tab-pane p-3" id="calendario" role="tabpanel">
                        @include('admin.projetos.acoesEsportivas.tabs.calendario')
                      </div> --}}
                  </div>
                  {{-- FIM TAB SECUNDARIA --}}

              </div>
          </div>

      </div>
  </div>     
  </div>
  <!-- end row -->

  
@endsection

@section('script')
<script>

$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab',function(e){
      localStorage.setItem('Reko#acaoTab', $(e.target).attr('href'));
    })

    var activeTab = localStorage.getItem('Reko#acaoTab');
    console.log(activeTab);
    if(activeTab === '#eventos'){
         $("#eventos").addClass('active');
         $('#eventosTab').addClass('active ');
         $('#integrantes').removeClass('active ')
         $('#integrantesTab').removeClass('active');
    }

    if(activeTab === '#integrantes'){
        $("#eventos").removeClass('active');
         $('#eventosTab').removeClass('active ');
         $('#integrantes').addClass('active ')
         $('#integrantesTab').addClass('active');
    }

  })

</script>

<script src="{{ URL::asset('js/app/projetos/acoesEsportivas/eventos/index.js') }}"></script>

<script src="{{ URL::asset('assets/pages/datatables.init.js') }}"></script>  
@endsection