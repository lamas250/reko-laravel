
$(document).ready(function(){
  var dataTable = $('.datatable').DataTable({
    processing: true,
    serverSide: true,
    autoWidth: false,
    pageLength: 10,
    ajax: {
      type: 'post',
      url: 'projetos/list',
      async: true,
      headers : {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
    language: {
      url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
    },
    columns: [
        {data: 'code_name', name: 'code_name'}, 
        {data: 'name', name: 'name'},
        {data: 'start_date', name: 'start_date'},
        {data: 'acessar', name: 'acessar',orderable:false,serachable:false,sClass:'text-center'},
        {data: 'remover', name: 'remover',orderable:false,serachable:false,sClass:'text-center'},
    ],
  })
})

// function loadProjetos(){
//   $.ajax({
//     url: 'projetos/list',
//     type: 'GET',
//     success: function(res){
//       var conteudo = '';
//       $(res).each(function(){
//         let start_date_format = new Date(this.start_date);
//         start_date_format = start_date_format.toLocaleDateString();
//       conteudo = 
//          ` <div class="col-xl-3 col-md-6">
//             <div class="card mini-stat bg-success text-white" id=${this.project_id}>
//                 <div class="card-body">
//                     <div class="mb-4">
//                         <h5 class="font-500">${this.name}</h5>
//                         <h5 class="font-16 text-uppercase mt-0 text-white-50">${this.code_name} </h5>
//                     </div>
//                     <div class="pt-2">
//                         <div style='opacity: 0.7; border-radius: 4px;' >
//                           <a class="float-right" style='display:flex; flex-direction: row;' href="#" class="text-white-50">
//                             <h5 class='font-16 text-uppercase mt-0 text-white-50' style='margin-right: 8px'>Acessar</h5>
//                             <i class="mdi mdi-arrow-right h5 text-white-50"></i>
//                           </a>
//                         </div>
//                         <p class="mb-0">Início: ${start_date_format}</p>
//                     </div>
//                 </div>
//             </div>
//           </div>`;
//       })
//       $('#projetos-card').html(conteudo);
//     }
//   })
// }


$('#salvarProjeto').on('submit', function(e){
  e.preventDefault();
  $(".salvar").prop('disabled', true);
  $.ajax({
    url: 'projetos',
    type: 'POST',
    data: $('#salvarProjeto').serialize(),
    success: function(data){
      mensagemSucesso(data.message)
      $('.datatable').DataTable().ajax.reload();
      $('.create-modal').modal('hide');
      $(".salvar").prop('disabled', false);
    },
    error: function(err){
      mensagemModalErro(err.responseJSON.message, 422);
      console.log(err.responseJSON);
      $(".salvar").prop('disabled', false);
    }
  })
})


function acessarFunction(id){
  let base = "{!! route('projetos.acessar') !!}";
  // url = url.replace(':id', id);
  var url = base+'?id='+id 
  document.location.href=url;
}