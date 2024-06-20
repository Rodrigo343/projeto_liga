<?php 

namespace App\Models;

use DateTime;

final class TokenModel
{

    private $idToken;
    private $token;
    private $refreshToken;
    private $dataExpiracao;
    private $usuarioId;
    private $ativo;


   public function __construct(
            $idToken = null,
            $token = null,
            $refreshToken = null,
            $dataExpiracao = null,
            $usuarioId = null,
            $ativo = null
        ) 
    {
        $this->idToken = $idToken;
        $this->token = $token;
        $this->refreshToken = $refreshToken;
        $this->dataExpiracao = $dataExpiracao;
        $this->usuarioId = $usuarioId;
        $this->ativo = $ativo;
    }

    public function getId() : int 
    {
        return $this->idToken;
    }

    public function setId(string $idToken) : self 
    {
        $this->idToken = $idToken;
        return $this;
    }

    public function getToken() : string 
    {
        return $this->token;
    }

    public function setToken(string $token) : self 
    {
        $this->token = $token;
        return $this;
    }

    public function getRefreshToken() : string 
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(string $refreshToken) : self 
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    public function getDataExpiracao() : DateTime 
    {
        return $this->dataExpiracao;
    }

    public function setDataExpiracao(DateTime $dataExpiracao) : self 
    {
        $this->dataExpiracao = $dataExpiracao;
        return $this;
    }

    public function getUsuarioId() : int 
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(string $usuarioId) : self 
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function getTokenAtivo() : int 
    {
        return $this->ativo;
    }

    public function setTokenAtivo(string $ativo) : self 
    {
        $this->ativo = $ativo;
        return $this;
    }

    
}

?>