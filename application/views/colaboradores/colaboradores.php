<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-12 col-md-3 text-start">

    </div>
    <div class="col-12 col-md-6 text-center">
        <h2 class="title">Colaboradores</h2>
    </div>
    <div class="col-12 col-md-3 text-end">
        <a href="<?=base_url()?>colaboradores/novo" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i>
            ADICIONAR
        </a>
    </div>
    
</div>

<?php if(isset($colaboradores) && count($colaboradores)>0){?>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">ID - TIPO</th>
                <th scope="col">STATUS</th>
                <th scope="col">LOGIN</th>
                <th scope="col">NOME</th>
                <th scope="col">DATA CADASTRO</th>
                </tr>
            </thead>
            <tbody>
<?php       $cont=0;
            foreach($colaboradores as $colaborador){ $cont++;
?>
                <tr>
                    <th scope="row"><?=$cont?></th>
                    <td>
                        <?php if($colaborador['colaborador_status']==1){?>
                        <a href="<?=base_url()?>colaboradores/editar/<?=$colaborador['colaborador_id']?>" class="font-20 not-decoration">
                            <i class="far fa-edit ico-verde" title="Editar colaborador"></i>
                        </a> 
                        <?php }else{ ?>
                            <i disabled href="#" class="font-20 not-decoration">
                                <i class="far fa-edit ico-cinza" title="Não é possível alterar um colaborador inativo!"></i>
                            </i> 
                        <?php
                        }
                            echo btnStatusColaborador($colaborador['colaborador_id'],$colaborador['colaborador_nome'], $colaborador['colaborador_status']);
                        ?>
                    </td>
                    <td>(<?=$colaborador['colaborador_id']?>) <?=$colaborador['colaborador_tipo']?></td>
                    <td><?=badge_status($colaborador['colaborador_status'])?></td>
                    <td><?=$colaborador['colaborador_login']?></td>
                    <td><?=$colaborador['colaborador_nome']?></td>
                    <td><?=$colaborador['colaborador_datatime_criado']?></td>
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
            Nenhum colaborador cadastrado!
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