<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-12 col-md-3 text-start">

    </div>
    <div class="col-12 col-md-6 text-center">
        <h2 class="title">Meus pedidos de compra</h2>
    </div>
    <div class="col-12 col-md-3 text-end">
        <a href="<?=base_url()?>meus-pedidos/novo" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i>
            NOVO PEDIDO
        </a>
    </div>
    
</div>

<?php if(isset($pedidos) && count($pedidos)>0){?>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">STATUS</th>
                <th scope="col">CÓDIGO</th>
                <th scope="col">VALOR</th>
                <th scope="col">FORNECEDOR</th>
                <th scope="col">DATA</th>
                <th scope="col">FINALIZADO EM</th>
                <th scope="col">ENTREGUE EM</th>
                </tr>
            </thead>
            <tbody>
<?php       $cont=0;
            foreach($pedidos as $pedido){ $cont++;
?>
                <tr>
                    <th scope="row"><?=$cont?></th>
                    <td>
                        <a href="<?=base_url()?>meus-pedidos/<?=$pedido['pedido_id']?>" class="font-20 not-decoration">
                            <i class="far fa-file-word ico-azul" title="Visualizar pedido"></i>
                        </a> &nbsp;
                        <?php if($pedido['pedido_status']=='pendente'){?>
                            <a href="<?=base_url()?>meus-pedidos/editar/<?=$pedido['pedido_id']?>" class="font-20 not-decoration">
                                <i class="far fa-edit ico-verde" title="Editar pedido"></i>
                            </a> 
                            <i class="fas fa-check ico-verde font-20 pointer ico-finalizar-pedido" pedido_id="<?=$pedido['pedido_id']?>" title="Finalizar pedido"></i>
                        <?php }else{ ?>
                            <i disabled href="#" class="font-20 not-decoration">
                                <i class="far fa-edit ico-cinza" title="Não é possível alterar um pedido <?=$pedido['pedido_status']?>!"></i>
                            </i>
                            <i class="fas fa-check ico-cinza font-20" title="Pedido já finalizado"></i>
                        <?php
                            }
                        ?>
                    </td>
                    <td><?=badge_status($pedido['pedido_status'])?></td>
                    <td><?=$pedido['pedido_id']?></td>
                    <td><?=moneyBr($pedido['pedido_total'])?></td>
                    <td><?=$pedido['fornecedor_nome']?></td>
                    <td><?=data_hr_br($pedido['pedido_dataHora'],false)?></td>
                    <td><?php if(!is_null($pedido['pedido_dataHoraFin'])){echo data_hr_br($pedido['pedido_dataHoraFin'],false);}else{echo'<em>não se aplica</em>';}?></td>
                    <td><?php if(!is_null($pedido['pedido_dataHoraEnt'])){echo data_hr_br($pedido['pedido_dataHoraEnt'],false);}else{echo'<em>não se aplica</em>';}?></td>
                </tr>
<?php
            }
?>
            </tbody>
        </table>
    </div>

<?php }else{?>
    <div class="text-center mt-5 mb-3">
        <img src="<?=base_url()?>assets/images/data-not-found.png" width="80px" alt="">
        <p>
            Nenhum pedido cadastrado!
        </p>
    </div>
<?php }?>




<?php 
    if(gettype($this->session->flashdata('aviso_modal')) =='array'){
        $msg_temp=$this->session->flashdata('aviso_modal');
?>
<script>
    window.addEventListener("load", function(event) {
        modal_aviso('<?=$msg_temp['mensagem']?>','<?=$msg_temp['imagem']?>','<?=$msg_temp['botao']?>');
    });
</script>  
<?php
    }
?>