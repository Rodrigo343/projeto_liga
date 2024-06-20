<?php 

namespace App\Controllers;

use App\Service\CartaService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class CartaController
{
    public function listaCartas(Request $request, Response $response, array $args): Response 
    {

        $cartaService = new CartaService();

        $cartas = $cartaService->buscaTodasCartas();
        $response = $response->withJson($cartas);
        
        return $response;  
    }

    public function adicionaCarta(Request $request, Response $response, array $args): Response 
    {

        $data = $request->getParsedBody();

        $cartaService = new CartaService();
        
        return $cartaService->adicionaCarta($data, $response);  

    }

    public function atualizaCarta(Request $request, Response $response, array $args): Response 
    {

        $data = $request->getParsedBody();

        $cartaService = new CartaService();
        
        return $cartaService->atualizaCarta($data, $response);  
    }

    public function inativaCarta(Request $request, Response $response, array $args): Response 
    {

        $data = $request->getParsedBody();

        $edicaoCartaService = new CartaService();
        
        return $edicaoCartaService->inativaCarta($data, $response);  

    }
}

?>