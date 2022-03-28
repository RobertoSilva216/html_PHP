<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<form id="form-cad-colaborador">

    <div class="row">
        <div class="col-12 col-md-3 text-start">
            <a href="<?=base_url()?>colaboradores" class="btn btn-outline-secondary">
                <i class="fas fa-chevron-left"></i>
                VOLTAR
            </a>
        </div>
        <div class="col-12 col-md-6 text-center">
            <h2 class="title">Cadastro de colaborador</h2>
        </div>
        <div class="col-12 col-md-3 text-end">
            <button type="submit" class="btn btn-outline-primary btn-enviar">
                <i class="fas fa-check"></i>
                SALVAR
            </button>
        </div>
        
    </div>

    <div class="row pt-5">
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <select required class="form-select" id="colaborador_tipo" name="colaborador_tipo" aria-label="tipo, papel, função">
                    <option selected disabled value="">Selecione...</option>
                    <option value="master">Master</option>
                    <option value="fornecedor">Fornecedor</option>
                    <option value="usuario">Usuário</option>
                </select>
                <label for="colaborador_tipo">Tipo do colaborador</label>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <input required type="text" class="form-control" id="colaborador_login" name="colaborador_login" placeholder="Usará para acessar o sistema">
                <label for="colaborador_login">LOGIN</label>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <input required type="text" class="form-control" id="colaborador_nome" name="colaborador_nome" placeholder="Nome">
                <label for="colaborador_nome">Nome</label>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <input required type="password" class="form-control" id="colaborador_senha" name="colaborador_senha" placeholder="********">
                <label for="colaborador_senha">Senha</label>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="colaborador_status" name="colaborador_status" checked>
                <label class="form-check-label" for="colaborador_status">
                    Colaborador ativo
                </label>
            </div>
        </div>
    </div>

</form>