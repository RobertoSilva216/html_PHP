<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php 
    if(isset($produto['produto_id'])){
?>

    <form id="form-edit-produto">
        <div class="row">
            <div class="col-12 col-md-3 text-start">
                <a href="<?=base_url()?>produtos" class="btn btn-outline-secondary">
                    <i class="fas fa-chevron-left"></i>
                    VOLTAR
                </a>
            </div>
            <div class="col-12 col-md-6 text-center">
                <h2 class="title">Edição de produto</h2>
                <h4>
                    <?=$produto['produto_descricao'] ?? ''?>
                    <?=$produto['produto_preco'] ?? 0?>
                </h4>
                <?php if($produto['produto_status']==0){ ?>
                        <p class="tomato">
                            Produto inativo, não é possível alterar os dados!
                        </p>
                <?php }?>

            </div>
            <div class="col-12 col-md-3 text-end">
                <button type="submit" <?php if($produto['produto_status']==0){echo'disabled';}?> class="btn btn-outline-primary btn-enviar">
                    <i class="fas fa-check"></i>
                    SALVAR
                </button>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-12 col-md-4  mb-3">
                <div class="form-floating">
                    <input required type="text" <?php if($produto['produto_status']==0){echo'disabled';}?> class="form-control" id="produto_codigo" value="<?=$produto['produto_cod'] ?? ''?>" name="produto_codigo" placeholder="1234">
                    <label for="produto_codigo">Código</label>
                    <input type="hidden" name="produto_id" value="<?=$produto['produto_id'] ?? 0?>">
                </div>
            </div>
            <div class="col-12 col-md-4  mb-3">
                <div class="form-floating">
                    <input required type="text" <?php if($produto['produto_status']==0){echo'disabled';}?> class="form-control" id="produto_descricao" value="<?=$produto['produto_descricao'] ?? ''?>" name="produto_descricao" placeholder="Bolacha">
                    <label for="produto_descricao">Descrição</label>
                </div>
            </div>
            <div class="col-12 col-md-4  mb-3">
                <div class="form-floating">
                    <input required type="text" <?php if($produto['produto_status']==0){echo'disabled';}?> class="form-control" id="produto_preco" value="<?=$produto['produto_preco'] ?? ''?>" name="produto_preco" placeholder="R$ 0,00">
                    <label for="produto_preco">Preço</label>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="form-check">
                    <input class="form-check-input" <?php if($produto['produto_status']==0){echo'disabled';}?> type="checkbox" value="1" id="produto_status" name="produto_status" <?php if($produto['produto_status']==1){echo'checked';}?>>
                    <label class="form-check-label" for="produto_status">
                        Produto ativo <!-- status -->
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
            Produto não encontrado!
        </p>
        <a href="<?=base_url()?>produtos" class="btn btn-outline-secondary">
            <i class="fas fa-chevron-left"></i>
            VOLTAR
        </a>

    </div>
<?php
    }
?>
