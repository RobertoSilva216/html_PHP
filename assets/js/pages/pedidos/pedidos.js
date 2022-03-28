$(".ico-entregar-pedido").click(function(){
    var pedido_id=$(this).attr("pedido_id");
    modal_confirmacao("Realmente entregar o pedido nº <strong>"+pedido_id+"</strong> ?",'entregar_pedido('+pedido_id+');');
});

function entregar_pedido(pedido_id=0){
    var data={
        pedido_id: pedido_id
    }
    $.post(base_url+"pedidos-compra/entregar", data,  function(retorno) {
        $("#div-retorno-oculta").html(retorno);
    }).fail(function(erro){
        var erro_msg='ERRO CODE '+erro.status+'<br><p>'+erro.statusText+'</p>';
        modal_aviso(erro_msg,"erro-x.png","OK");
    });
}