<?php 

namespace App\Controllers;

use App\Service\EdicaoCartaService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class EdicaoCartaController 
{
    public function adicionaEdicao(Request $request, Response $response, array $args): Response 
    {

        $data = $request->getParsedBody();

        $edicaoCartaService = new EdicaoCartaService();
        
        return $edicaoCartaService->adicionaEdicao($data, $response);  

    }

    public function atualizaEdicao(Request $request, Response $response, array $args): Response 
    {

        $data = $request->getParsedBody();

        $edicaoCartaService = new EdicaoCartaService();
        
        return $edicaoCartaService->atualizaEdicao($data, $response);  
    }

    public function inativaEdicao(Request $request, Response $response, array $args): Response 
    {

        $data = $request->getParsedBody();

        $edicaoCartaService = new EdicaoCartaService();
        
        return $edicaoCartaService->inativaEdicao($data, $response);  
    }


}

?>