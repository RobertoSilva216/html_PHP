<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php 
    if(isset($colaborador['colaborador_id'])){
?>

<form id="form-edit-colaborador">

    <div class="row">
        <div class="col-12 col-md-3 text-start">
            <a href="<?=base_url()?>colaboradores" class="btn btn-outline-secondary">
                <i class="fas fa-chevron-left"></i>
                VOLTAR
            </a>
        </div>
        <div class="col-12 col-md-6 text-center">
            <h2 class="title">Edição de colaborador</h2>
            <h4>
                (<?=$colaborador['colaborador_id'] ?? 0?>)
                <?=$colaborador['colaborador_nome']??''?>
            </h4>
            <?php if($colaborador['colaborador_status']==0){ ?>
                    <p class="tomato">
                        Colaborador inativo, não é possível alterar os dados!
                    </p>
            <?php }?>
        </div>
        <div class="col-12 col-md-3 text-end">
            <button type="submit" <?php if($colaborador['colaborador_status']==0){echo'disabled';}?> class="btn btn-outline-primary btn-enviar">
                <i class="fas fa-check"></i>
                SALVAR
            </button>
        </div>
        
    </div>

    <div class="row pt-5">
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <select required class="form-select" <?php if($colaborador['colaborador_status']==0){echo'disabled';}?> id="colaborador_tipo" name="colaborador_tipo" aria-label="tipo, papel, função">
                    <option selected disabled value="">Selecione...</option>
                    <option <?php if($colaborador['colaborador_tipo']=='master'){echo'selected';}?> value="master">Master</option>
                    <option <?php if($colaborador['colaborador_tipo']=='fornecedor'){echo'selected';}?> value="fornecedor">Fornecedor</option>
                    <option <?php if($colaborador['colaborador_tipo']=='usuario'){echo'selected';}?> value="usuario">Usuário</option>
                </select>
                <label for="colaborador_tipo">Tipo do colaborador</label>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <input required <?php if($colaborador['colaborador_status']==0){echo'disabled';}?> type="text" class="form-control" id="colaborador_login" value="<?=$colaborador['colaborador_login']??''?>" name="colaborador_login" placeholder="Usará para acessar o sistema">
                <label for="colaborador_login">LOGIN</label>
                <input type="hidden" name="colaborador_id" value="<?=$colaborador['colaborador_id'] ?? 0?>">
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <input required <?php if($colaborador['colaborador_status']==0){echo'disabled';}?> type="text" class="form-control" id="colaborador_nome" value="<?=$colaborador['colaborador_nome']??''?>" name="colaborador_nome" placeholder="Nome">
                <label for="colaborador_nome">Nome</label>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <input <?php if($colaborador['colaborador_status']==0){echo'disabled';}?> type="password" class="form-control" id="colaborador_senha" name="colaborador_senha" placeholder="********">
                <label for="colaborador_senha">Senha</label>
                <?php if($colaborador['colaborador_status']==1){ ?>
                    <small class="tomato">
                        Se preenchido será alterado a senha.
                    </small>
                <?php }?>
                
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="form-check">
                <input class="form-check-input" <?php if($colaborador['colaborador_status']==0){echo'disabled';}?> type="checkbox" value="1" id="colaborador_status" name="colaborador_status" <?php if($colaborador['colaborador_status']==1){echo'checked';}?>>
                <label class="form-check-label" for="colaborador_status">
                    Colaborador ativo
                </label>
            </div>
        </div>
    </div>

</form>



<?php
    }else{
?>
    <div class="text-center mt-5 mb-3">
        <img src="<?=base_url()?>assets/images/data-not-found.png" width="80px" alt="">
        <p>
            Colaborador não encontrado!
        </p>
        <a href="<?=base_url()?>colaboradores" class="btn btn-outline-secondary">
            <i class="fas fa-chevron-left"></i>
            VOLTAR
        </a>

    </div>
<?php
    }
?>