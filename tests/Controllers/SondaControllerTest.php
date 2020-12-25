<?php

class SondaControllerTest extends TestCase
{
    public function testResetar()
    {
        $this->get('/resetar');
        $this->assertResponseStatus(200, $this->response->status());
    }

    public function testExecutarComandos()
    {
        $this->get('/resetar');

        $comandos = http_build_query([
            'c' => ['GE', 'M', 'M', 'M', 'GD', 'M', 'M']
        ]);

        $this->get("/executar-comandos?{$comandos}")->seeJsonEquals([
            'x' => 2,
            'y' => 3,
            'sentido' => 'D'
        ]);
    }

    public function testExecutarComandosErroEixoX()
    {
        $this->get('/resetar');

        $comandos = http_build_query([
            'c' => ['M', 'M', 'M', 'M', 'M']
        ]);

        $this->get("/executar-comandos?{$comandos}")->seeJsonEquals([
            'erro' => 'A sonda não pode mais se mover no eixo: X',
        ]);
    }

    public function testExecutarComandosErroEixoY()
    {
        $this->get('/resetar');

        $comandos = http_build_query([
            'c' => ['GE', 'M', 'M', 'M', 'M', 'M']
        ]);

        $this->get("/executar-comandos?{$comandos}")->seeJsonEquals([
            'erro' => 'A sonda não pode mais se mover no eixo: Y',
        ]);
    }

    public function testExecutarComandosErroComandoNaoExiste()
    {
        $this->get('/resetar');

        $comandos = http_build_query([
            'c' => ['XXX']
        ]);

        $this->get("/executar-comandos?{$comandos}")->seeJsonEquals([
            'erro' => "O comando 'XXX' não existe",
        ]);
    }

    public function testPosicaoAtual()
    {
        $this->get('/resetar');

        $comandos = http_build_query([
            'c' => [
                'GE', 'GE', 'GE', 'GE',
                'GD', 'GD', 'GD', 'GD',
                'GE', 'M', 'M', 'M', 'M',
                'GD', 'M', 'M', 'M', 'M',
                'GD', 'M', 'M', 'M', 'M',
                'GD', 'M', 'M', 'M', 'M',
            ]
        ]);

        $this->get("/executar-comandos?{$comandos}");

        $this->get("/posicao-atual")->seeJsonEquals([
            'x' => 0,
            'y' => 0,
            'sentido' => 'E'
        ]);
    }
}
