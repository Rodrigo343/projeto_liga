<?php 

namespace App\DAO;

use App\DAO\Conexao as DAOConexao;
use App\Models\UsuarioModel;

class UsuarioDAO extends DAOConexao
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getUserByEmail(string $email) : ?UsuarioModel
    {
        $statement =$this->pdo->prepare("SELECT 
                    id_usuario,
                    email,
                    nome,
                    senha
                FROM usuarios
                WHERE email = :email
            ");

        $statement->bindParam('email', $email);
        $statement->execute();
        $rs = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if (!$rs) 
        {
            return null;
        }

        $usuario = new UsuarioModel(
                $rs[0]['id_usuario'],
                $rs[0]['nome'],
                $rs[0]['email'],
                $rs[0]['senha']
            );
            
        return $usuario;

    }
}

?>