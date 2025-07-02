adicionar após limpa()
$(document).on('click', '.cancelar', function () {
        $(".formulario").html(formOriginal); // Volta ao formulário de cadastro
        limpa(); 
      });

  adicionar       let formOriginal = $(".formulario").html(); no inicio, antes dos ajax

  no primero ajax, adicionar           limpa(); no done
