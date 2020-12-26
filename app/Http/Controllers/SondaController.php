<?php

namespace App\Http\Controllers;

use App\Helpers\SondaEspacial;
use Illuminate\Http\Request;

class SondaController extends Controller
{
    protected $sonda;

    public function __construct(SondaEspacial $sonda)
    {
        $this->sonda = $sonda;
    }

    public function resetar()
    {
        $this->sonda->resetar();
        return response('', 204);
    }

    public function executarComandos(Request $request)
    {
        $comandos = $request->input('comandos');
        $posicaoAtual = $this->sonda->getPosicaoAtual();

        if($comandos)
            $posicaoAtual = $this->sonda->executarComandos($comandos);

        return response()->json($posicaoAtual);
    }

    public function posicaoAtual()
    {
        return response()->json($this->sonda->getPosicaoAtual());
    }
}
