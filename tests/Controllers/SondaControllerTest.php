<?php

class SondaControllerTest extends TestCase
{
    public function testResetar()
    {
        $this->delete('/resetar');
        $this->assertResponseStatus(204, $this->response->status());
    }

    public function testExecutarComandos()
    {
        $this->delete('/resetar');

        $comandos = ['GE', 'M', 'M', 'M', 'GD', 'M', 'M'];

        $this->put("/executar-comandos", compact('comandos'))->seeJsonEquals([
            'x' => 2,
            'y' => 3,
            'sentido' => 'D'
        ]);
    }

    public function testExecutarComandosErroEixoX()
    {
        $this->delete('/resetar');

        $comandos = ['M', 'M', 'M', 'M', 'M'];

        $this->put("/executar-comandos", compact('comandos'))->seeJsonEquals([
            'erro' => 'A sonda não pode mais se mover no eixo: X',
        ]);
    }

    public function testExecutarComandosErroEixoY()
    {
        $this->delete('/resetar');

        $comandos = ['GE', 'M', 'M', 'M', 'M', 'M'];

        $this->put("/executar-comandos", compact('comandos'))->seeJsonEquals([
            'erro' => 'A sonda não pode mais se mover no eixo: Y',
        ]);
    }

    public function testExecutarComandosErroComandoNaoExiste()
    {
        $this->delete('/resetar');

        $comandos = ['XXX'];

        $this->put("/executar-comandos", compact('comandos'))->seeJsonEquals([
            'erro' => "O comando 'XXX' não existe",
        ]);
    }

    public function testPosicaoAtual()
    {
        $this->delete('/resetar');

        $comandos = [
            'GE', 'GE', 'GE', 'GE',
            'GD', 'GD', 'GD', 'GD',
            'GE', 'M', 'M', 'M', 'M',
            'GD', 'M', 'M', 'M', 'M',
            'GD', 'M', 'M', 'M', 'M',
            'GD', 'M', 'M', 'M', 'M',
        ];

        $this->put("/executar-comandos", compact('comandos'));

        $this->get("/posicao-atual")->seeJsonEquals([
            'x' => 0,
            'y' => 0,
            'sentido' => 'E'
        ]);
    }
}
