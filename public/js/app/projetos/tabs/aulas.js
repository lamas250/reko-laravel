
let projeto_id = $('#projeto_id').val();
var url ="{{ route('acoes.list') }}";

$(document).ready(function(){
  var dataTable = $('.datatableAulas').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: false,
    pageLength: 10,
    ajax: {
      type: 'post',
      url: '/acoes-esportivas/list',
      data: {
        projeto_id
      },
      headers : {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
    language: {
      url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
    },
    columns: [
        {data: 'name', name: 'name'}, 
        {data: 'description', name: 'description'},
        {data: 'local', name: 'local'},
        {data: 'ativo', name: 'ativo',orderable:false,serachable:false,sClass:'text-center'},
        {data: 'acessar', name: 'acessar',orderable:false,serachable:false,sClass:'text-center'},
        {data: 'remover', name: 'remover',orderable:false,serachable:false,sClass:'text-center'},
    ],
  })
})
