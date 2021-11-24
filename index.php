<!DOCTYPE html>
<?php 
    require_once 'classes/usuarios.php';
    $u = new Usuario;
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <title>Projeto Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <!--Fomulario para enviar email/senha -->
    <div id="corpo-form">
        <h1> Entrar</h1>
        <form method="POST">
            <input type=" email " placeholder=" Usuário " name="email">
            <input type="password" placeholder=" Senha " name="senha">
            <input type="submit" value="Acessar">
            <a href="cadastrar.php"> Não possui conta? <strong>Cadastre-se agora</strong>


        </form>
    </div>
    <?php
    if(isset($_POST['email'])){
        //Recebe as informações do formulário
        //addslashes ->retira os comandos maliciosos ~Segurança da informação~          
        $email= addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);    
        //Verifica se todas as infomações foram preenchidas
        if(!empty($email) && !empty($senha)){ 
            $u->conectar("projeto_login", "localhost", "root", "");
            if($u->msgErro == "") {
                if($u->logar($email,$senha)){
                    header("location: areaprivada.php");
                }               
           
            else{
                ?>
    <div class="msg-erro">
        "Email e/ou senha estão incorretos";
    </div>
    <?php
            }
            }
            else{
                ?>
    <div class="msg-erro">
        <?php echo "Erro: ".$u->msgErro; ?>
    </div>
    <?php              
            }
        }
        
        else{
            ?>
    <div class="msg-erro">
        Preencha todos os campos!
    </div>
    <?php
        }
    }
  ?>
</body>
</html>