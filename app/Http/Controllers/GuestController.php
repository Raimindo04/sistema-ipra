<?php

namespace App\Http\Controllers;

use App\Helpers\ConversorHelper;
use App\Models\IpraForm;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function index(IpraForm $ipraForm)
    {
            //Ipra calculation
    $Ae = $ipraForm->area_construida; //Area edificada
    $P = $ipraForm->classeImovel->preco_m2; // Preco medio por Metro quadrado
    $Fl = $ipraForm->zona->fator_localizacao; // Factor de Localizacao
    $Fa = ConversorHelper::calcularFactorAntiguidade($ipraForm->ano_construcao, $ipraForm->finalidadeImovel); // Factor de Antiguidade
    $Al = $ipraForm->area_terreno - $ipraForm->area_construida; // Area de Logradouro
    $taxaUso = $ipraForm->finalidadeImovel->fator_finalidade;


    $Vp = (($Ae * $P * $Fa) + ( 0.05 * $Al * $P  )) * $Fl;
    $ipra = $Vp * $taxaUso;

    return view('contribuintes.view', compact('ipraForm','Ae', 'P', 'Fl', 'Fa', 'Al', 'taxaUso', 'Vp', 'ipra'));
    }
}
