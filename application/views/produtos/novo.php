<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form id="form-cad-produto">

    <div class="row">
        <div class="col-12 col-md-3 text-start">
            <a href="<?=base_url()?>produtos" class="btn btn-outline-secondary">
                <i class="fas fa-chevron-left"></i>
                VOLTAR
            </a>
        </div>
        <div class="col-12 col-md-6 text-center">
            <h2 class="title">Cadastro de produto</h2>
        </div>
        <div class="col-12 col-md-3 text-end">
            <button type="submit" class="btn btn-outline-primary btn-enviar">
                <i class="fas fa-check"></i>
                SALVAR
            </button>
        </div>
        
    </div>

    <div class="row pt-5">
        <div class="col-12 col-md-4  mb-3">
            <div class="form-floating">
                <input required type="text" class="form-control" id="produto_codigo" name="produto_codigo" placeholder="1234">
                <label for="produto_codigo">Código</label>
            </div>
        </div>
        <div class="col-12 col-md-4  mb-3">
            <div class="form-floating">
                <input required type="text" class="form-control" id="produto_descricao" name="produto_descricao" placeholder="Bolacha">
                <label for="produto_descricao">Descrição</label>
            </div>
        </div>
        <div class="col-12 col-md-4  mb-3">
            <div class="form-floating">
                <input required type="text" class="form-control" id="produto_preco" name="produto_preco" placeholder="R$ 0,00">
                <label for="produto_preco">Preço</label>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="produto_status" name="produto_status" checked>
                <label class="form-check-label" for="produto_status">
                    Produto ativo
                </label>
            </div>
        </div>
    </div>

</form>