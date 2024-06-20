<?php 

namespace App\Controllers;

use App\DAO\TokenDAO;
use App\Service\TokenService;
use App\Service\UsuarioService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class AuthController
{
    public function login(Request $request, Response $response, array $args) : Response
    {

        $usuarioService = new UsuarioService();
        $usuarioService = new usuarioService();
        $tokenService = new TokenService();

        $data = $request->getParsedBody();
        $email = $data['email'];
        $senha = $data['senha'];

        $usuario = $usuarioService->buscaUsuarioPorEmail($email);

        if(!$usuarioService->validaLogin($usuario, $senha))
        {
            return $response->withStatus(401);
        }

        $token = $tokenService->enviaToken($usuario);

        $response = $response->withJson([
            "token" => $token->getToken(),
            "refresh_token" => $token->getRefreshToken()

        ]);

        return $response;  
    }

    public function logout(Request $request, Response $response, array $args) : Response
    {

        $usuarioService = new UsuarioService();
        $tokenDAO = new TokenDAO();

        $data = $request->getParsedBody();

        $email = $data['email'];

        $usuario = $usuarioService->buscaUsuarioPorEmail($email);

        $tokenDAO->inativarToken($usuario->getId());
    
        $response = $response->withJson([
            "mensagem" => "LogOut Realizado com Sucesso"

        ]);
        
        return $response;  
    }
}
?>