<?php 

namespace App\Service;

use App\Cache\CartaCache;
use App\DAO\CartaDAO;
use App\Models\CartaModel;
use App\Utils\ValidacaoUtil;
use Psr\Http\Message\ResponseInterface as Response;
use Exception;
use TypeError;

final class CartaService
{
    public function adicionaCarta(array $data, Response $response)
    {
        try
        {

            $validacaoUtil = new ValidacaoUtil();

            if (!$validacaoUtil->validaNull($data)) 
            {
                return $response->withJson([
                    'error' => \InvalidArgumentException::class,
                    'status' => 400,
                    'code' => '001',
                    'userMessage' => 'Erro ao inserir, campo vazio encontrado'
                ], 400);
            }

            $cartaDAO = new CartaDAO(); 
            $carta = new CartaModel(
                null,
                $data['nm_carta_pt'],
                $data['nm_carta_en'],
                $data['cor'],
                $data['tipo'],
                $data['artista'],
                $data['raridade'],
                $data['imagem'],
                $data['descricao'],
                $data['preco'],
                $data['quantidade'],
                $data['id_edicao']
            );
            $cartaDAO->adicionaCarta($carta);
    
            $this->buscaTodasCartas(true);
                
            return $response->withJson(['message'=>'Carta inserida com sucesso']);

        }catch (TypeError $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao adicionar carta, enviar os dados corretamente',
                'developerMessage' => $ex->getMessage()], 400);
        }catch (Exception $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao adicionar carta',
                'developerMessage' => $ex->getMessage()], 400);
        }

    }

    public function atualizaCarta(array $data, Response $response) : Response
    {
        try 
        {

            $validacaoUtil = new ValidacaoUtil();
            
            if (!$validacaoUtil->validaNull($data)) 
            {
                return $response->withJson([
                    'error' => \InvalidArgumentException::class,
                    'status' => 400,
                    'code' => '001',
                    'userMessage' => 'Erro ao atualizar, campo vazio encontrado'
                ], 400);
            }

            $cartaDAO = new CartaDAO(); 
            $carta = new CartaModel(
                null,
                $data['nm_carta_pt'],
                $data['nm_carta_en'],
                $data['cor'],
                $data['tipo'],
                $data['artista'],
                $data['raridade'],
                $data['imagem'],
                $data['descricao'],
                $data['preco'],
                $data['quantidade'],
                $data['id_edicao']
            );
    
            $cartaDAO->atualizaCarta($carta);
                
            $this->buscaTodasCartas(true);
    
            return $response->withJson(['message'=>'Carta atualizada com sucesso']);

        }catch (TypeError $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao atualizar carta, enviar os dados corretamente',
                'developerMessage' => $ex->getMessage()], 400);
        }catch (Exception $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao atualizar carta',
                'developerMessage' => $ex->getMessage()], 400);
        }

    }

    public function inativaCarta(array $data, Response $response) : Response
    {
        $validacaoUtil = new ValidacaoUtil();

        if (!$validacaoUtil->validaNull($data)) 
        {
            return $response->withJson([
                'error' => \InvalidArgumentException::class,
                'status' => 400,
                'code' => '001',
                'userMessage' => 'Erro ao inativar, campo vazio encontrado'
            ], 400);
        }

        $edicaoDao = new CartaDAO(); 
        $edicaoDao->inativaCarta($data['nm_carta_pt']);
            
        return $response->withJson(['message'=>'Carta inativada com sucesso']);
    }

    public function buscaTodasCartas(bool $utilzaBanco = false) : array
    {
        $cartaCache = new CartaCache();
        
        if($cartaCache->recuperarCartasCache() === null || $utilzaBanco)
        {
            $cartaDAO = new CartaDAO();
            $cartas = $cartaDAO->getAllCartas();
            $cartaCache->salvarCartasCache($cartas);

        }else
        {
            $cartas = $cartaCache->recuperarCartasCache();
        }

        return $cartas;
    }

}

?>