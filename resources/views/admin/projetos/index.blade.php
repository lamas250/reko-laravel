@extends('layouts.master')

@section('css')

@endsection

@section('breadcrumb')
<div class="col-sm-6">
     <h4 class="page-title">Meus Projetos</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Página para comunicados e informações</li>
     </ol>
</div>
@endsection

@section('botoes')
 
  <button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="modal" data-target=".create-modal">
      <i class="mdi mdi-plus mr-2"></i> Criar Projeto
  </button>

@endsection

@section('content')
@include('admin.projetos.modal.create')
@include('./../../layouts/mensagens')
<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <thead>
  <tr>
      <th>Código</th>
      <th>Nome</th>
      <th>Início</th>
      <th style="width: 14%">Acessar</th>
      <th style="width: 11%">Ações</th>
  </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="8">Nenhum registro encontrado.</td>
    </tr>
  </tbody>

</table>

  
@endsection

@section('script')

<script>
   $('#valuepoints').keyup(function () {
        if (!this.value.match(/^(\d|-)+$/)) {
            this.value = this.value.replace(/[^0-9-.\/]/g, '');
        }
    });
    
</script>
<script src="{{ URL::asset('js/app/projetos/index.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/pages/datatables.init.js') }}"></script>  
@endsection