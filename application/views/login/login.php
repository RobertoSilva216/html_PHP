<?php defined('BASEPATH') OR exit('O acesso direto ao arquivo ou diretório não é permitido.');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="titulo">Login :: <?=NOME_SITE?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo.png" type="image/x-icon">
</head>
<body>

    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content" style="min-height: 80vh;">
                        <div class="login-logo">
                            <a href="">
                                <img src="<?=base_url()?>assets/images/logo.png" alt="<?=NOME_SITE?>" width="40%">
                            </a>
                        </div>
                        <h4 class="text-center mb-5" id="login-recuperar">Login</h4>
                        
                        <div id="div-login" class="login-form">
                            <form action="#" id="form-login">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control" id="usuario" name="usuario">
                                    <label for="usuario">Usuário</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input required type="password" class="form-control" id="senha" name="senha">
                                    <label for="senha">Senha</label>
                                </div>
                                <div class="row text-center mt-2">
                                    <div id="div-retorno"><!-- Resposta dos dados--> </div>
                                    <button class="offset-md-3 col-md-6 col-xs-12 btn btn-primary m-b-20 mt-2 mb-3 btn-login" type="submit">ACESSAR</button> 
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>const base_url="<?=base_url()?>";const NOME_SITE="<?=NOME_SITE?>";</script>
    <script src="<?=base_url()?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?=base_url()?>assets/js/login.js"></script>
</body>
</html>