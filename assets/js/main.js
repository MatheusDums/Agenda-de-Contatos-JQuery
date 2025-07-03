$(document).ready(function () {
        let formOriginal = $(".formulario").html();

        $(document).on("submit", "#form", function (e) {
          e.preventDefault();
          /* para adicionar um contato */
          $.ajax({
            url: "assets/php/adicionar.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
          }).done(function (data) {
            $(".formulario").html(formOriginal);
            limpa();
            $(".resp").html(data);
            setTimeout(function () {
              $(".resp").html("");
            }, 3000);
          });
        });

        /* para colocar os dados na tabela */
        function contato() {
          $.ajax({
            url: "assets/php/select.php",
            method: "GET",
          }).done(function (data) {
            $(".table_body").html(data);
          });
        }
        setInterval(contato, 1000);

        /* para editar um contato */
        $(document).on("click", ".editar", function (e) {
          e.preventDefault(); /* não atualiza a página caso ocorra algum erro */
          var id = $(this).attr("id");
          $.ajax({
            url: "assets/php/select.php",
            method: "POST",
            data: {
              id: id,
            },
          }).done(function (data) {
            $(".formulario").html(data);
          });
        });

        /* para atualizar um contato */
        $(document).on("submit", ".update", function (e) {
          e.preventDefault();
          $.ajax({
            url: "assets/php/adicionar.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
          }).done(function (data) {
            limpa();
            $(".resp").html(data);
            $("#nome").val("");
            setTimeout(function () {
              $(".resp").html("");
            }, 3000);
          });
        });

        /* para excluir um contato */
        $(document).on("click", ".excluir", function (e) {
          e.preventDefault(); /* não atualiza a página caso ocorra algum erro */
          var del = $(this).attr("id");
          $.ajax({
            url: "assets/php/select.php",
            method: "POST",
            data: {
              del: del,
            },
          }).done(function (data) {
            $(".resp").html(data);
            limpa();
            setTimeout(function () {
              $(".resp").html("");
            }, 3000);
          });
        });

        /* para limpar o formulario (pelo botão) */
        function limpa() {
          $("#nome, #telefone, #email, #nascimento, #observacoes").val("");
        }

        $(document).on("click", ".cancelar", function () {
          $(".formulario").html(formOriginal); // Volta ao formulário de cadastro
          limpa();
        });
      });