<?php 

namespace App\Service;

use App\DAO\UsuarioDAO;
use App\Models\UsuarioModel;

final class UsuarioService
{

    public function validaLogin(UsuarioModel $usuario = null, string $senha) : bool
    {
        if(is_null($usuario))
        {
            return false;
        }

        if(!password_verify($senha, $usuario->getSenha()))
        {
            return false;
        }

        return true;
    }

    public function buscaUsuarioPorEmail(string $email) : ?UsuarioModel
    {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getUserByEmail($email);

        return $usuario;
    }


}

?>