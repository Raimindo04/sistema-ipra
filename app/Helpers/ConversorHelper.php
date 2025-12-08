<?php

namespace App\Helpers;

use App\Models\IpraForm;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ConversorHelper
{
     public static function ipraFormToData (IpraForm $ipraForm)
    {
        $data['tipoPessoa'] = $ipraForm->tipo_pessoa;
        $data['ps_nome'] = $ipraForm->ps_nome;
        $data['ps_apelido'] = $ipraForm->ps_apelido;
        $data['ps_tipo_documento'] = $ipraForm->tipo_documento_identificacao_id;
        $data['ps_numero_documento'] = $ipraForm->ps_numero_documento;
        $data['ps_validade_documento'] = $ipraForm->ps_validade_documento;
        $data['ps_nacionalidade'] = $ipraForm->ps_nacionalidade;
        $data['ps_nuit'] = $ipraForm->nuit;
        $data['ps_telefone'] = $ipraForm->telefone;
        $data['ps_telefone_fixo'] = $ipraForm->telefone_fixo;
        $data['ps_telefone_opcional'] = $ipraForm->telefone_opcional;
        $data['ps_endereco'] = $ipraForm->endereco;
        $data['ps_email'] = $ipraForm->email;
        $data['pj_representante'] = $ipraForm->pj_representante;
        $data['pj_nome_empresa'] = $ipraForm->pj_nome_empresa;
        $data['pj_nuit'] = $ipraForm->nuit;
        $data['pj_telefone'] = $ipraForm->telefone;
        $data['pj_telefone_fixo'] = $ipraForm->telefone_fixo;
        $data['pj_telefone_opcional'] = $ipraForm->telefone_opcional;
        $data['pj_endereco'] = $ipraForm->endereco;
        $data['pj_email'] = $ipraForm->email;
        $data['pluscode'] = $ipraForm->pluscode;
        $data['posto_administrativo'] = $ipraForm->posto_administrativo_id;
        $data['bairro'] = $ipraForm->bairro_id;
        $data['avenida'] = $ipraForm->avenida;
        $data['unidade_comunal'] = $ipraForm->unidade_comunal;
        $data['quarteirao'] = $ipraForm->quarteirao;
        $data['proximo_de'] = $ipraForm->proximo_de;
        $data['numero_talhao'] = $ipraForm->numero_talhao;
        $data['numero_parcela'] = $ipraForm->numero_parcela;
        $data['numero_contribuinte'] = $ipraForm->numero_contribuinte;
        $data['ano_construcao'] = $ipraForm->ano_construcao;
        $data['area_construida'] = $ipraForm->area_construida;
        $data['area_terreno'] = $ipraForm->area_terreno;
        $data['numero_andares'] = $ipraForm->numero_andares;
        $data['tipo_construcao'] = $ipraForm->tipo_construcao;
        $data['classe_imovel'] = $ipraForm->classe_imovel_id;
        $data['zona'] = $ipraForm->zona_id;
        $data['finalidade_imovel'] = $ipraForm->finalidade_imovel_id;
        $data['status_isencao'] = $ipraForm->status_isencao;
        $data['area_isentada'] = $ipraForm->area_isentada;
        $data['tipo_valor_patrimonial'] = $ipraForm->tipo_valor_patrimonial;
        $data['valor_patrimonial'] = $ipraForm->valor_patrimonial;
        $data['tipo_aquisicao'] = $ipraForm->tipo_aquisicao;
        $data['numero_insercao_matriz'] = $ipraForm->numero_insercao_matriz;

        return $data;
    }
}


