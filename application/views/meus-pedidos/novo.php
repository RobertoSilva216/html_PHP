<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
        <div class="col-12 col-md-4 text-start">
            <a href="<?=base_url()?>meus-pedidos" class="btn btn-outline-secondary">
                <i class="fas fa-chevron-left"></i>
                VOLTAR
            </a>
        </div>
        <div class="col-12 col-md-4 text-center">
            <h2 class="title">Novo pedido</h2>
        </div>
        <div class="col-12 col-md-4 text-end">
            <button type="submit" status="finalizado" class="btn btn-outline-success btn-enviar">
                <i class="fas fa-check"></i>
                SALVAR E FINALIZAR
            </button>
            <button type="submit" status="pendente" class="btn btn-outline-primary btn-enviar">
                <i class="fas fa-check"></i>
                SALVAR
            </button>
        </div>
        
    </div>

    <div class="row pt-5">
        <div class="col-12 col-md-3 mb-3">
            <div class="form-floating">
                <select required class="form-select" id="pedido_fornecedor" name="pedido_fornecedor" aria-label="tipo, papel, função">
                    <option selected disabled value="">Selecione...</option>
<?php
                        if(isset($fornecedores) && count($fornecedores)>0){ 
                            foreach($fornecedores as $fornecedor){ ?>
                                <option value="<?=$fornecedor['colaborador_id']?>"><?=$fornecedor['colaborador_nome']?></option>
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
                <textarea required type="text" class="form-control" id="pedido_obs" name="pedido_obs" placeholder=""></textarea>
                <label for="pedido_obs">Obervação</label>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3 text-center">
            <p>TOTAL</p>
            <h4 id="label-total-pedido">
                R$ 0,00
            </h4>
        </div>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-secondary btn-modal-add-item" data-bs-toggle="modal" data-bs-target="#modal-add-item">
            ADICIONAR ITEM
        </button>
    </div>

    <div id="table-itens" class="mt-5">
        <div class="text-center">
            <img src="<?=base_url()?>assets/images/carrinho-compras.png" width="80px" alt="">
            <p>
                Use o botão acima para adicionar itens.
            </p>
        </div>
    </div>

    <!-- 
    <div id="table-itensss" class="mt-5">
        <table class="table table-striped text-start">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">CÓDIGO</th>
                        <th scope="col">DESCRIÇÃO</th>
                        <th scope="col">QUANT</th>
                        <th scope="col">PREÇO</th>
                        <th scope="col">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>
                            <i class="far fa-times-circle tomato font-18 pointer ico-remove-item" item_cod="0" title="Remover item"></i>
                        </td>
                        <td>123</td>
                        <td>Bolacha</td>
                        <td>2</td>
                        <td>3.5</td>
                        <td>7</td>
                    </tr>
                </tbody>
        </table>
    </div>
    -->




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

