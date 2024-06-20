<?php

use App\Models\UsuarioModel;
use App\Service\UsuarioService;
use PHPUnit\Framework\TestCase;

final class UsuarioServiceTest extends TestCase
{
    public function testValidaLoginComUsuarioNull(): void
    {
        $usuario = null;
        $usuarioService = new UsuarioService();

        $this->assertFalse($usuarioService->validaLogin($usuario, 'Senhas'));
    }
}

?>