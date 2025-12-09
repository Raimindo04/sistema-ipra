<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .sub-header {
            text-align: center;
            font-size: 14px;
        }
        .logo {
            width: 60px;
            margin-bottom: 10px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        td, th {
            border: 1px solid #444;
            padding: 6px;
            font-size: 11px;
        }
        th {
            background: #f0f0f0;
        }
        .section-title {
            background: #ddd;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 13px;
        }
        .qrcode {
            margin-top: 20px;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #555;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <img class="logo" src="{{ public_path('images/logo.png') }}" alt="Logo">
        <div class="sub-header"><strong>CONSELHO MUNICIPAL DA BEIRA</strong></div>
        <div class="mb-20"><strong>DEPARTAMENTO DE PLANO E FINANÇAS</strong></div>
        <div class="title">Ficha Resumo — Cadastro IMÓVEL</div>
        <div>ID do Formulário: <strong>{{ $ipra->id }}</strong></div>
    </div>

    {{-- IDENTIFICAÇÃO DO CONTRIBUINTE --}}
    <table>
        <tr><th colspan="4" class="section-title">Identificação</th></tr>

        <tr>
            <th>Tipo de Pessoa</th>
            <td>{{ $ipra->tipo_pessoa }}</td>
            <th>NUIT</th>
            <td>{{ $ipra->nuit }}</td>
        </tr>

        @if ($ipra->tipo_pessoa == 'Singular')
            <tr>
                <th>Nome</th>
                <td>{{ $ipra->ps_nome }}</td>
                <th>Apelido</th>
                <td>{{ $ipra->ps_apelido }}</td>
            </tr>
            <tr>
            <th>Documento</th>
            <td>{{ $ipra->tipoDocumentoIdentificacao->nome ?? '-' }}</td>
            <th>Número</th>
            <td>{{ $ipra->ps_numero_documento }}</td>
        </tr>

        <tr>
            <th>Validade</th>
            <td>{{ $ipra->ps_validade_documento }}</td>
            <th>Nacionalidade</th>
            <td>{{ $ipra->ps_nacionalidade }}</td>
        </tr>
        @else
            <tr>
                <th>Nome da Empresa</th>
                <td>{{ $ipra->pj_nome_empresa }}</td>
                <th>Representante</th>
                <td>{{ $ipra->pj_representante }}</td>
            </tr>
        @endif


    </table>

    {{-- CONTACTOS --}}
    <table>
        <tr><th colspan="4" class="section-title">Contactos</th></tr>

        <tr>
            <th>Email</th>
            <td>{{ $ipra->email }}</td>
            <th>Telefone</th>
            <td>{{ $ipra->telefone }}</td>
        </tr>

        <tr>
            <th>Telefone Fixo</th>
            <td>{{ $ipra->telefone_fixo }}</td>
            <th>Telefone Opcional</th>
            <td>{{ $ipra->telefone_opcional }}</td>
        </tr>
    </table>

    {{-- ENDEREÇO --}}
    <table>
        <tr><th colspan="4" class="section-title">Endereço</th></tr>

        <tr>
            <th>Endereço</th>
            <td>{{ $ipra->endereco }}</td>
            <th>Pluscode</th>
            <td>{{ $ipra->pluscode }}</td>
        </tr>

        <tr>
            <th>Posto Administrativo</th>
            <td>{{ $ipra->postoAdministrativo->nome }}</td>
            <th>Bairro</th>
            <td>{{ $ipra->bairro->nome }}</td>
        </tr>

        <tr>
            <th>Avenida</th>
            <td>{{ $ipra->avenida }}</td>
            <th>Unidade Comunal</th>
            <td>{{ $ipra->unidade_comunal }}</td>
        </tr>

        <tr>
            <th>Quarteirão</th>
            <td>{{ $ipra->quarteirao }}</td>
            <th>Próximo de</th>
            <td>{{ $ipra->proximo_de }}</td>
        </tr>

        <tr>
            <th>Nº Talhão</th>
            <td>{{ $ipra->numero_talhao }}</td>
            <th>Nº Parcela</th>
            <td>{{ $ipra->numero_parcela }}</td>
        </tr>
    </table>

    {{-- DADOS DO IMÓVEL --}}
    <table>
        <tr><th colspan="4" class="section-title">Dados do Imóvel</th></tr>

        <tr>
            <th>Nº Contribuinte</th>
            <td>{{ $ipra->numero_contribuinte }}</td>
            <th>Ano Construção</th>
            <td>{{ $ipra->ano_construcao }}</td>
        </tr>

        <tr>
            <th>Área Construída</th>
            <td>{{ $ipra->area_construida }} m²</td>
            <th>Área Terreno</th>
            <td>{{ $ipra->area_terreno }} m²</td>
        </tr>

        <tr>
            <th>Nº de Piso</th>
            <td>{{ $ipra->numero_andares }}</td>
            <th>Tipo Construção</th>
            <td>{{ $ipra->tipo_construcao }}</td>
        </tr>

        <tr>
            <th>Classe Imóvel</th>
            <td>{{ $ipra->classeImovel->nome }}</td>
            <th>Zona</th>
            <td>{{ $ipra->zona->nome }}</td>
        </tr>

        <tr>
            <th>Finalidade</th>
            <td>{{ $ipra->finalidadeImovel->nome }}</td>
            <th>Status Isenção</th>
            <td>{{ $ipra->status_isencao }}</td>
        </tr>

        <tr>
            <th>Área Isentada</th>
            <td>{{ $ipra->area_isentada }}</td>
            <th>Tipo Valor Patrimonial</th>
            <td>{{ $ipra->tipo_valor_patrimonial }}</td>
        </tr>

        <tr>
            <th>Valor Patrimonial</th>
            <td colspan="3">{{ number_format($ipra->valor_patrimonial, 2, ',', '.') }} MT</td>
        </tr>

        <tr>
            <th>Tipo Aquisição</th>
            <td>{{ $ipra->tipo_aquisicao }}</td>
            <th>Nº Inserção Matriz</th>
            <td>{{ $ipra->numero_insercao_matriz }}</td>
        </tr>
    </table>

    {{-- OBSERVAÇÕES --}}
    <table>
        <tr><th class="section-title">Observações</th></tr>
        <tr>
            <td style="height: 60px;">{{ $ipra->observacoes }}</td>
        </tr>
    </table>
{{-- CÁLCULO DO VALOR PATRIMONIAL E IPRA --}}
<table>
    <tr><th colspan="4" class="section-title">Cálculo do VP e IPRA</th></tr>

    <tr>
        <th>Fórmula VP</th>
        <td colspan="3">
            VP = [(Ae × P × Fa) + (0.05 × Al × P)] × Fl
        </td>
    </tr>

    <tr>
        <th>Substituição</th>
        <td colspan="3">
            VP = [({{ $ipra->area_construida }} × {{ number_format($P, 2, ',', '.') }} × {{ $Fa }})
            + (0.05 × {{ $ipra->area_terreno }} × {{ number_format($P, 2, ',', '.') }})] × {{ $Fl }}
        </td>
    </tr>

    <tr>
        <th>Valor Patrimonial (VP)</th>
        <td colspan="3">
            <strong>{{ number_format($Vp, 2, ',', '.') }} MT</strong>
        </td>
    </tr>

    <tr>
        <th>Fórmula IPRA</th>
        <td colspan="3">
            IPRA = VP × taxa de uso ({{ $taxaUso * 100 }}%, {{ $ipra->finalidadeImovel->nome }})
        </td>
    </tr>

    <tr>
        <th>Substituição</th>
        <td colspan="3">
            IPRA = {{ number_format($Vp, 2, ',', '.') }} × {{ $taxaUso }}
        </td>
    </tr>

    <tr>
        <th>Imposto IPRA</th>
        <td colspan="3">
            <strong>{{ number_format($ipraCalculado, 2, ',', '.') }} MT</strong>
        </td>
    </tr>
</table>

   {{-- QR CODE --}}
    @php
        $qr = base64_encode(
            QrCode::format('png')
                ->size(100)
                ->generate(url('/contribuintes/'.$ipra->id.'/show'))
        );
    @endphp

    <div class="qrcode">
        <div>
            <img src="data:image/png;base64, {{ $qr }}" alt="QR Code">
        </div>
        <small>Verificação eletrónica</small>
    </div>

    <div class="footer">
        Documento gerado automaticamente — {{ now()->format('d/m/Y H:i') }} - por {{ auth()->user()->name }}
    </div>

</body>
</html>
