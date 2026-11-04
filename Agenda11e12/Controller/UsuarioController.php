<?php
if(!isset($_SESSION))
{
    session_start();
}

class UsuarioController {

    public function inserir($nome, $cpf, $email, $senha) {
        require_once dirname(__DIR__) . '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setSenha($senha);
        
        $r = $usuario->inserirBD();
        return $r;
    }

    public function login($cpf, $senha) {
        require_once dirname(__DIR__) . '../Model/Usuario.php';
        $usuario = new Usuario();
        
        // Carrega o usuário pelo CPF
        if ($usuario->carregarUsuario($cpf)) {
            // Verifica se a senha confere
            if ($usuario->getSenha() == $senha) {
                // Guarda o objeto usuário serializado na sessão
                $_SESSION['Usuario'] = serialize($usuario);
                return true;
            }
        }
        return false;
    }

    public function atualizar($id, $nome, $cpf, $email, $dataNascimento) {
        require_once dirname(__DIR__) . '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setID($id);
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setDataNascimento($dataNascimento);
        
        $r = $usuario->atualizarBD();
        
        // Atualiza os dados na sessão se der certo
        if ($r) {
            $usuario->carregarUsuario($cpf);
            $_SESSION['Usuario'] = serialize($usuario);
        }
        
        return $r;
    }
}
?>