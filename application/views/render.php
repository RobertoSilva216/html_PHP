<?php defined('BASEPATH') OR exit('No direct script access allowed');

        $css_padrao= array( 
            'assets/css/main.css'
        );
        $css_Externo_padrao=array( //quando houver parametros no final deixar sem a ultima aspas duplas
            'https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous'
        );

        $js_Externo_padrao=array(
            'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous'
        );
        $js_padrao=array(
            'assets/js/jquery-3.2.1.min.js',
            'assets/js/jquery.form.js',
            'assets/js/main.js'
        );
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title ??''?> :: <?=NOME_SITE?></title>
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo.png" type="image/x-icon">
<?php
    $versao='';
    $versao=date('YmdHms');

        foreach($css_Externo_padrao as $css_E){ ?>
            <link rel="stylesheet" href="<?=$css_E?>">
<?php   }
    
    if(isset($css_Externo)){
        foreach($css_Externo as $css_E){ ?>
            <link rel="stylesheet" href="<?=$css_E?>">
<?php   }
    }
        foreach($css_padrao as $v){?>
            <link href="<?=base_url()?><?=$v?><?='?v='.$versao?>" rel="stylesheet">
<?php   }

    if(isset($css)){
        foreach($css as $v){?>
            <link href="<?=base_url()?><?=$v?><?='?v='.$versao?>" rel="stylesheet">
<?php   }
    }
?>
</head>
<body class="">
<header class="header-mobile d-block d-lg-none">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?=base_url()?>assets/images/logo.png" alt="LOGO"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if(isset($page_incluir) && mb_strpos($page_incluir,'home') !== false) echo'active' ?> has-sub">
                        <a class="nav-link js-arrow" href="<?=base_url()?>">
                            <i class="fas fa-home"></i>Home</a>
                    </li> 
                    <?php if($this->usuario_logado['colaborador_tipo'] == 'master'){?>

                        <li class="nav-item <?php if(isset($page_incluir) && mb_strpos($page_incluir,'produtos') !== false) echo'active' ?>">
                            <a class="nav-link" href="<?=base_url()?>produtos">
                                <i class="fas fa-box"></i>Produtos</a>
                        </li>
                        <li class="nav-item <?php if(isset($page_incluir) && mb_strpos($page_incluir,'colaborador') !== false) echo'active' ?>">
                            <a clas="nav-link" href="<?=base_url()?>colaboradores">
                                <i class="fas fa-user-cog"></i></i>Colaboradores</a>
                        </li> 
                    <?php }?>
                    <?php if($this->usuario_logado['colaborador_tipo'] !== 'fornecedor'){?>
                        <li class="nav-item <?php if(isset($page_incluir) && mb_strpos($page_incluir,'meus-pedidos') !== false) echo'active' ?>">
                            <a class="nav-link" href="<?=base_url()?>meus-pedidos">
                            <i class="fas fa-receipt"></i>Meus pedidos</a>
                        </li> 
                    <?php }?>
                    <?php if($this->usuario_logado['colaborador_tipo'] !== 'usuario'){?>
                        <li class="nav-item <?php if(isset($page_incluir) && mb_strpos($page_incluir,'pedidos-compra') !== false) echo'active' ?>">
                            <a class="nav-link" href="<?=base_url()?>pedidos-compra">
                            <i class="fas fa-receipt"></i>Pedidos de compra</a>
                        </li> 
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo text-center">
        <a href="<?=base_url()?>">
            <img src="<?=base_url()?>assets/images/logo.png" alt="LOGO" width="50%"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="<?php if(isset($page_incluir) && mb_strpos($page_incluir,'home') !== false) echo'active' ?> has-sub">
                    <a class="js-arrow" href="<?=base_url()?>">
                        <i class="fas fa-home"></i>Home</a>
                </li> 
                <?php if($this->usuario_logado['colaborador_tipo'] == 'master'){?>

                    <li class="<?php if(isset($page_incluir) && mb_strpos($page_incluir,'produtos') !== false) echo'active' ?>">
                        <a href="<?=base_url()?>produtos">
                            <i class="fas fa-box"></i>Produtos</a>
                    </li>
                    <li class="<?php if(isset($page_incluir) && mb_strpos($page_incluir,'colaborador') !== false) echo'active' ?>">
                        <a href="<?=base_url()?>colaboradores">
                            <i class="fas fa-user-cog"></i></i>Colaboradores</a>
                    </li> 
                <?php }?>
                <?php if($this->usuario_logado['colaborador_tipo'] !== 'fornecedor'){?>
                    <li class="<?php if(isset($page_incluir) && mb_strpos($page_incluir,'meus-pedidos') !== false) echo'active' ?>">
                        <a href="<?=base_url()?>meus-pedidos">
                        <i class="fas fa-receipt"></i>Meus pedidos</a>
                    </li> 
                <?php }?>
                <?php if($this->usuario_logado['colaborador_tipo'] !== 'usuario'){?>
                    <li class="<?php if(isset($page_incluir) && mb_strpos($page_incluir,'pedidos-compra') !== false) echo'active' ?>">
                        <a href="<?=base_url()?>pedidos-compra">
                        <i class="fas fa-receipt"></i>Pedidos de compra</a>
                    </li> 
                <?php }?>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->

<div class="page-container" id="page-container">
    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p10">
            <div class="container-fluid">
                <div class="header-wrap">
                    <h6><i class="fas fa-terminal"></i> Bem vindo ao <?=NOME_SITE ??'SYS'?></h6>
                    <div class="header-button">

                    <div class="account-wrap">
                        <div class="account-item dropdown">
                            <div class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="image">
                                    <img src="<?=base_url()?>/assets/images/user.png" alt="avatar" />
                                    <?=$this->session->userdata('sessao_user_nick')?>
                                </div>
                            </div>
                            <ul class="dropdown-menu account-dropdown" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item disabled" href="#">
                                        <?=$this->session->userdata('sessao_nome')?>
                                        <br>
                                        <small>
                                            <?=$this->session->userdata('sessao_usuario')?>
                                            -
                                            <?=$this->session->userdata('sessao_user_tipo')?>
                                        </small>
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="<?=base_url()?>login/sair">Sair</a></li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER DESKTOP-->
    <!-- MAIN CONTENT-->
    
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid pt-3 ps-5 pe-5">
            <?php
                if(isset($page_incluir)){
                        $this->load->view($page_incluir,$dados_page ?? array());
                }else{
                    echo'Nenhuma pagina a incluir';
                }
            ?>
            </div>
        </div>
    </div> 
    <footer>
        <div class="text-center">
            <small>
                Powered with <span style="color: tomato;">❤</span> by
                <a href="https://vrltech.com.br" class="not-decoration" target="_blank">
                    VRL TECNOLOGIA DA INFORMAÇÃO
                </a>
            </small>
        </div>
    </footer>
</div> <!-- PAGE CONTAINER -->



<button class="back-to-top d-flex align-items-center justify-content-center">
    <i class="fas fa-chevron-circle-up"></i>
</button>

<!-- Modal AVISO -->
<div class="modal fade" id="modal-aviso" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-aviso-title">AVISO</h5>
      </div>
      <div class="modal-body">
        <div id="modal-aviso-corpo">
            Atenção
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-aviso-btn" class="btn btn-secondary" data-bs-dismiss="modal">CERTO!</button>
      </div>
    </div>
  </div>
</div>
 <!-- Modal AVISO -->
 
<!-- Modal CONFIRMAÇÃO -->
<div class="modal fade" id="modal-confirmacao" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-confirmacao-title">CONFIRMAÇÃO</h5>
      </div>
      <div class="modal-body">
        <p id="modal-confirmacao-msg">
            Confirma essa ação?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-confirmacao-btn-nao" class="btn btn-secondary" data-bs-dismiss="modal">NÃO</button>
        <button type="button" id="modal-confirmacao-btn-sim" data-bs-dismiss="modal" class="btn btn-primary">SIM</button>
      </div>
    </div>
  </div>
</div>
 <!-- Modal CONFIRMAÇÃO -->
 

<div class="d-none" id="div-retorno-oculta"></div>

<script> var base_url="<?=base_url()?>"; </script>

<?php
    foreach($js_padrao as $v){?>
        <script src="<?=base_url()?><?=$v?><?='?v='.$versao?>"></script>
<?php
    }


        foreach($js_Externo_padrao as $js_E){ ?>
            <script src="<?=$js_E?>"></script>
<?php   }

    if(isset($js_Externo)){
        foreach($js_Externo as $js_E){ ?>
            <script src="<?=$js_E?>"></script>
<?php   }
    }

        
    if(isset($js)){
        foreach($js as $v){?>
            <script src="<?=base_url()?><?=$v?><?='?v='.$versao?>"></script>
<?php
        }
    }
?>
</body>
</html>