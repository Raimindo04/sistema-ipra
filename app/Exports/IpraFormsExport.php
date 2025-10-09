<?php

namespace App\Exports;

use App\Models\IpraForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IpraFormsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return IpraForm::all([
            'id',
            'tipo_pessoa',
            'ps_nome',
            'ps_apelido',
            'tipo_documento_identificacao_id',
            'ps_numero_documento',
            'ps_validade_documento',
            'ps_nacionalidade',
            'pj_representante',
            'pj_nome_empresa',
            'nuit',
            'telefone',
            'telefone_fixo',
            'telefone_opcional',
            'endereco',
            'email',
            'pluscode',
            'posto_administrativo_id',
            'bairro_id',
            'avenida',
            'unidade_comunal',
            'quarteirao',
            'proximo_de',
            'numero_talhao',
            'numero_parcela',
            'numero_contribuinte',
            'ano_construcao',
            'area_construida',
            'area_terreno',
            'numero_andares',
            'tipo_construcao',
            'classe_imovel_id',
            'zona_id',
            'finalidade_imovel_id',
            'status_isencao',
            'area_isentada',
            'tipo_valor_patrimonial',
            'valor_patrimonial',
            'tipo_aquisicao',
            'numero_insercao_matriz',
            'observacoes',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo Pessoa',
            'Nome',
            'Apelido',
            'Tipo Doc.',
            'Nº Doc.',
            'Validade Doc.',
            'Nacionalidade',
            'Representante',
            'Empresa',
            'NUIT',
            'Telefone',
            'Telefone Fixo',
            'Telefone Opcional',
            'Endereço',
            'Email',
            'Pluscode',
            'Posto Administrativo',
            'Bairro',
            'Avenida',
            'Unidade Comunal',
            'Quarteirão',
            'Próximo de',
            'Nº Talhão',
            'Nº Parcela',
            'Nº Contribuinte',
            'Ano Construção',
            'Área Construída',
            'Área Terreno',
            'Nº Andares',
            'Tipo Construção',
            'Classe Imóvel',
            'Zona',
            'Finalidade Imóvel',
            'Status Isenção',
            'Área Isentada',
            'Tipo VP',
            'Valor Patrimonial',
            'Tipo Aquisição',
            'Nº Inserção Matriz',
            'Observações',
            'Criado em',
        ];
    }
    public function map($ipraForm): array
    {
        return [
            $ipraForm->id,
            $ipraForm->tipo_pessoa,
            $ipraForm->ps_nome,
            $ipraForm->ps_apelido,
            $ipraForm->tipoDocumentoIdentificacao->nome,
            $ipraForm->ps_numero_documento,
            $ipraForm->ps_validade_documento ,
            $ipraForm->ps_nacionalidade,
            $ipraForm->pj_representante,
            $ipraForm->pj_nome_empresa,
            $ipraForm->nuit,
            $ipraForm->telefone,
            $ipraForm->telefone_fixo,
            $ipraForm->telefone_opcional,
            $ipraForm->endereco,
            $ipraForm->email,
            $ipraForm->pluscode,
            $ipraForm->postoAdministrativo->nome,
            $ipraForm->bairro->nome,
            $ipraForm->avenida,
            $ipraForm->unidade_comunal,
            $ipraForm->quarteirao,
            $ipraForm->proximo_de,
            $ipraForm->numero_talhao,
            $ipraForm->numero_parcela,
            $ipraForm->numero_contribuinte,
            $ipraForm->ano_construcao,
            $ipraForm->area_construida,
            $ipraForm->area_terreno,
            $ipraForm->numero_andares,
            $ipraForm->tipo_construcao,
            $ipraForm->classeImovel->nome,
            $ipraForm->zona->nome,
            $ipraForm->finalidadeImovel->nome,
            $ipraForm->status_isencao,
            $ipraForm->area_isentada,
            $ipraForm->tipo_valor_patrimonial,
            $ipraForm->valor_patrimonial,
            $ipraForm->tipo_aquisicao,
            $ipraForm->numero_insercao_matriz,
            $ipraForm->observacoes,
            $ipraForm->created_at->format('d/m/Y H:i'),
        ];
    }
}
