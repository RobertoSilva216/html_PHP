<?php
function dominio_puro(){
    $dominio=str_replace('https://','',base_url());
    $dominio=str_replace('http://','',$dominio);
    $dominio=str_replace('http:','',$dominio);
    $dominio=str_replace('/','',$dominio);
    return $dominio;
}

function print_js($js){
    echo "<script>$js</script>";
}

function data_hr_br($data,$seg=true){
    if($data=='0000-00-00 00:00:00'){
        return '00/00/000 00:00';
    }
    if($seg){
        return date('d/m/Y H:i:s',strtotime($data));
    }else{
        return date('d/m/Y H:i',strtotime($data));
    }
}

function data_br($data){
    return date('d/m/Y',strtotime($data));
}

function location_page($page= null){
    if(is_null($page) || $page==''){$page= base_url();}
    echo '<script>window.location.replace("'.base_url().$page.'");</script>';
}

function badge_status($bool){
    $cores=array(
        0 => '<span class="badge bg-warning">inativo</span>',
        1 => '<span class="badge bg-success">ativo</span>',
        'pendente' => '<span class="badge bg-warning">Pendente</span>',
        'finalizado' => '<span class="badge bg-primary">Finalizado</span>',
        'entregue' => '<span class="badge bg-success">Entregue</span>'
    );
    if(isset($cores[$bool])){
        return $cores[$bool];
    }else{
        return '<span class="badge bg-light">'.$bool.'</span>';
    }
}

function btnStatusProduto($produto_id=0,$produto_descricao='',$produto_status=0){
    if($produto_status==1){
        $acao='Desativar';
        $cor='tomato'; 
    }else{
        $acao='Ativar';
        $cor='ico-verde';
    }
    return '&nbsp;<i class="fas fa-power-off '.$cor.' pointer font-20 ico-alterar-status" title="'.$acao.' produto" produto_descricao="'.$produto_descricao.'" produto_id="'.$produto_id.'"></i>';
}

function btnStatusColaborador($colaborador_id=0,$colaborador_nome='',$colaborador_status=0){
    if($colaborador_status==1){
        $acao='Desativar';
        $cor='tomato'; 
    }else{
        $acao='Ativar';
        $cor='ico-verde';
    }
    return '&nbsp;<i class="fas fa-power-off '.$cor.' pointer font-20 ico-alterar-status-colaborador" title="'.$acao.' colaborador" colaborador_nome="'.$colaborador_nome.'" colaborador_id="'.$colaborador_id.'"></i>';
}

function remove_caracteres($texto=''){
    $text= str_replace("'","",$text);
    return str_replace("\n","",$text);
}

function moneyBr($valor=0,$cifrao=true,$casas=2){
    //$valor=str_replace('.',',',$valor);
    $valor=number_format($valor,$casas,",",".");
    if($cifrao){
        return 'R$ '.$valor;
    }else{
        return $valor;
    }
}

function verificar_login(){
    if(!isset($_SESSION['sessao_logado'])){
        location_page('login');
        echo'<h4>Sessão expirada, refaça <a href="'.base_url().'login">login</a>.</h4>';
        exit;
    }
}


?>