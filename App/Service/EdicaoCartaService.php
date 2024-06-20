<?php 

namespace App\Service;

use App\DAO\EdicaoDAO;
use App\Models\EdicaoCartaModel;
use App\Utils\ValidacaoUtil;
use DateTime;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use TypeError;

final class EdicaoCartaService
{
    public function adicionaEdicao(array $data, Response $response)
    {
        try{

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

            $edicaoDao = new EdicaoDAO(); 
            $edicaoCarta = new EdicaoCartaModel(
                    null,
                    $data['nm_edicao_pt'],
                    $data['nm_edicao_en'],
                    new DateTime($data['dt_lancamento']),
                    $data['quantidade_cartas']
                );

            $edicaoDao->adicionaEdicao($edicaoCarta);
                
            return $response->withJson(['message'=>'Edição de cartas inserida com sucesso']);

        }catch (TypeError $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao adicionar edição, enviar os dados corretamente',
                'developerMessage' => $ex->getMessage()], 400);
        }catch (Exception $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao adicionar Edição',
                'developerMessage' => $ex->getMessage()], 400);
        }

    }

    public function atualizaEdicao(array $data, Response $response) : Response
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

            $edicaoDao = new EdicaoDAO();
            $edicaoCarta =new EdicaoCartaModel(
                null,
                $data['nm_edicao_pt'],
                $data['nm_edicao_en'],
                new DateTime($data['dt_lancamento']),
                $data['quantidade_cartas']
            );

            $edicaoDao->atualizaEdicao($edicaoCarta);

            return $response->withJson(['message'=>'Edição de cartas atualizada com sucesso']);

        }catch (TypeError $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao atualizar Edição, enviar os dados corretamente',
                'developerMessage' => $ex->getMessage()], 400);
        }catch (Exception $ex)
        {
            return $response->withJson([
                'error' => TypeError::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Erro ao atualizar Edição',
                'developerMessage' => $ex->getMessage()], 400);
        }

    }

    public function inativaEdicao(array $data, Response $response) : Response
    {
        $validacaoUtil = new ValidacaoUtil();

        if (!$validacaoUtil->validaNull($data)) 
        {
            return $response->withJson([
                'error' => \InvalidArgumentException::class,
                'status' => 400,
                'code' => '001',
                'userMessage' => 'Erro ao intativar, campo vazio encontrado'
            ], 400);
        }

        $edicaoDao = new EdicaoDAO(); 
        $edicaoDao->inativaEdicao($data['nm_edicao_pt']);
            
        return $response->withJson(['message'=>'Edição de cartas inativada com sucesso']);
    }

}

?>