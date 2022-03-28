let divRetorno= "#resultados-busca";
let btnEnviar='.btn-enviar';
let formFiltro= $("#form-filtro-produtos");

formFiltro.submit(function(event){
    event.preventDefault();
    $(divRetorno).html('<div class="text-center"><img src="'+base_url+'assets/images/spiner.gif" width="60px">Buscando na lista de produtos...</div>');
    $.post(base_url+"meus-pedidos/filtro-item", formFiltro.serialize(),  function(retorno) {
        $(divRetorno).html(retorno);
    }).fail(function(erro){
        var erro_msg='<div class="text-center">Código erro: '+erro.status+'<br><p>Mensagem: '+erro.statusText+'</p></div>';
        $(divRetorno).html(erro_msg);
    });
});

$(".btn-modal-add-item").click(function(){
    $(".table tr").each(function() {
        $(this).removeClass("selected");
    });
});



function selectItem(e,item_id=0,item_cod=0,item_desc='',item_preco=0){
    $(".table tr").each(function() {
        $(this).removeClass("selected");
    });
    item_selecionado=[
        item_id,
        item_cod,
        item_desc,
        item_preco
    ];
    $(e).addClass("selected");
}

$(".btn-add-item").click(function(){
    if(item_selecionado.length>0){
        var quant = parseInt($("#item_add_quant").val());
        var index= parseInt(itemExisteLista(item_selecionado[0])); 
        if(index == -1){
            item_selecionado.push(
                $("#item_add_quant").val()
            );
            itensPedido.push(item_selecionado);
        }else{
            itensPedido[index][4]= parseInt(itensPedido[index][4]) + quant;
        }
        $("#modal-add-item .btn-close").click();
        loadTable();
    }else{
        modal_aviso("Selecione um item para adicionar!","atencao.png","OK");
    }
});

$("#modal-add-item .btn-close").click(function(){
    item_selecionado=[];
});

function itemExisteLista(item_id=0){
    var index=-1;
    Object.keys(itensPedido).forEach((item) => {
        if(parseInt(itensPedido[item][0]) == parseInt(item_id)){
            index=item;return false;
        }
    });
    return index;
}
function loadTable(){
    if(itensPedido.length>0){
        var header='<table class="table table-striped text-start"><thead><tr><th scope="col">#</th><th scope="col"></th><th scope="col">CÓDIGO</th><th scope="col">DESCRIÇÃO</th><th scope="col">QUANT</th><th scope="col">PREÇO</th><th scope="col">SUBTOTAL</th></tr></thead><tbody>';
        var footer='</tbody></table>';
        var total=0;

        var table=header;
        var cont=0;
        Object.keys(itensPedido).forEach((item) => {
            cont++;
            var subtotal=itensPedido[item][3] * itensPedido[item][4];
            total+=subtotal;
            subtotal= formatMoney(subtotal);
            var preco= formatMoney(itensPedido[item][3]);

            var linha='<tr><th>'+cont+'</th><td><i class="far fa-times-circle tomato font-18 pointer ico-remove-item" item_id="'+itensPedido[item][0]+'" item_desc="'+itensPedido[item][2]+'" title="Remover item"></i></td><td>'+itensPedido[item][1]+'</td><td>'+itensPedido[item][2]+'</td><td>'+itensPedido[item][4]+'</td><td>'+preco+'</td><td>'+ subtotal +'</td></tr>';
            table+=linha;
        });
        table+=footer;
        $("#label-total-pedido").text(formatMoney(total));
        $("#table-itens").html(table); 
        loadEvents();
    }else{
        var html='<div class="text-center"><img src="'+base_url+'assets/images/carrinho-compras.png" width="80px" alt=""><p>    Use o botão acima para adicionar itens.</p></div>';
        $("#table-itens").html(html); 
    }
}

function removerLista(item_id=0){
    var index= parseInt(itemExisteLista(item_id)); 
    itensPedido.splice(index,1);
    loadTable();
}

function loadEvents(){
    $(".ico-remove-item").click(function(){
        var item_id= $(this).attr("item_id");
        var item_desc= $(this).attr("item_desc");
        modal_confirmacao("Remover o item <strong>"+item_desc+"</strong> da lista?",'removerLista('+item_id+');');
    });
}


$(".btn-enviar").click(function(){
    modal_confirmacao("Realmente enviar os novos dados do pedido?",'enviarPedido();');
});

function enviarPedido(){
    modal_aviso("Salvando novos dados do pedido...","spiner.gif",false);
    var dados={
        pedido_id: $("#pedido_id").val(),
        pedido_fornecedor: $("#pedido_fornecedor").val(),
        pedido_obs: $("#pedido_obs").val(),
        itensPedido: JSON.stringify(itensPedido)
    }
    $.post(base_url+"meus-pedidos/editar-do", dados,  function(retorno) {
        $("#div-retorno-oculta").html(retorno);
    }).fail(function(erro){
        var erro_msg='Código erro: '+erro.status+'<br><p>Mensagem: '+erro.statusText+'</p>';
        modal_aviso(erro_msg,"erro-x.png",'OK');
    });
}