<?php 

namespace App\Models;

use DateTime;

final class EdicaoCartaModel
{

    private $idEdicao;
    private $nmEdicaoPt;
    private $nmEdicaoEn;
    private $dtLancamento;
    private $quantidadeCartas;

    public function __construct(
            int $idEdicao = null, 
            string $nmEdicaoPt = null, 
            string $nmEdicaoEn = null, 
            DateTime $dtLancamento = null, 
            int $quantidadeCartas = null
        ) 
    {
        $this->idEdicao = $idEdicao;
        $this->nmEdicaoPt = $nmEdicaoPt;
        $this->nmEdicaoEn = $nmEdicaoEn;
        $this->dtLancamento = $dtLancamento;
        $this->quantidadeCartas = $quantidadeCartas;
    }

    public function getIdEdicao() : int 
    {
        return $this->idEdicao;
    }

    public function getNomeEdicaoPt() : string 
    {
        return $this->nmEdicaoPt;
    }

    public function setNomeEdicaoPt(string $nmEdicaoPt) : self 
    {
        $this->nmEdicaoPt = $nmEdicaoPt;
        return $this;
    }

    public function getNomeEdicaoEn() : string 
    {
        return $this->nmEdicaoEn;
    }

    public function setNomeEdicaoEn(string $nmEdicaoEn) : self 
    {
        $this->nmEdicaoEn = $nmEdicaoEn;
        return $this;
    }

    public function getDataLancamento() : DateTime 
    {
        return $this->dtLancamento;
    }

    public function setDataLancamento(DateTime $dtLancamento) : self 
    {
        $this->dtLancamento = $dtLancamento;
        return $this;
    }

    public function getQuantidadeCartas() : int 
    {
        return $this->quantidadeCartas;
    }

    public function setQuantidadeCartas(int $quantidadeCartas) : self 
    {
        $this->quantidadeCartas = $quantidadeCartas;
        return $this;
    }
}

?>