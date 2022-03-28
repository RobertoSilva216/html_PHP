$(".ico-alterar-status").click(function(){
    var produto_nome=$(this).attr("produto_descricao");
    var produto_id=$(this).attr("produto_id");
    modal_confirmacao("Realmente alterar o status do produto <strong>"+produto_nome+"</strong>?",'alterar_status('+produto_id+');');
});

function alterar_status(produto_id=0){
    var data={
        produto_id: produto_id
    }
    $.post(base_url+"produtos/alterar-status", data,  function(retorno) {
        $("#div-retorno-oculta").html(retorno);
    }).fail(function(erro){
        var erro_msg='ERRO CODE '+erro.status+'<br><p>'+erro.statusText+'</p>';
        modal_aviso(erro_msg,"erro-x.png","OK");
    });
}