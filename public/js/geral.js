function abrirLoading (elemento, top = '0', left = '0', text = 'Carregando') {
    var block_ele = $(elemento);
    $(block_ele).block({
        message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; '+text+' ...</div>',
        fadeIn: 1000,
        fadeOut: 1000,
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: '10px 15px',
            color: '#fff',
            width: 'auto',
            backgroundColor: '#333'
        }
    });

    if (top != '')
        $('.blockElement').css('top', top);

    if (left != '')
        $('.blockElement').css('left', left);
}


function fecharLoading(elemento) { 
  $(elemento).unblock();
}


$(function () {
  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };

  var projetoCode = function validate(s) {
    var rgx = /^[ A-Za-z0-9_@./#&+-]*$/;
    return s.match(rgx);
}
  
  

  $('.mask-code').mask(projetoCode);
  $('.mask-telefone').mask(SPMaskBehavior, spOptions);


  $(".mask-number").mask('000000000,00', { reverse: true});
  $('.mask-celular').mask('(00) 00000-0009');
  $('.mask-phone').mask('(00) 0000-0000');
  $(".mask-date").mask('00/00/0000');
  $(".mask-period").mask('00/00/0000 até 00/00/0000');
  $(".mask-date-ref").mask('00/0000');
  $(".mask-cep").mask('00000-000');
  $(".mask-datetime").mask('00/00/0000 00:00');
  $(".mask-month").mask('00/0000', { reverse: true });
  $(".mask-doc").mask('000.000.000-00', { reverse: true });
  $(".mask-rg").mask('00.000.000-0', { reverse: true });
  $(".mask-cnpj").mask('00.000.000/0000-00', { reverse: true });
  $(".mask-zipcode").mask('00000-000', { reverse: true });

})

function limparMensagens() {
  $('div[rel^=mensagem_mostrar]').hide(500);
}

function mensagemSucesso(mensagem) {
  $('span[rel=mensagem_descricao_sucesso]').html(mensagem);
  $('div[rel=mensagem_mostrar_sucesso]').show(200);
  setTimeout(function(){
      limparMensagens();
  },3000);
}

function mensagemErro(data, status) {
  var mensagem = '';
  if(status == 422){
      var mensagem = '';
      for (var [key, error] of Object.entries(data.errors)) {
          mensagem += error + '<br>';
      }
      $('span[rel=mensagem_descricao_modal]').html(mensagem);
      $('div[rel=mensagem_mostrar_modal]').show(200);
  }else if(status == 403) {
      $('span[rel=mensagem_descricao_informacao_modal]').html('Seu Perfil não tem esse tipo de permissão.');
      $('div[rel=mensagem_mostrar_informacao_modal]').show(200);
  }else {
      $('span[rel=mensagem_descricao_modal]').html('Erro contate o suporte!');
      $('div[rel=mensagem_mostrar_modal]').show(200);
  }
  $('.modal').scrollTop(0);
}


function mensagemModalErro(data, status) {
  var mensagem = '';
  if(status == 422){
      var mensagem = '';
      for (var [key, error] of Object.entries(data)) {
          mensagem += error + '<br>';
      }
      $('span[rel=mensagem_descricao_erro_modal]').html(mensagem);
      $('div[rel=mensagem_mostrar_erro_modal]').show(200);
  }else if(status == 403) {
      $('span[rel=mensagem_descricao_informacao_modal]').html('Seu Perfil não tem esse tipo de permissão.');
      $('div[rel=mensagem_mostrar_informacao_modal]').show(200);
  }else {
      $('span[rel=mensagem_descricao_erro_modal]').html('Erro contate o suporte!');
      $('div[rel=mensagem_mostrar_erro_modal]').show(200);
  }
  $('.modal').scrollTop(0);
}
