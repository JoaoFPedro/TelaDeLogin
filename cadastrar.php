<!DOCTYPE html>
    <?php
        require_once 'classes/usuarios.php';
        $u = new Usuario;
    ?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
   
    <title>Projeto Login</title>
    <link rel= "stylesheet" href="css/estilo.css">
</head>
<body>
 <!--Fomulario para cadastro no site -->
 <div id="corpo-form">
    <h1> Cadastrar</h1> 
    <form method="POST">
        <input type="text" name="nome" placeholder=" Nome " maxlength="30">
        <input type="text" name="telefone" id="telefone" placeholder="Digite um número de telefone" maxlength="30" />
        <input type="email" name="email" placeholder=" Usuário " maxlength="40">
        <input type="password" name="senha" placeholder=" Senha " maxlength="15">
        <input type="password" name="confSenha" placeholder=" Confirmar Senha " maxlength="15">
        <input type="submit" value="Cadastrar"> 
     
<script>
 // JS configuração número modelo (xx)x xxxx-xxxx 
                    /* Máscaras ER */
        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        function mtel(v){
            v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
            v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
            return v;
        }
        function id( el ){
            return document.getElementById( el );
        }
        window.onload = function(){
            id('telefone').onkeyup = function(){
                mascara( this, mtel );
            }
        }
</script>
    </form>   
</div>  
<!-- Pegando as informações do formulário-->
    <?php
    //verifica se cliclou no botao "Cadastrar"
    if(isset($_POST['nome'])){
        //Recebe as informações do formulário
//addslashes ->retira os comandos maliciosos ~Segurança da informação~
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email= addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha= addslashes($_POST['confSenha']);
        //Verifica se todas as infomações foram preenchidas
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)){

            $u->conectar("projeto_login", "localhost", "root", "");
            if($u->msgErro == "")//ok e conectar
            
                if($senha == $confirmarSenha){
                    if($u->cadastrar($nome,$telefone,$email,$senha)){
                        ?>
                        <div id="msg-sucesso">                      
                        <b>Cadastrado com sucesso! Agora é só acessar.</b>
                        </div>
                        <?php
                    }
                    else {
                        ?>
                    <div class="msg-erro">
                    <b> Email já cadastrado</b>
                    </div>
                        <?php
                    } 
                }
            else{

                ?>
                <div class="msg-erro">
                Senha e confirmar senha não correspondem!
                </div>
                    <?php
                
        }      
        else{
            ?>
        <div class="msg-erro">
        <?php echo "Erro: " .$u->msgErro;?>
        </div>
            <?php
        
        }
    }
    else{
        ?>
        <div class="msg-erro">
        <b>Preencha todos os campos!</b>
        </div>
            <?php
        
    }
}

    ?>
</body>
</html>
