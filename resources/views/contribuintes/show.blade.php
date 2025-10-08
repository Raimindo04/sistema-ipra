@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-lg p-8 rounded-2xl border border-gray-100">
  <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    Confirmação dos Dados
  </h2>
  {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @foreach($dados as $chave => $valor)
        @if(!empty($valor))
            <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                {{ str_replace('_', ' ', ucfirst($chave)) }}
                </span>
                <span class="text-gray-900 font-medium mt-1 break-words">
                {{ $valor }}
                </span>
            </div>
        @endif
    @endforeach
  </div> --}}
    @if ($ipraForm->tipo_pessoa === 'Singular')
        <div class="mb-8" id="dados-contribuinte-singular">
            <h3 class="text-lg font-semibold text-green-600 border-b border-green-200 pb-1 mb-4">
                Dados do Contribuinte
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Tipo de Contribuinte
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        Pessoa {{ $ipraForm->tipo_pessoa }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Nome
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->ps_nome }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Apelido
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->ps_apelido }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Tipo de Documento de Identificação
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->tipoDocumentoIdentificacao->nome }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Número de Documento
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->ps_numero_documento }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Validade do Documento
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ \Carbon\Carbon::parse($ipraForm->ps_validade_documento)->locale('pt-BR')->translatedFormat('d \de F \de Y ') }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Nacionalidade
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->ps_nacionalidade }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    NUIT
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->nuit }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Número de Telefone
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        <strong> (+258) </strong> {{  $ipraForm->telefone }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Telefone Fixo
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        <strong> (+258) </strong> {{  $ipraForm->telefone_fixo }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Telefone Opcional
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                     {{  $ipraForm->telefone_opcional }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Endereço
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                       {{  $ipraForm->endereco }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Email
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                     {{  $ipraForm->email }}
                    </span>
                </div>
            </div>
        </div>
    @endif

    {{-- Dados para Pessoa Jurídica --}}
    @if ($ipraForm->tipo_pessoa === 'Juridica')

        <div class="mb-8" id="dados-contribuinte-juridico">
            <h3 class="text-lg font-semibold text-green-600 border-b border-green-200 pb-1 mb-4">
                Dados do Contribuinte
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Tipo de Contribuinte
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        Pessoa {{ $ipraForm->tipo_pessoa }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Representante
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->pj_representante }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Nome da Empresa
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->pj_nome_empresa }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    NUIT
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->nuit }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Número de Telefone
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        <strong> (+258) </strong> {{  $ipraForm->telefone }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Telefone Fixo
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        <strong> (+258) </strong> {{  $ipraForm->telefone_fixo }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Telefone Opcional
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        <strong> (+258) </strong> {{  $ipraForm->telefone_opcional }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Endereço
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                     {{  $ipraForm->endereco }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                    Email
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                       {{  $ipraForm->email }}
                    </span>
                </div>
            </div>
        </div>
    @endif



    {{-- Dados para Imovel --}}

        <div class="mb-8" id="dados-contribuinte-juridico">
            <h3 class="text-lg font-semibold text-green-600 border-b border-green-200 pb-1 mb-4">
                Dados do Imovel
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Posto Administrativo
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{ $ipraForm->postoAdministrativo->nome }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Bairro
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->bairro->nome }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                       Avenida
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->avenida }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Unidade Comunal
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->unidade_comunal }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Quarteirão
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->quarteirao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Proximo de
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->proximo_de }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Número de Talhão
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->numero_talhao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Número de Parcela
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->numero_parcela}}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Número de Contribuinte
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->numero_contribuinte }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                      Ano de construção
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->ano_construcao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Área construída
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->area_construida }} m²
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Área do terreno
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->area_terreno }} m²
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Número de Andares
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->numero_andares }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                       Tipo de Construção
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{ $ipraForm->tipo_construcao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                       Classe do Imóvel
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->classeImovel->nome }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                       Zona | Fator de Localização
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->zona->nome }} | {{  $ipraForm->zona->fator_localizacao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                       Finalidade do Imóvel
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->finalidadeImovel->nome }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Status de Isenção
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->status_isencao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                        Área Isentada
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->area_isentada }} m²
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                      Tipo de Valor Patrimonial
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->tipo_valor_patrimonial }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Valor Patrimonial
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                    {{ $ipraForm->valor_patrimonial }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Tipo de aquisição
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->tipo_aquisicao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                     Número de Inserção na Matriz
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->numero_insercao_matriz}}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                       Tipo de Construção
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->tipo_construcao }}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                      Pluscode
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->pluscode}}
                    </span>
                </div>

                <div class="flex flex-col bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm hover:shadow-md transition-all">
                    <span class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                      Observações
                    </span>
                    <span class="text-gray-900 font-medium mt-1 break-words">
                        {{  $ipraForm->observacao }}
                    </span>
                </div>
            </div>

            <!-- Resultado -->
            <div id="resultado" class="mt-6">
                <div class="rounded-xl border border-green-200 bg-green-50 p-4">
                    <h3 class="font-semibold text-green-800 mb-2">Resultado do Cálculo</h3>
                    <div class="text-sm text-gray-800 space-y-2">

                        <p id="imposto">
                            <span class="font-medium">Imposto IPRA:</span>
                            {{ number_format($ipra, 2, ',', '.') }} MZN
                            <span class="text-gray-600">
                                (taxa {{ $taxaUso * 100 }}%, {{ $ipraForm->finalidadeImovel->nome }})
                            </span>
                        </p>

                        <p id="valorPatrimonial">
                            <span class="font-medium">Valor Patrimonial (VP):</span>
                            {{ number_format($Vp, 2, ',', '.') }} MZN
                        </p>

                        <p class="text-gray-600">VP = (Ae × P × Fa) + (0.05 × Al × P) × Fl</p>

                        <div id="coeficientes" class="grid grid-cols-1 sm:grid-cols-6 gap-2 text-xs">
                            <div class="bg-white rounded-lg p-2 border">
                                <span class="font-medium">Ano</span>: {{ $ipraForm->ano_construcao }}
                            </div>

                            <div class="bg-white rounded-lg p-2 border">
                                <span class="font-medium">Ae</span>: {{ $Ae }} m²
                            </div>

                            <div class="bg-white rounded-lg p-2 border">
                                <span class="font-medium">P</span>: {{ number_format($P, 2, ',', '.') }} MZN
                                <span class="text-gray-500">({{ $ipraForm->classeImovel->nome }})</span>
                            </div>

                            <div class="bg-white rounded-lg p-2 border">
                                <span class="font-medium">Fa</span>: {{ $Fa }}
                            </div>

                            <div class="bg-white rounded-lg p-2 border">
                                <span class="font-medium">Al</span>: {{ $Al }} m²
                            </div>

                            <div class="bg-white rounded-lg p-2 border">
                                <span class="font-medium">Fl</span>: {{ $Fl }}
                                <span class="text-gray-500">({{ $ipraForm->zona->nome }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


  <div class="flex justify-end gap-3 mt-8">
    <a href="{{ route('contribuintes.index') }}"
       class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition-colors">
       Voltar
    </a>
  </div>
</div>
@endsection
