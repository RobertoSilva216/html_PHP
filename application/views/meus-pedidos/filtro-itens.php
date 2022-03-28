<?php defined('BASEPATH') OR exit('No direct script access allowed');

    if(isset($produtos) && count($produtos)>0){?>

        <div class="table-responsive">
            <table class="table table-filtro-itens">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CÓDIGO</th>
                        <th scope="col">DESCRIÇÃO</th>
                        <th scope="col">PREÇO</th>
                    </tr>
                </thead>
                <tbody>
<?php           $cont=0;
                foreach($produtos as $produto){$cont++;?>
                    <tr onclick="selectItem(this,<?=$produto['produto_id']?>,<?=$produto['produto_cod']?>,'<?=$produto['produto_descricao']?>',<?=$produto['produto_preco']?>)">
                        <th scope="row"><?=$cont?></th>
                        <td><?=$produto['produto_cod']?></td>
                        <td><?=$produto['produto_descricao']?></td>
                        <td><?=$produto['produto_preco']?></td>
                    </tr>
<?php           }?>
                </tbody>
            </table>
        </div>

<?php
    }else{ ?>
        <div class="text-center mt-3 mb-3">
            <img src="<?=base_url()?>assets/images/data-not-found.png" width="80px" alt="">
            <p>
                Nenhum produto atende ao filtro!
            </p>
        </div>
<?php
    }
?>