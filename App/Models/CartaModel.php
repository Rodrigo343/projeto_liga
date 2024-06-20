<?php 

namespace App\Models;

final class CartaModel
{
    private $idCarta;
    private	$nmCartaPt;
    private	$nmCartaEn;
    private	$cor;
    private	$tipo;
    private	$artista;
    private	$raridade;
    private	$imagem;
    private	$descricao;
    private	$preco;
    private	$quantidade;
    private	$idEdicao;
    
    public function __construct(
            int $idCarta = null,
            string $nmCartaPt = null,
            string $nmCartaEn = null,
            string $cor = null,
            string $tipo = null,
            string $artista = null,
            string $raridade = null,
            string $imagem = null,
            string $descricao = null,
            float $preco = null,
            int $quantidade = null,
            int $idEdicao = null
        ) 
    {
        $this->idCarta = $idCarta;
        $this->nmCartaPt = $nmCartaPt;
        $this->nmCartaEn = $nmCartaEn;
        $this->cor = $cor;
        $this->tipo = $tipo;
        $this->artista = $artista;
        $this->raridade = $raridade;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
        $this->idEdicao = $idEdicao;
    }

    public function getIdCarta() : int 
    {
        return $this->idCarta;
    }

    public function getNomeCartaPt() : string 
    {
        return $this->nmCartaPt;
    }

    public function setNomeCartaPt(string $nmCartaPt) : self 
    {
        $this->nmCartaPt = $nmCartaPt;
        return $this;
    }

    public function getNomeCartaEn() : string 
    {
        return $this->nmCartaEn;
    }

    public function setNomeCartaEn(string $nmCartaEn) : self 
    {
        $this->nmCartaEn = $nmCartaEn;
        return $this;
    }

    public function getCor() : string 
    {
        return $this->cor;
    }

    public function setCor(string $cor) : self 
    {
        $this->cor = $cor;
        return $this;
    }

    public function getTipo() : string 
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo) : self 
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getArtista() : string 
    {
        return $this->artista;
    }

    public function setArtista(string $artista) : self 
    {
        $this->artista = $artista;
        return $this;
    }

    public function getRaridade() : string 
    {
        return $this->raridade;
    }

    public function setRaridade(string $raridade) : self 
    {
        $this->raridade = $raridade;
        return $this;
    }

    public function getImagem() : string 
    {
        return $this->imagem;
    }

    public function setImagem(string $imagem) : self 
    {
        $this->imagem = $imagem;
        return $this;
    }

    public function getDescricao() : string 
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao) : self 
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getPreco() : float 
    {
        return $this->preco;
    }

    public function setPreco(string $preco) : self 
    {
        $this->preco = $preco;
        return $this;
    }

    public function getQuantidade() : int 
    {
        return $this->quantidade;
    }

    public function setQuantidade(string $quantidade) : self 
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getIdEdicao() : int 
    {
        return $this->idEdicao;
    }

    public function setIdEdicao(string $idEdicao) : self 
    {
        $this->idEdicao = $idEdicao;
        return $this;
    }
}

?>