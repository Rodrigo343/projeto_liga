<?php 

namespace App\Service;

use App\DAO\TokenDAO;
use App\Models\TokenModel;
use App\Models\UsuarioModel;
use Firebase\JWT\JWT;
use DateTime;

class TokenService
{

    public function geraPayload(UsuarioModel $usuario, DateTime $dataExpiracao = null, string $tipoPayload) : array
    {
        $payload = [
            'email' => $usuario->getEmail(),
            'ramdom' => uniqid()
        ];

        if($tipoPayload === "token")
        {
            $tokenPayload = [            
                'sub' => $usuario->getId(),
                'name' => $usuario->getNome(),
                'data_expiracao' => $dataExpiracao
            ];
    
            $payload  = array_merge($payload, $tokenPayload);
            return $payload;
        }

        return $payload;
    }

    public function geraToken(array $payload) : string
    {
        $token = JWT::encode($payload, getenv('JWT_SECRET_KEY'));

        return $token;
    }
    
    public function buscaTokenPorIdUsuario(UsuarioModel $usuario) : ?TokenModel
    {
        $tokenDAO = new TokenDAO();
        $token = new TokenModel();
        $token = $tokenDAO->getTokenByUserId($usuario->getId());
        return $token;
    }

    public function existToken(UsuarioModel $usuario) : bool
    {
        $token = $this->buscaTokenPorIdUsuario($usuario);
        if ($token) 
        {
            return true;
        }

        return false;
    }

    public function enviaToken(UsuarioModel $usuario) : TokenModel
    {
        $tokenDAO = new TokenDAO();
        $dataExpiracao = new DateTime();
        $dataExpiracao->modify('+12 hours');

        $tokenPayload = $this->geraPayload($usuario, $dataExpiracao, "token");
        $token = $this->geraToken($tokenPayload);

        $refreshTokenPayload = $this->geraPayload($usuario, null, "refresh");
        $refreshToken = $this->geraToken($refreshTokenPayload);

        if(!$this->existToken($usuario))
        {

            $tokenModel = new TokenModel(null, $token, $refreshToken, $dataExpiracao, $usuario->getId());
    
            $tokenDAO->criarToken($tokenModel);
            return $tokenModel;
        }

        $tokenModel = $this->buscaTokenPorIdUsuario($usuario);
        $tokenModel->setDataExpiracao($dataExpiracao)
            ->setTokenAtivo(1)
            ->setToken($token)
            ->setRefreshToken($refreshToken);
        
        $tokenDAO->atualizaToken($tokenModel);

        return $tokenModel;

    }


}

?>