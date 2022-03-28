<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if(isset($pedido['pedido_id'])){?>

    <div class="row">
        <div class="col-12 col-md-3 text-start">
            <a href="<?=base_url()?>meus-pedidos" class="btn btn-outline-secondary">
                <i class="fas fa-chevron-left"></i>
                VOLTAR
            </a>
        </div>
        <div class="col-12 col-md-6 text-center">
            <h2 class="title">
                Editar pedido Nº <?=$pedido['pedido_id']?>
            </h2>
            <input type="hidden" name="pedido_id" id="pedido_id" value="<?=$pedido['pedido_id']?>">
            <p>
                TOTAL de <?=moneyBr($pedido['pedido_total'] ?? 0)?>
            </p>
        </div>
        <?php 
            if($pedido['pedido_status']=='pendente'){
        ?>
            <div class="col-12 col-md-3 text-end">
                <button type="submit"  class="btn btn-outline-primary btn-enviar">
                    <i class="fas fa-check"></i>
                    SALVAR
                </button>
            </div>
        <?php
            }else{ ?>
                <div class="text-center">
                    <p class="tomato">
                        Pedido <?=$pedido['pedido_status']?>, não é possível alterar os dados!
                    </p>
                </div>
        <?php 
            }
        ?>

        
    </div>

    <div class="row pt-5">
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <select required <?php if($pedido['pedido_status']!=='pendente')echo'disabled';?> class="form-select" id="pedido_fornecedor" name="pedido_fornecedor" aria-label="tipo, papel, função">
                    <option selected disabled value="">Selecione...</option>
<?php
                        if(isset($fornecedores) && count($fornecedores)>0){ 
                            foreach($fornecedores as $fornecedor){ ?>
                                <option <?php if($pedido['pedido_fornecedor']==$fornecedor['colaborador_id'])echo'selected';?> value="<?=$fornecedor['colaborador_id']?>"><?=$fornecedor['colaborador_nome']?></option>
<?php
                            }
                        }
                    ?>
                </select>
                <label for="pedido_fornecedor">Fornecedor</label>
            </div>
        </div>
        <div class="col-12 col-md-6  mb-3">
            <div class="form-floating">
                <textarea required <?php if($pedido['pedido_status']!=='pendente')echo'disabled';?> type="text" class="form-control" id="pedido_obs" name="pedido_obs" placeholder=""><?=$pedido['pedido_obs']?></textarea>
                <label for="pedido_obs">Obervação</label>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3 text-center">
            <p>TOTAL</p>
            <h4 id="label-total-pedido">
                <?=moneyBr($pedido['pedido_total'] ?? 0)?>
            </h4>
        </div>
    </div>

    <?php 
            if($pedido['pedido_status']=='pendente'){
        ?>
            <div class="text-center">
                <button type="button" class="btn btn-secondary btn-modal-add-item" data-bs-toggle="modal" data-bs-target="#modal-add-item">
                    ADICIONAR ITEM
                </button>
            </div>
    <?php
            }
    ?>

    

    <div id="table-itens" class="mt-5">
        <div class="text-center">
            <img src="<?=base_url()?>assets/images/carrinho-compras.png" width="80px" alt="">
            <p>
                Use o botão acima para adicionar itens.
            </p>
        </div>
    </div>



<div class="modal fade" id="modal-add-item" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-add-itemLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-add-itemLabel">Adicionar item ao pedido</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
    <form id="form-filtro-produtos">
        <div class="row">
            <div class="col-12 offset-md-3 col-md-6 mb-3">
                <div class="form-floating">
                    <input required type="text" class="form-control" id="item_add_filtro" name="item_add_filtro">
                    <label for="item_add_filtro">Busque pelo nome do produto</label>
                </div>
            </div>
            <div class="col-12 col-md-2 text-end">
                <button type="submit" class="btn btn-outline-primary mt-2 p-2">
                    <i class="fas fa-search"></i>
                    BUSCAR
                </button>
            </div>
        </div>
    </form>
        <div class="resultados-busca" id="resultados-busca">
            <!-- RESULTADOS AQUI -->
        </div>
                        
                        
      </div>
      <div class="modal-footer">
            <div class=" mb-3">
                <div class="form-floating">
                    <input required type="number" class="form-control" id="item_add_quant" name="item_add_quant" value="1">
                    <label for="item_add_quant">Quantidade</label>
                </div>
            </div>
        <button type="button" class="btn btn-primary p-2 btn-add-item">ADICIONAR</button>
      </div>
    </div>
  </div>
</div>

<script>
    var itensPedido=[];
    var item_selecionado=[];

    window.addEventListener("load", function(event) {

<?php
    if(isset($itens) && count($itens)>0){?>
<?php
        $cont=0;
        foreach($itens as $item){ $cont++; ?>
                var item_selecionado=[
                    <?=$item['pedido_produto_produto'] ?? 0?>,
                    <?=$item['pedido_produto_codigo'] ?? 0?>,
                    "<?=$item['pedido_produto_descricao'] ?? 'nome_produto'?>",
                    <?=$item['pedido_produto_preco'] ?? 0?>,
                    <?=$item['pedido_produto_quant'] ?? 0?>
                ];
                itensPedido.push(item_selecionado);
            
<?php   }?>
        
<?php
    } ?>

        loadTable();
    });
</script>

<?php
    }else{ //else do pedido não encontrado
?>
    <div class="text-center mt-5 mb-3">
        <img src="<?=base_url()?>assets/images/data-not-found.png" width="80px" alt="">
        <p>
            Pedido não encontrado!
        </p>
        <a href="<?=base_url()?>meus-pedidos" class="btn btn-outline-secondary">
            <i class="fas fa-chevron-left"></i>
            VOLTAR
        </a>
    </div>
<?php
    }
?>