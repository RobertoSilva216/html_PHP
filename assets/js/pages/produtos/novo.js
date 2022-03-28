let divRetorno= "#div-retorno-oculta";
let btnEnviar='.btn-enviar';
let formCad= $("#form-cad-produto");

formCad.submit(function(event){
    event.preventDefault();
    modal_confirmacao("Reamente enviar os dados?",'enviarForm()');
});

function enviarForm(){
    modal_aviso("Enviando dados...","spiner.gif",false);

    $.post(base_url+"produtos/novo-do", formCad.serialize(),  function(retorno) {
        $(divRetorno).html(retorno);
    }).fail(function(erro){
        var erro_msg='Código erro: '+erro.status+'<br><p>Mensagem: '+erro.statusText+'</p>';
        modal_aviso(erro_msg,"erro-x.png","OK");
        btnBlock(btnEnviar,false);
    });
}

$("#produto_status").change(function(){
    if($(this).prop('checked')){
        $(this).val(1);
    }else{
        $(this).val(0);
    }
});