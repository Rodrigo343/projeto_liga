<?php 

namespace App\Middlewares;

use App\Service\TokenService;
use App\Service\UsuarioService;
use DateTime;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

final class JwtMiddleware
{

    public function __invoke(Request $request, Response $response, callable $next) : Response
    {
        $usuarioService = new UsuarioService();
        $tokenService = new TokenService();

        $token = $request->getAttribute('jwt');
        $expiredDate = new DateTime($token['data_expiracao']->date);
        $now = new DateTime();

        if($expiredDate<$now)
        {
            return $response->withStatus(401);
        }

        $usuario = $usuarioService->buscaUsuarioPorEmail($token['email']);
        $tokenModel = $tokenService->buscaTokenPorIdUsuario($usuario);

        if ($tokenModel->getTokenAtivo() === 0) 
        {
            return $response->withStatus(401);
        }
        $response = $next($request, $response);
        return $response;
        
    }
}

?>