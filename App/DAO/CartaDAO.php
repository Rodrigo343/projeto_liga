<?php 

namespace App\DAO;

use App\DAO\Conexao as DAOConexao;
use App\Models\CartaModel;

final class CartaDAO extends DAOConexao
{

    function __construct()
    {
        parent::__construct();   
    }

    public function getAllCartas() : array 
    {
        $cartas = $this->pdo->query('SELECT 
                car.id_carta,
                car.nm_carta_pt,
                car.nm_carta_en,
                car.cor,
                car.tipo,
                car.artista,
                car.raridade,
                car.imagem,
                car.descricao,
                car.preco,
                car.quantidade,
                car.id_edicao,
                ed.nm_edicao_pt,
                ed.nm_edicao_en,
                ed.dt_lancamento,
                ed.quantidade_cartas
            FROM cartas as car
            INNER JOIN edicao_cartas ed on car.id_edicao = ed.id_edicao;')->fetchAll(\PDO::FETCH_ASSOC);

        return $cartas;
    }

    public function adicionaCarta(CartaModel $carta) : void 
    {
        $statment = $this->pdo->prepare('INSERT INTO cartas VALUES (
            null, 
            :nm_carta_pt,
            :nm_carta_en,
            :cor,
            :tipo,
            :artista,
            :raridade,
            :imagem,
            :descricao,
            :preco,
            :quantidade,
            :id_edicao);'
        );
        $statment->execute([
            'nm_carta_pt'=>$carta->getNomeCartaPt(),
            'nm_carta_en'=>$carta->getNomeCartaEn(),
            'cor'=>$carta->getCor(),
            'tipo'=>$carta->getTipo(),
            'artista'=>$carta->getArtista(),
            'raridade'=>$carta->getRaridade(),
            'imagem'=>$carta->getImagem(),
            'descricao'=>$carta->getDescricao(),
            'preco'=>$carta->getPreco(),
            'quantidade'=>$carta->getQuantidade(),
            'id_edicao'=>$carta->getIdEdicao()
        ]);
    }

    public function atualizaCarta(CartaModel $carta) : void 
    {
        $statment = $this->pdo->prepare('UPDATE cartas SET
            nm_carta_pt = :nm_carta_pt,
            nm_carta_en = :nm_carta_en,
            cor = :cor,
            tipo = :tipo,
            artista = :artista,
            raridade = :raridade,
            imagem = :imagem,
            descricao = :descricao,
            preco = :preco,
            quantidade = :quantidade,
            id_edicao = :id_edicao
            WHERE nm_carta_pt = :nm_carta_pt;');
        $statment->execute([
            'nm_carta_pt'=>$carta->getNomeCartaPt(),
            'nm_carta_en'=>$carta->getNomeCartaEn(),
            'cor'=>$carta->getCor(),
            'tipo'=>$carta->getTipo(),
            'artista'=>$carta->getArtista(),
            'raridade'=>$carta->getRaridade(),
            'imagem'=>$carta->getImagem(),
            'descricao'=>$carta->getDescricao(),
            'preco'=>$carta->getPreco(),
            'quantidade'=>$carta->getQuantidade(),
            'id_edicao'=>$carta->getIdEdicao()

        ]);
    }

    public function inativaCarta(string $nomeCarta) : void 
    {
        $statment = $this->pdo->prepare('DELETE FROM cartas
            WHERE nm_carta_pt = :nm_carta_pt;');
        $statment->execute([
            'nm_carta_pt'=> $nomeCarta
        ]);
    }
}
?>