<div class="modal fade create-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title mt-0">Novo Projeto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <form method="post" id="salvarProjeto">
              @csrf

              @include('./../../layouts/mensagens-modal')

              <div class="form-group row">
                  <label for="example-text-input" class="col-sm-3 col-form-label">Executor</label>
                  <div class="col-sm-9">
                      <input class="form-control" name='company_name' type="text" value="{{Session::get('perfil')->trading_name}}"  disabled>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="example-text-input" class="col-sm-3 col-form-label">Nome do Projeto</label>
                  <div class="col-sm-9">
                      <input class="form-control" name='project_name' type="text" value="" >
                  </div>
              </div>
              <div class="form-group row">
                  <label for="example-text-input" class="col-sm-3 col-form-label">Código do Projeto</label>
                  <div class="col-sm-9">
                      <input class="form-control" name='project_code' type="text" value="" id='valuepoints' >
                  </div>
              </div>
              <div class="form-group row">
                  <label for="example-date-input" class="col-sm-3 col-form-label">Data de início de execução</label>
                  <div class="col-sm-9">
                      <input class="form-control" name='start_date' type="date" value="2011-08-19" >
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary salvar">Salvar</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              </div>
            </form>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->