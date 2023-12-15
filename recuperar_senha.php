<?php
session_start();
ob_start();
include_once 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './lib/vendor/autoload.php';
$mail = new PHPMailer(true);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Recuperação de Senha</title>

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
        padding: 70px 70px 25px;
        border-radius:20px;
    }

    input{
    border: 2px solid #ebebeb;
    padding: 0 10px;
    border-radius: 1.25rem;
    transition: all 0.375s;
    }

    .rec{
        text-align:left;
        color:white;
    }

    .rec>a{
        color: white;
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
       border-radius:20px;
      }
    
    </style>
</head>

<body>
    
    <div class= "box"> 
        <h2 class="title">Recuperar Senha</h2><br>
        
        <form method="POST" action="">
            
            <?php
                            $usuario = "";
                            if (isset($dados['usuario'])) {
                                $usuario = $dados['usuario'];
                            } ?>
    
            <input class="input" type="text" name="email" placeholder="Digite seu E-mail" value="<?php echo $usuario; ?>"><br><br>
            <input class="btn btn-outline-primary bt-sm" type="submit" value="Recuperar" name="SendRecupSenha"><br><br>
        </form>
        <div class="rec">
            Lembrou? <a href="index.php">Clique aqui</a><br><br>
        </div>
        <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados['SendRecupSenha'])) {
        //var_dump($dados);
        $query_usuario = "SELECT id, nome, email 
                    FROM usuarios 
                    WHERE email =:email  
                    LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $result_usuario->execute();
        
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $chave_recuperar_senha = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
            //echo "Chave $chave_recuperar_senha <br>";
            
            $query_up_usuario = "UPDATE usuarios 
                        SET recuperar_senha =:recuperar_senha 
                        WHERE id =:id 
                        LIMIT 1";
            $result_up_usuario = $conn->prepare($query_up_usuario);
            $result_up_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
            $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);
            
            if ($result_up_usuario->execute()) {
                $link = "http://localhost/eaglemonitor/atualizar_senha.php?chave=$chave_recuperar_senha";
                
                try {
                    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host       = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '6789f4cc9bb3db';
                    $mail->Password   = 'def5fed6b3aef3';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 2525;
                    
                    $mail->setFrom('atendimento@eaglemonitor.com', 'Atendimento');
                    $mail->addAddress($row_usuario['email'], $row_usuario['nome']);
                    
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Recuperar senha';
                    $mail->Body    = 'Prezado(a) ' . $row_usuario['nome'] .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br><br><br><strong>Atenciosamente</strong>, Equipe Eagle Monitor.<br><br>";
                    $mail->AltBody = 'Prezado(a) ' . $row_usuario['nome'] ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n\n\nAtenciosamente, Equipe Eagle Monitor.\n\n";
                    
                    $mail->send();
                    
                    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'<p style='color: green'>Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!</p></div>";
                    header("Location: index.php");
                } catch (Exception $e) {
                    echo "Erro: E-mail não enviado com sucesso. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo  "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
            }
        } else {
            echo "<p style='color: #ff0000'>Erro: Usuário não encontrado!</p>";
        }
    }
    
    if (isset($_SESSION['msg_rec'])) {
        echo $_SESSION['msg_rec'];
        unset($_SESSION['msg_rec']);
    }
    
    ?>


</div>       

</body>

</html>