<?php 

namespace App\DAO;

use App\DAO\Conexao as DAOConexao;
use App\Models\EdicaoCartaModel;

final class EdicaoDAO extends DAOConexao
{

    function __construct()
    {
        parent::__construct();   
    }

    public function adicionaEdicao(EdicaoCartaModel $edicaoCarta) : void 
    {
        $statment = $this->pdo->prepare('INSERT INTO edicao_cartas VALUES (
            null, :nm_edicao_pt, :nm_edicao_en, :dt_lancamento, :quantidade_cartas);');
        $statment->execute([
            'nm_edicao_pt'=>$edicaoCarta->getNomeEdicaoPt(), 
            'nm_edicao_en'=>$edicaoCarta->getNomeEdicaoEn(), 
            'dt_lancamento'=>$edicaoCarta->getDataLancamento()->format('Y-m-d H:i:s'),
            'quantidade_cartas'=>$edicaoCarta->getQuantidadeCartas()
        ]);
    }

    public function atualizaEdicao(EdicaoCartaModel $edicaoCarta) : void 
    {
        $statment = $this->pdo->prepare('UPDATE edicao_cartas SET 
            nm_edicao_pt = :nm_edicao_pt, 
            nm_edicao_en =:nm_edicao_en, 
            dt_lancamento = :dt_lancamento, 
            quantidade_cartas = :quantidade_cartas
            WHERE nm_edicao_pt = :nm_edicao_pt;'
            );
        $statment->execute([
            'nm_edicao_pt'=>$edicaoCarta->getNomeEdicaoPt(), 
            'nm_edicao_en'=>$edicaoCarta->getNomeEdicaoEn(), 
            'dt_lancamento'=>$edicaoCarta->getDataLancamento()->format('Y-m-d H:i:s'),
            'quantidade_cartas'=>$edicaoCarta->getQuantidadeCartas()

        ]);
    }

    public function inativaEdicao(string $nomeEdicao) : void 
    {
        $statment = $this->pdo->prepare('DELETE FROM edicao_cartas
            WHERE nm_edicao_pt = :nm_edicao_pt;');
        $statment->execute([
            'nm_edicao_pt'=> $nomeEdicao
        ]);
    }
}
?>