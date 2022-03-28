let divRetorno= "#div-retorno-oculta";
let btnEnviar='.btn-enviar';
let formEdit= $("#form-edit-colaborador");

formEdit.submit(function(event){
    event.preventDefault();
    modal_confirmacao("Reamente enviar os novos dados?",'enviarForm()');
});

function enviarForm(){
    modal_aviso("Enviando novos dados...","spiner.gif",false);

    $.post(base_url+"colaboradores/editar-do", formEdit.serialize(),  function(retorno) {
            $(divRetorno).html(retorno);
    }).fail(function(erro){
        var erro_msg='Código erro: '+erro.status+'<br><p>Mensagem: '+erro.statusText+'</p>';
        modal_aviso(erro_msg,"erro-x.png","OK");
        btnBlock(btnEnviar,false);
    });
}

$("#colaborador_status").change(function(){
    if($(this).prop('checked')){
        $(this).val(1);
    }else{
        $(this).val(0);
    }
});