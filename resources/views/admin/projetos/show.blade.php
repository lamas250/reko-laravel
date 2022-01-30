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
                  <a class="nav-link" data-toggle="tab" href="#informacoes" role="tab" id="informacoestab">
                      <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                      <span class="d-none d-sm-block">Informações</span> 
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#aulas" role="tab" id="aulastab">
                      <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                      <span class="d-none d-sm-block">Ações Esportivas</span> 
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#beneficiados" role="tab" id="beneficiadostab">
                      <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                      <span class="d-none d-sm-block">Beneficiados</span>   
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#colaboradores" role="tab" id="colaboradorestab">
                      <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                      <span class="d-none d-sm-block">Colaboradores</span>    
                  </a>
              </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
              <div class="tab-pane p-3" id="informacoes" role="tabpanel">
                 @include('admin.projetos.showTabs.informacoes')
              </div>
              <div class="tab-pane p-3" id="aulas" role="tabpanel">
                @include('admin.projetos.showTabs.aulas')
              </div>
              <div class="tab-pane p-3" id="beneficiados" role="tabpanel">
                @include('admin.projetos.showTabs.beneficiados')
              </div>
              <div class="tab-pane p-3" id="colaborados" role="tabpanel">
                @include('admin.projetos.showTabs.colaboradores')
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
      localStorage.setItem('Reko#projectTab', $(e.target).attr('href'));
    })

    var activeTab = localStorage.getItem('Reko#projectTab');
    console.log(activeTab);
    if(activeTab === '#informacoes'){
         $("#informacoestab").addClass('active');
         $('#informacoes').addClass('active ');
         $('#beneficiados').removeClass('active ')
         $('#beneficiadostab').removeClass('active');
         $('#aulastab').removeClass('active ')
         $('#aulas').removeClass('active');
         $('#colaboradores').removeClass('active ')
         $('#colaboradorestab').removeClass('active');
    }

    if(activeTab === '#aulas'){
        $("#informacoestab").removeClass('active');
         $('#informacoes').removeClass('active ');
         $('#beneficiados').removeClass('active ')
         $('#beneficiadostab').removeClass('active');
         $('#aulastab').addClass('active ')
         $('#aulas').addClass('active');
         $('#colaboradores').removeClass('active ')
         $('#colaboradorestab').removeClass('active');
    }

    if(activeTab === '#beneficiados'){
         $("#informacoestab").removeClass('active');
         $('#informacoes').removeClass('active ');
         $('#beneficiados').addClass('active ')
         $('#beneficiadostab').addClass('active');
         $('#aulastab').removeClass('active ')
         $('#aulas').removeClass('active');
         $('#colaboradores').removeClass('active ')
         $('#colaboradorestab').removeClass('active');
    }

    if(activeTab === '#colaboradores'){
         $("#informacoestab").removeClass('active');
         $('#informacoes').removeClass('active ');
         $('#beneficiados').removeClass('active ')
         $('#beneficiadostabs').removeClass('active');
         $('#aulastab').removeClass('active ')
         $('#aulas').removeClass('active');
         $('#colaboradores').addClass('active ')
         $('#colaboradorestab').addClass('active');
    }
  })

</script>

<script src="{{ URL::asset('js/app/projetos/tabs/aulas.js') }}"></script>

<script src="{{ URL::asset('assets/pages/datatables.init.js') }}"></script>  
@endsection