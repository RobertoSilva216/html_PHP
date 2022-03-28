<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if(isset($pedido['pedido_id'])){?>

    <div class="row">
        <div class="col-12 col-md-3 text-start no-print">
            <a href="<?=base_url()?>meus-pedidos" class="btn btn-outline-secondary">
                <i class="fas fa-chevron-left"></i>
                VOLTAR
            </a>
        </div>
        <div class="col-12 col-md-6 text-center">
            <h2 class="title">
                Dados do pedido Nº <?=$pedido['pedido_id']?>
            </h2>
            <p>
                TOTAL de <?=moneyBr($pedido['pedido_total'] ?? 0)?>
            </p>
            <p>
                <?=badge_status($pedido['pedido_status'])?>
            </p>
        </div>
        <div class="col-12 col-md-3 text-end no-print">
            <button onclick="print()" class="btn btn-outline-primary">
                <i class="fas fa-print"></i>
                IMPRIMIR
            </button>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <select required disabled class="form-select" id="pedido_fornecedor" name="pedido_fornecedor" aria-label="tipo, papel, função">
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
                <textarea required disabled type="text" class="form-control" id="pedido_obs" name="pedido_obs" placeholder=""><?=$pedido['pedido_obs']?></textarea>
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
    if(isset($itens) && count($itens)>0){?>

        <div id="table-itens" class="mt-5">
            <table class="table table-striped text-start">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CÓDIGO</th>
                            <th scope="col">DESCRIÇÃO</th>
                            <th scope="col">QUANT</th>
                            <th scope="col">PREÇO</th>
                            <th scope="col">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
<?php                   $cont=0;
                        foreach($itens as $item){ $cont++;?>
                            <tr>
                                <th><?=$cont?></th>
                                <td><?=$item['pedido_produto_codigo']?></td>
                                <td><?=$item['pedido_produto_descricao']?></td>
                                <td><?=moneyBr($item['pedido_produto_quant'],false)?></td>
                                <td><?=moneyBr($item['pedido_produto_preco'])?></td>
                                <td><?=moneyBr($item['pedido_produto_quant'] * $item['pedido_produto_preco'] )?></td>
                            </tr>
<?php                   }?>
                    </tbody>
            </table>
        </div>

<?php 
    }else{ ?>
        <div id="table-itens" class="mt-5">
            <div class="text-center">
                <img src="<?=base_url()?>assets/images/carrinho-compras.png" width="80px" alt="">
                <p>
                    Nenhum produto adicionado ao pedido.
                </p>
            </div>
        </div>
<?php 
    }

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