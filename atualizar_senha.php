<?php
session_start();
ob_start();
include_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Senha</title>

    <style>

*{
        margin: 0;
        padding: 0;
    }
    
    body{
        width: 100%;
        height: 100vh;
        font-family: Arial, Helvetica, sans-serif;
        background: #d3dde9;      
    }

    .box{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        background: #395887;
        padding: 70px 70px 70px;
        border-radius:20px;
    }

    input{
    border: 1px solid #ebebeb;
    padding: 0 20px;
    border-radius: 0.8rem;
    transition: all 0.375s;
    height: 30px;
    }
       
    .title{
        color: white;
        font-size: 24px;
        text-align: center;
        font-weight: bolder;
    }
    .btn{
       background:#395887;
       color:white;
       cursor:pointer;
    }

    .title{
          color: white;
          font-size: 24px;
          text-align: center;
          font-weight: bolder;
    }
    

    </style>
</head>

<body>
    
    <?php
    $chave_recuperar_senha = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);
    
    
    if (!empty($chave_recuperar_senha)) {
        //var_dump($chave);
        
        $query_usuario = "SELECT id 
                            FROM usuarios 
                            WHERE recuperar_senha =:recuperar_senha  
                            LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
        $result_usuario->execute();
        
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //var_dump($dados);
            if (!empty($dados['SendNovaSenha'])) {
                $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
                $recuperar_senha = 'NULL';
                
                $query_up_usuario = "UPDATE usuarios 
                        SET senha =:senha,
                        recuperar_senha =:recuperar_senha
                        WHERE id =:id 
                        LIMIT 1";
                $result_up_usuario = $conn->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);
                
                if ($result_up_usuario->execute()) {
                    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'<p style='color: green'>Senha atualizada com sucesso!</p></div>";
                    header("Location: index.php");
                } else {
                    echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                }
            }
        } else {
            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
            header("Location: recuperar_senha.php");
        }
    }   else {
        $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
        header("Location: recuperar_senha.php");
    } 
    
    ?>

<form method="POST" action="">
    <?php
        $usuario = "";
        if (isset($dados['senha'])) {
            $usuario = $dados['senha'];
        } ?>

<div class="box">
    <h2 class="title">Atualizar Senha</h2><br><br>
        <input type="password" class="input" name="senha" placeholder="Digite a nova senha" required minlength="6" value="<?php echo $usuario; ?>"><br><br>
        <input type="submit" class="btn btn-outline-primary bt-sm" value="Atualizar" name="SendNovaSenha">
    </form>
        
</div>

</body>

</html>