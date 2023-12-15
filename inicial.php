<?php
session_start();
include('conexao.php');
//Gerar senha
//echo password_hash("123456", PASSWORD_DEFAULT);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="modal.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="js/scripts.js" defer></script>
    <title>Página Inicial</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
    
        }
        .img_logo_header{
            width: 150px;
            margin: 1px;
            margin-top:15px;
        }
        .header,
        .navigation_header{
            display: flex;
            flex-direction: row;
            align-items: left;
        }
        .header{
            background-color: #fff0;
            justify-content: space-between;
            padding: 0 10%;
            height: 3.5em;
            box-shadow: 1px 1px 4px #395887;
        }
        .navigation_header{
            gap: 3em;
            z-index: 2;
        }
        .content{
            padding-top: 5em;
            text-align: center;
            height: 100vh;
            transition: 1s;
        }
        .navigation_header a{
            text-decoration: none;
            color: #395887;
            transition: 1s;
            font-weight: bold;
            margin-top:15px;
        }
        .navigation_header a:hover{
            color: var(--color-white);
        }
        .active{
            background: var(--color-dark3);
            padding: 10px;
            border-radius: 10px;
        }
        .btn_icon_header{
            background: transparent;
            border: none;
            color: #849bc6;
            cursor: pointer;
            display: none;
        }
        @media screen and (max-width: 768px) {
            .navigation_header{
                position: absolute;
                flex-direction: column !important;
                top: 0;
                background: #d3dde9;
                height: 100%;
                width: 35vw;
                padding: 1em;
                animation-duration: 1s;
                margin-left: -100vw;
                font-size:14px;
            }
            .btn_icon_header{
                display: block;
                color: #395887;
            }
        }
        @keyframes showSidebar {
            from {margin-left: -100vw;}
            to {margin-left: -10vw;}
        }

        /*aqui termina o menu */       

        .usu{
            font-size: 18px;
            color:#395887;
            margin:18px;
            padding: 4px;
            font-weight: bolder;            
        }

        .container{
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 100%;
            min-height: 100%;  
        }

        .box1{  
            width:700px;
            height: 10px;
            padding: 25px;
            border-radius: 10px;
            background: #d3dde9;
            margin:0 5px;
            float:left;
            display:flex;
            align-items:center;

        }

        .box1>h2{
            font-size:14px;
            color:#395887;
            font-weight: bolder;  
            margin: 10px;
            top:0;
            right:0;
            display:flex;
        }

        .box1>i{
          font-size:24px;   
          cursor:pointer;
          color:#395887; 
          
        }

        .box2{
            width:450px;
            height: 10px;
            padding: 25px;
            border-radius: 10px;
            background: #395887;
            margin:0 5px;
            float:right;
            display:flex;
            align-items:center;
        }

        .box2>h2{
            font-size:14px;
            font-weight: bolder;  
            color:white;
            
        }
        
        /*cadastro de equipamentos abaixo*/
        
        .modal-header>h2{
            color:#395887;
            font-size: 18px;
            margin-top:10px;
        }      

        .modal-body{
            margin-top:-6px;
        }
        
        .inputBox{
            position: relative;
        }
        
        .inputBox> input{
            height: 45px;
            border: 1px solid #ebebeb;
            font-size: 15px;
            padding: 0 16px;
            border-radius: 0.8rem;
            transition: all 0.375s;
            outline:none;
        }

        .inputUser{
        width:100%;
        height: 40px;
        border: 2px solid #ebebeb;
        font-size: 15px;
        padding: 0 16px;
        border-radius: 0.8rem;
        transition: all 0.375s;
        outline:none;
        background: whitesmoke;
        letter-spacing:1px;
        }
        
      .inputBox> input:hover{
        border: 2px solid #395887;
      }

      .labeLInput{
            color:#395887;
            position:absolute;
            top: 0px;
            left: 0px;
            pointer-events:none;
            transition: .5s;
            padding: 0 10px;
            margin: 12px;
            font-size:14px;
        }

        .inputUser:focus ~ .labeLInput,
        .inputUser:valid ~ .labeLInput{
            top: -10px;
            font-size:10px;
            font-weight: bold;
            left: -5px;
        }

        .material-icons{
            border-radius: 10px;
            border:none;
        }
        

        .button{
           text-align:right;
            }

        /* Aqui comença o Toggler On/Off */
        .toggle-wrapper {
        display: flex;
        align-items: center;
        }

        /* Texto de cada Monitoramento */
        .toggle-wrapper .description {
        margin-left: 0.6rem;
        letter-spacing: 0rem;
        font-size: 0.8rem;
        color: #395887;
        }

        /* Esconde o checkbox */
        .switch > .hidden-toggle {
        display: none;
        }

        /* Caixinha onde o botão desliza */
        .switch > .slider {
        background: whitesmoke;
        border: 0.1rem solid #bbb;
        cursor: pointer;
        border-radius: 1rem;
        transition: all 300ms ease-in-out;
        width: 2rem;
        height: 1.2rem;
        position: relative;
        box-shadow: inset -0.5rem 0.5rem 0.5rem rgba(0, 0, 0, 0.2),
            0 0 1rem rgba(0, 0, 0, 0.1);
        }

        /* O botão redondinho */
        .switch > .slider > .button {
        content: "";
        position: absolute;
        width: 0.9rem;
        height: 0.9rem;
        background: #395887;
        top: 1px;
        left: 0.1rem;
        transition: all 300ms ease-in-out;
        border-radius: 50%;
        z-index: 2;
        box-shadow: inset -0.5rem 0.5rem 0.5rem rgba(0, 0, 0, 0.2);
        }

        /* Texto ON ou OFF (começa off) */
        .switch > .slider:after {
        position: absolute;
        top: 50%;
        right: 0rem;
        transform: translate(0, -50%);
        font-size: 1.4rem;
        line-height: 1.4rem;
        color: #444;
        font-weight: bold;
        z-index: 1;
        transition: all 300ms ease-in-out;
        content: "";
        }

        /* Slider ON */
        .switch > .hidden-toggle:checked ~ .slider {
        background: #395887;
        box-shadow: inset 0.5rem 0.5rem 0.5rem rgba(0, 0, 0, 0.2),
            0 0 1rem rgba(50, 0, 150, 0.2);
        }

        /* Botão ON */
        .switch > .hidden-toggle:checked ~ .slider > .button {
        left: 0.8rem;
        box-shadow: inset 0.5rem 0.5rem 0.5rem rgba(0, 0, 0, 0.2);
        background: #e0e2db;
        }

        /* Texto ON */
        .switch > .hidden-toggle:checked ~ .slider:after {
        right: 1.8rem;
        color: #f1f1ff;
        content: "";
        }

    </style>
</head>
<body id="body">
    <div class="header" id="header">
        <button onclick="toggleSidebar()" class="btn_icon_header">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
        <div class="logo_header">
            <img src="imagens/eagle2.svg" alt="Eagle Monitor" class="img_logo_header">
        </div>
        <div class="navigation_header" id="navigation_header">
            <button onclick="toggleSidebar()" class="btn_icon_header">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </button>
            <a href="inicial.php">Home</a>
            <a href="#">Empresas</a>
            <a href="#">Dispositivos</a>
            <a href="recuperar_senha.php">Alterar Senha</a>
            <a href="sair.php">Logout</a>
        </div>
    </div>

<div class="usu">
    <?php
        if(isset($_SESSION['id']) and (isset($_SESSION['nome']))){
        echo "Olá, " . $_SESSION['nome'] . "<br>";
    }
    ?>
</div>

<div class= "container">
    <div class="box1">
            <h2>Equipamentos</h2>
            <i href="#" id="open-modal" class="bi bi-plus-circle"></i>  
    
            <div id="fade" class="hide"></div>
        <div id="modal" class="hide">  
              <div class="modal-header">
                <h2>Equipamento</h2>
                <button id="close-modal" type="submit" class="material-icons">close</button>
              </div>

    <div class="modal-body">
        <form>
            <br>
                <div class="inputBox">
                    <input type="text" name="equip" id="equip" class="inputUser" required>
                    <label for="equip" class="labeLInput">Nome do Equipamento</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="grupo" id="grupo" class="inputUser" required>
                    <label for="grupo" class="labeLInput">Grupo</label>
                </div>
                <br>
                <div class="inputBox">
                <div class="toggle-wrapper">
                    <label class="switch">
                    <input type="checkbox" class="hidden-toggle"/>
                         <div class="slider">
                             <div class="button"></div>
                         </div>
                    </label>
                    <div class="description">
                    Monitora o estado do equipamento
                    </div>
                </div>
                </div>
                <br>
                <div class="inputBox">
                <div class="toggle-wrapper">
                    <label class="switch">
                    <input type="checkbox" class="hidden-toggle"/>
                        <div class="slider">
                            <div class="button"></div>
                        </div>
                    </label>
                    <div class="description">
                    Monitora o uso intenso de CPU
                    </div>
                </div>
                </div>
                <br>
                <div class="inputBox">
                <div class="toggle-wrapper">
                    <label class="switch">
                    <input type="checkbox" class="hidden-toggle"/>
                        <div class="slider">
                            <div class="button"></div>
                        </div>
                    </label>
                    <div class="description">
                    Monitora o uso insento de RAM
                    </div>
                </div>
                </div>
                <br>
                <div class="inputBox">
                <div class="toggle-wrapper">
                    <label class="switch">
                    <input type="checkbox" class="hidden-toggle"/>
                        <div class="slider">
                            <div class="button"></div>
                        </div>
                    </label>
                    <div class="description">
                    Monitora o uso intenso de Armazenamento
                    </div>
                </div>
                </div>
                <br>
                <div class="inputBox">
                <div class="toggle-wrapper">
                    <label class="switch">
                    <input type="checkbox" class="hidden-toggle"/>
                        <div class="slider">
                            <div class="button"></div>
                        </div>
                    </label>
                    <div class="description">
                    Monitora o espaço em disco
                    </div>
                </div>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="emailalerta" id="emailalerta" class="inputUser" required>
                    <label for="emailalerta" class="labeLInput">E-mail para Alerta</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="smsalerta" id="smsalerta" class="inputUser" required>
                    <label for="smsalerta" class="labeLInput">SMS para Alerta</label>
                </div>
                <br>
                <div class="button">
                <button type="reset" class="material-icons">delete</button>
                <button type="submit" class="material-icons">check</button>
                </div>     
            </form>
        </div>
    </div>
</div>
        <br><br>

        <div class="box2">
            <h2>Alertas</h2>
        </div>


</body>

        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
                    
<script>
    var header           = document.getElementById('header');
    var navigationHeader = document.getElementById('navigation_header');
    var content          = document.getElementById('content');
    var showSidebar      = false;

    function toggleSidebar()
    {
        showSidebar = !showSidebar;
        if(showSidebar)
        {
            navigationHeader.style.marginLeft = '-10vw';
            navigationHeader.style.animationName = 'showSidebar';
            content.style.filter = 'blur(2px)';
        }
        else
        {
            navigationHeader.style.marginLeft = '-100vw';
            navigationHeader.style.animationName = '';
            content.style.filter = '';
        }
    }

    function closeSidebar()
    {
        if(showSidebar)
        {
            showSidebar = true;
            toggleSidebar();
        }
    }

    window.addEventListener('resize', function(event) {
        if(window.innerWidth > 768 && showSidebar) 
        {  
            showSidebar = true;
            toggleSidebar();
        }
    });


    $('#smsalerta').mask('(00) 00000-0000');
    
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

</script>
</html>