<?php

Class Usuario{

    private $pdo; // -> variavel que será usada nas 3 funções
    public $msgErro = ""; //tudo ok
    //Faz a conexão com o BD
    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
    //Conectando com o BD
    try {
        $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);   
    }
     catch (PDOException $e) {
        
        $msgErro = $e->getMessage();
        print_r($e);       
    }
     
    }

    //Envia as informações para o BD
    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
            //verificar se ja existe o email cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios 
                WHERE email = :e");
            $sql ->bindValue(":e",$email);
            $sql ->execute();
            if($sql->rowCount() > 0){
                return false; //ja cadastrado
            }
            else{
                //se não, cadastrar
                //md5 criptografa a senha
                $sql = $pdo ->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s )");
                $sql ->bindValue(":n",$nome);
                $sql ->bindValue(":t",$telefone);
                $sql ->bindValue(":e",$email);
                $sql ->bindValue(":s",md5($senha));
                $sql ->execute();
                    return true; //cadastrado com sucesso \0/
            }
    }
    //Verifica se a pessoa está cadastrada, se sim, faz o login    
    public function logar($email, $senha){
        global $pdo;
        //Verifica se o email e a senha estão cadastrados, se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":s", md5($senha));
        $sql->execute();
        if($sql-> rowCount() > 0){
            //Entrar no sistema (sessao)
            $dado = $sql ->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //logado com sucesso
        }
        else{
            return false; //nao foi possivel logar
        } 
    }
}
?>