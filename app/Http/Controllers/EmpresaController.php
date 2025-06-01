<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresas;
use App\Models\Segmentos;

class EmpresaController extends Controller
{
    public function create(){
        return view('index');
    }

    public function store(Request $request){
        $empresa = new Empresas;

        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'cep' => 'required|string|max:10',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:4',
            'bairro' => 'required|string|max:255',
            'estado' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:20',
            'documento' => 'required|string|max:16',
            'segmento_id' => 'required',
            'novo_segmento' => 'required_if:segmento_id,outro|string|max:255',
        ]);

        if ($validado['segmento_id'] === 'outro') {
            $segmento = Segmentos::create([
                'nome' => $validado['novo_segmento']
            ]);
            $segmentoId = $segmento->id;
        } else {
            $segmentoId = intval($validado['segmento_id']);
        }

        $empresa->nome = $validado['nome'];
        $empresa->cep = $validado['cep'];
        $empresa->rua = $validado['rua'];
        $empresa->numero = $validado['numero'];
        $empresa->bairro = $validado['bairro'];
        $empresa->estado = $validado['estado'];
        $empresa->whatsapp = $validado['whatsapp'];
        $empresa->documento = $validado['documento'];
        $empresa->segmento_id = $segmentoId;

        $empresa->save();

        return response()->json(['message' => 'Empresa criada com sucesso'], 201);
    }
}
