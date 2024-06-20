<?php 

namespace App\Models;

final class UsuarioModel
{

    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __construct($id = null, $nome = null, $email = null, $senha = null) 
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getId() : int 
    {
        return $this->id;
    }

    public function setId(int $id) : self 
    {
        $this->id = $id;
        return $this;
    }

    public function getNome() : string 
    {
        return $this->nome;
    }

    public function setNome(string $nome) : self 
    {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail() : string 
    {
        return $this->email;
    }

    public function setEmail(string $email) : self 
    {
        $this->email = $email;
        return $this;
    }

    public function getSenha() : string 
    {
        return $this->senha;
    }

    public function setSenha(string $senha) : self 
    {
        $this->senha = $senha;
        return $this;
    }
}

?>