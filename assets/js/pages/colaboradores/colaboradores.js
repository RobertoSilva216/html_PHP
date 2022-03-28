$(".ico-alterar-status-colaborador").click(function(){
    var colaborador_nome=$(this).attr("colaborador_nome");
    var colaborador_id=$(this).attr("colaborador_id");
    modal_confirmacao("Realmente alterar o status do colaborador <strong>"+colaborador_nome+"</strong>?",'alterar_status('+colaborador_id+');');
});

function alterar_status(colaborador_id=0){
    var data={
        colaborador_id: colaborador_id
    }
    $.post(base_url+"colaboradores/alterar-status", data,  function(retorno) {
        $("#div-retorno-oculta").html(retorno);
    }).fail(function(erro){
        var erro_msg='ERRO CODE '+erro.status+'<br><p>'+erro.statusText+'</p>';
        modal_aviso(erro_msg,"erro-x.png","OK");
    });
}