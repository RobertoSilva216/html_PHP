<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-12 col-md-3 text-start">

    </div>
    <div class="col-12 col-md-6 text-center">
        <h2 class="title">Produtos</h2>
    </div>
    <div class="col-12 col-md-3 text-end">
        <a href="<?=base_url()?>produtos/novo" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i>
            ADICIONAR
        </a>
    </div>
    
</div>

<?php if(isset($produtos) && count($produtos)>0){?>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">STATUS</th>
                <th scope="col">CÓDIGO</th>
                <th scope="col">DESCRIÇÃO</th>
                <th scope="col">PREÇO</th>
                </tr>
            </thead>
            <tbody>
<?php       $cont=0;
            foreach($produtos as $produto){ $cont++;
?>
                <tr>
                    <th scope="row"><?=$cont?></th>
                    <td>
                        <a href="<?=base_url()?>produtos/view/<?=$produto['produto_id']?>" class="font-20 not-decoration">
                            <i class="far fa-file-word ico-azul" title="Visualizar produto"></i>
                        </a> &nbsp;
                        <?php if($produto['produto_status']==1){?>
                        <a href="<?=base_url()?>produtos/editar/<?=$produto['produto_id']?>" class="font-20 not-decoration">
                            <i class="far fa-edit ico-verde" title="Editar produto"></i>
                        </a> 
                        <?php }else{ ?>
                            <i disabled href="#" class="font-20 not-decoration">
                                <i class="far fa-edit ico-cinza" title="Não é possível alterar um produto inativo!"></i>
                            </i> 
                        <?php
                        }
                            echo btnStatusProduto($produto['produto_id'],$produto['produto_descricao'], $produto['produto_status']);
                        ?>
                    </td>
                    <td><?=badge_status($produto['produto_status'])?></td>
                    <td><?=$produto['produto_cod']?></td>
                    <td><?=$produto['produto_descricao']?></td>
                    <td><?=moneyBr($produto['produto_preco'])?></td>
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
            Nenhum produto cadastrado!
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