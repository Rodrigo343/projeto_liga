<?php 

namespace App\DAO;

use App\DAO\Conexao;
use App\Models\TokenModel;
use DateTime;

class TokenDAO extends Conexao
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function getTokenByUserId(string $idUsuario) : ?TokenModel
    {
        $token = new TokenModel();
        $statement =$this->pdo->prepare("SELECT 
                    id_token,
                    id_usuario,
                    token,
                    refresh_token,
                    dt_expiracao,
                    ativo
                FROM tokens
                WHERE id_usuario = :id_usuario
            ");

        $statement->bindParam('id_usuario', $idUsuario);
        $statement->execute();
        $rs = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if(!$rs){
            return null;
        }
        
        $token = new TokenModel(
            $rs[0]['id_token'],
            $rs[0]['token'],
            $rs[0]['refresh_token'],
            new DateTime($rs[0]['dt_expiracao']),
            $rs[0]['id_usuario'],
            $rs[0]['ativo']
        );

        return $token;
    }
        
    public function criarToken(TokenModel $token) : void
    {
        $statement = $this->pdo->prepare('INSERT INTO tokens (
                    token,
                    refresh_token,
                    dt_expiracao,
                    id_usuario
                ) VALUES (
                    :token,
                    :refresh_token,
                    :dt_expiracao,
                    :id_usuario
                );'
            );

        $statement->execute([
            'token' => $token->getToken(),
            'refresh_token'=> $token->getRefreshToken(),
            'dt_expiracao'=> $token->getDataExpiracao()->format('Y-m-d H:i:s'),
            'id_usuario'=> $token->getUsuarioId()
        ]);
    }

    public function atualizaToken(TokenModel $token) : void 
    {
        $statment = $this->pdo->prepare('UPDATE tokens SET
            token = :token,
            refresh_token = :refresh_token,
            dt_expiracao = :dt_expiracao,
            ativo = :ativo
            WHERE id_usuario = :id_usuario;');
        $statment->execute([
            'token'=>$token->getToken(),
            'refresh_token'=>$token->getRefreshToken(),
            'dt_expiracao'=>$token->getDataExpiracao()->format('Y-m-d H:i:s'),
            'ativo'=>$token->getTokenAtivo(),
            'id_usuario'=>$token->getUsuarioId()
        ]);
    }

    public function verifyRefreshToken(string $refreshToken): bool 
    {
        $statement = $this->pdo->prepare('SELECT 
                id_token
            FROM tokens
            WHERE refresh_token = :refresh_token');
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return count($tokens) === 0 ? false : true;
    }

    public function inativarToken(string $idUsuario) : void {
        $statment = $this->pdo->prepare('UPDATE tokens SET ativo = 0 
            WHERE id_usuario = :id_usuario;');
        $statment->execute([
            'id_usuario'=> $idUsuario
        ]);
    }
}

?>