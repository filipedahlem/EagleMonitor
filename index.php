<?php
session_start();
include('conexao.php');
//Gerar senha
//echo password_hash("123456", PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
    <style>

    html, body, .wrapper{
          height: 100%;
          position:fixed;
          width:100%;
          overflow: hidden;
      }


    body{
        font-family: Arial, Helvetica, sans-serif;
        background: #d3dde9;

    }

    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    </style>
</head>

<body>
    <div class="container text-center">
        
        <?php
        if(isset($_SESSION['id']) and (isset($_SESSION['nome']))){
            echo "Olá, " . $_SESSION['nome'] . "<br>";
            echo "<a href='inicial.php'>Página Inicial</a><br>";
            echo "<a href='sair.php'>Sair</a><br>";
        }else{
            echo "<div id='dados-usuario'>";
            echo "<button type='button' class='btn btn-primary m-3' data-bs-toggle='modal' data-bs-target='#loginModal'>Acessar</button>";
            echo "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#cadUsuarioModal'>Cadastrar</button>";
            echo "</div>";
        }

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        
        ?>
        <div class="m-5">
            <span id="msgAlert"></span>
        </div>
    </div>
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Área Restrita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="login-usuario-form">
                            <span id="msgAlertErroLogin"></span>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">Usuário:</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Digite seu e-mail">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="col-form-label">Senha:</label>
                                <input type="password" name="senha" class="form-control" id="senha" autocomplete="on" placeholder="Digite sua senha">
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-outline-primary bt-sm" id="login-usuario-btn" value="Acessar">
                            </div>
                            <a href="recuperar_senha.php">Esqueceu a senha?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="cad-usuario-form">
                        <span id="msgAlertErroCad"></span>

                        <div class="mb-3">
                            <label for="cadnome" class="col-form-label">Nome:</label>
                            <input type="text" name="cadnome" class="form-control" id="cadnome" placeholder="Digite o nome completo">
                        </div>

                        <div class="mb-3">
                            <label for="cademail" class="col-form-label">E-mail:</label>
                            <input type="email" name="cademail" class="form-control" id="cademail" placeholder="Digite o seu melhor E-mail">
                        </div>

                        <div class="mb-3">
                            <label for="cadsenha" class="col-form-label">Senha:</label>
                            <input type="password" name="cadsenha" class="form-control" id="cadsenha" autocomplete="on" minlength="6" placeholder="Digite a senha">
                        </div>

                        <div class="mb-3">
                            <label for="cadtelefone" class="col-form-label">Telefone:</label>
                            <input type="text" name="cadtelefone" class="form-control" id="cadtelefone" autocomplete="on" minlength="14" placeholder="Digite seu telefone">
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-success bt-sm" id="cad-usuario-btn" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
         
        <script>
            $('#cadtelefone').mask('(00) 00000-0000');

            var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            $('#tel').mask(SPMaskBehavior, spOptions);

           
        </script>
</body>

</html>