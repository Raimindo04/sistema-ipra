@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-4">Formulario para cálculo do IPRA</h1>
<!-- Alertas globais -->
@if (session('success'))
    <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800">
        ✅ {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300 text-red-800">
        ❌ {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-300 text-red-700">
        <strong>⚠️ Ocorreram alguns erros de validação:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="space-y-8" id="ipraForm" method="POST" action="{{ route('contribuintes.validar') }}">
    @csrf

<!-- Escolha do Tipo -->
  <div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2"> Tipo de Contribuinte<strong class="text-red-700">*</strong></label>
    <div class="flex gap-6">
      <label class="flex items-center gap-2">
        <input type="radio" name="tipoPessoa" value="Singular" class="text-green-600 focus:ring-green-500" {{ old('tipoPessoa', $dados['tipoPessoa'] ?? 'Singular' ) === 'Singular' ? 'checked' : '' }} />
        <span>Pessoa Singular</span>
      </label>
      <label class="flex items-center gap-2">
        <input type="radio" name="tipoPessoa" value="Juridica" class="text-green-600 focus:ring-green-500" {{ old('tipoPessoa', $dados['tipoPessoa'] ?? 'Singular' ) === 'Juridica' ? 'checked' : '' }} />
        <span>Pessoa Jurídica</span>
      </label>
    </div>
  </div>

  <!-- Pessoa Jurídica -->
  <div id="formJuridica" class="rounded-xl border border-gray-200 bg-gray-50 p-4 transition-all duration-300 ease-in-out {{ old('tipoPessoa', $dados['tipoPessoa'] ?? 'Singular' ) === 'Juridica' ? '' : 'hidden' }}">
    <h3 class="font-semibold text-gray-800 mb-4">Pessoa Jurídica</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium">Representante <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2 @error('pj_representante') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror " name="pj_representante" value="{{ old('pj_representante', $dados['pj_representante'] ?? '') }}"/>
        @error('pj_representante')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Nome da Empresa <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2 @error('pj_nome_empresa') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror " name="pj_nome_empresa" value="{{ old('pj_nome_empresa', $dados['pj_nome_empresa'] ?? '') }}"/>
        @error('pj_nome_empresa')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">NUIT <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('pj_nuit') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="pj_nuit" value="{{ old('pj_nuit', $dados['pj_nuit'] ?? '') }}"/>
        @error('pj_nuit')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Número de Telefone <strong>(+258)</strong> <strong class="text-red-700">*</strong></label>
        <input type="tel" class="w-full rounded-lg border p-2  @error('pj_telefone') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="pj_telefone" value="{{ old('pj_telefone', $dados['pj_telefone'] ?? '') }}"/>
        @error('pj_telefone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Telefone Fixo <strong>(+258)</strong></label>
        <input type="tel" class="w-full rounded-lg border p-2  @error('pj_telefone_fixo') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="pj_telefone_fixo" value="{{ old('pj_telefone_fixo', $dados['pj_telefone_fixo'] ?? '') }}"/>
        @error('pj_telefone_fixo')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Telefone Opcional <strong>(+258)</strong></label>
        <input type="tel" class="w-full rounded-lg border p-2  @error('pj_telefone_opcional') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="pj_telefone_opcional" value="{{ old('pj_telefone_opcional', $dados['pj_telefone_opcional'] ?? '') }}"/>
        @error('pj_telefone_opcional')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-medium">Endereço <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('pj_endereco') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="pj_endereco" value="{{ old('pj_endereco', $dados['pj_endereco'] ?? '') }}"/>
        @error('pj_endereco')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-medium">Email <strong class="text-red-700">*</strong></label>
        <input type="email" class="w-full rounded-lg border p-2  @error('pj_email') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="pj_email" value="{{ old('pj_email', $dados['pj_email'] ?? '') }}"/>
        @error('pj_email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>

  <!-- Pessoa Singular -->
  <div id="formSingular" class="rounded-xl border border-gray-200 bg-gray-50 p-4 transition-all duration-300 {{ old('tipoPessoa', $dados['tipoPessoa'] ?? 'Singular' ) === 'Singular' ? '' : 'hidden' }}">
    <h3 class="font-semibold text-gray-800 mb-4">Pessoa Singular</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium">Nome <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('ps_nome') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_nome" value="{{ old('ps_nome', $dados['ps_nome'] ?? '') }}"/>
        @error('ps_nome')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Apelido <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('ps_apelido') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_apelido" value="{{ old('ps_apelido', $dados['ps_apelido'] ?? '') }}"/>
        @error('ps_apelido')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Tipo de Documento de  Identificação <strong class="text-red-700">*</strong></label>
        <select class="w-full rounded-lg border p-2  @error('ps_tipo_documento') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_tipo_documento">
          <option value="">{{ __('-- Selecione o documento de  Identificação --') }}</option>
            @foreach ($tiposDocumentoIdentificacao as $tipo)
                <option value="{{ $tipo->id}}" {{ old('ps_tipo_documento', $dados['ps_tipo_documento'] ?? '') == $tipo->id ? 'selected' : ''}}>{{ $tipo->nome }}</option>
            @endforeach
        </select>
        @error('ps_tipo_documento')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Número de Documento <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('ps_numero_documento') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_numero_documento" value="{{ old('ps_numero_documento', $dados['ps_numero_documento'] ?? '') }}"/>
        @error('ps_numero_documento')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Validade do Documento <strong class="text-red-700">*</strong></label>
        <input type="date" class="w-full rounded-lg border p-2  @error('ps_validade_documento') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_validade_documento" value="{{ old('ps_validade_documento', $dados['ps_validade_documento'] ?? '') }}"/>
        @error('ps_validade_documento')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Nacionalidade <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('ps_nacionalidade') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_nacionalidade" value="{{ old('ps_nacionalidade', $dados['ps_nacionalidade'] ?? '') }}"/>
        @error('ps_nacionalidade')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">NUIT <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('ps_nuit') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_nuit" value="{{ old('ps_nuit', $dados['ps_nuit'] ?? '') }}"/>
        @error('ps_nuit')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Número de Telefone <strong>(+258)</strong> <strong class="text-red-700">*</strong></label>
        <input type="tel" class="w-full rounded-lg border p-2  @error('ps_telefone') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_telefone" value="{{ old('ps_telefone', $dados['ps_telefone'] ?? '') }}"/>
        @error('ps_telefone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Telefone Fixo <strong>(+258)</strong></label>
        <input type="tel" class="w-full rounded-lg border p-2  @error('ps_telefone_fixo') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_telefone_fixo" value="{{ old('ps_telefone_fixo', $dados['ps_telefone_fixo'] ?? '') }}"/>
        @error('ps_telefone_fixo')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Telefone Opcional <strong>(+258)</strong></label>
        <input type="tel" class="w-full rounded-lg border p-2  @error('ps_telefone_opcional') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_telefone_opcional" value="{{ old('ps_telefone_opcional', $dados['ps_telefone_opcional'] ?? '') }}"/>
        @error('ps_telefone_opcional')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-medium">Endereço <strong class="text-red-700">*</strong></label>
        <input type="text" class="w-full rounded-lg border p-2  @error('ps_endereco') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_endereco" value="{{ old('ps_endereco', $dados['ps_endereco'] ?? '') }}" />
        @error('ps_endereco')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="sm:col-span-2">
        <label class="block text-sm font-medium">Email <strong class="text-red-700">*</strong></label>
        <input type="email" class="w-full rounded-lg border p-2  @error('ps_email') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="ps_email" value="{{ old('ps_email', $dados['ps_email'] ?? '') }}"/>
        @error('ps_email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>

  <!-- Informações do Imóvel -->
  <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
    <h3 class="font-semibold text-gray-800 mb-4">Informações do Imóvel</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

      <div>
        <label class="block text-sm font-medium">Pluscode <strong class="text-red-700">*</strong></label>
        <input type="text" name="pluscode" class="w-full rounded-lg border p-2 @error('pluscode') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('pluscode', $dados['pluscode'] ?? '') }}" />
        @error('pluscode')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Posto Administrativo <strong class="text-red-700">*</strong></label>
        <select id="postoAdministrativo" class="w-full rounded-lg border p-2  @error('posto_administrativo') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="posto_administrativo">
          <option value="">{{ __('-- Selecione o posto administrativo --') }}</option>
            @foreach($postosAdministrativos as $posto)
                <option value="{{ $posto->id }}" {{ old('posto_administrativo', $dados['posto_administrativo'] ?? '') == $posto->id ? 'selected' : ''}}>{{ $posto->nome }}</option>
            @endforeach
        </select>
        @error('posto_administrativo')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Bairro <strong class="text-red-700">*</strong></label>
        <select id="bairro" class="w-full rounded-lg border p-2  @error('bairro') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="bairro">
          <option value="">{{ __('-- Selecione o bairro --') }}</option>
            @foreach($bairros as $bairro)
                <option value="{{ $bairro->id }}" {{ old('bairro', $dados['bairro'] ?? '') == $bairro->id ? 'selected' : ''}}>{{ $bairro->nome }}</option>
            @endforeach
        </select>
        @error('bairro')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      {{-- <div><label class="block text-sm font-medium">Zona </label><input type="text" class="w-full rounded-lg border p-2" /></div> --}}
      <div>
        <label class="block text-sm font-medium">Avenida <strong class="text-red-700">*</strong></label>
        <input type="text" name="avenida" class="w-full rounded-lg border p-2 @error('avenida') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror"  value="{{ old('avenida', $dados['avenida'] ?? '') }}"/>
        @error('avenida')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Unidade Comunal </label>
        <input type="text" name="unidade_comunal" class="w-full rounded-lg border p-2 @error('unidade_comunal') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('unidade_comunal', $dados['unidade_comunal'] ?? '') }}"/>
        @error('unidade_comunal')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Quarteirão </label>
        <input type="text" name="quarteirao" class="w-full rounded-lg border p-2 @error('quarteirao') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('quarteirao', $dados['quarteirao'] ?? '') }}"/>
        @error('quarteirao')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div >
        <label class="block text-sm font-medium">Próximo de </label>
        <input type="text" name="proximo_de" class="w-full rounded-lg border p-2 @error('proximo_de') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('proximo_de', $dados['proximo_de'] ?? '') }}"/>
        @error('proximo_de')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div >
        <label class="block text-sm font-medium">Número de Talhão </label>
        <input type="text" name="numero_talhao" class="w-full rounded-lg border p-2 @error('numero_talhao') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror"  value="{{ old('numero_talhao', $dados['numero_talhao'] ?? '') }}"/>
        @error('numero_talhao')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div >
        <label class="block text-sm font-medium">Número de Parcela </label>
        <input type="text" name="numero_parcela" class="w-full rounded-lg border p-2 @error('numero_parcela') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('numero_parcela', $dados['numero_parcela'] ?? '') }}"/>
        @error('numero_parcela')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Número de Contribuinte </label>
        <input type="text" name="numero_contribuinte" class="w-full rounded-lg border p-2 @error('numero_contribuinte') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('numero_contribuinte', $dados['numero_contribuinte'] ?? '') }}"/>
        @error('numero_contribuinte')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div><div>
        <label class="block text-sm font-medium">Ano de construção <strong class="text-red-700">*</strong></label>
        <input type="number" name="ano_construcao" value="{{ old('ano_construcao', $dados['ano_construcao'] ?? '') }}" class="w-full rounded-lg border p-2  @error('ano_construcao') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" min="0" />
        @error('ano_construcao')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Área construída <strong class="text-red-700">*</strong></label>
        <input type="number" name="area_construida" value="{{ old('area_construida', $dados['area_construida'] ?? '') }}" class="w-full rounded-lg border p-2  @error('area_construida') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" step="0.01" min="0"/>
        @error('area_construida')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Área do terreno <strong class="text-red-700">*</strong></label>
        <input type="number" name="area_terreno" value="{{ old('area_terreno', $dados['area_terreno'] ?? '') }}" class="w-full rounded-lg border p-2  @error('area_terreno') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" step="0.01" min="0" />
        @error('area_terreno')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Número de Pisos</label>
        <input type="number" name="numero_andares" class="w-full rounded-lg border p-2 @error('numero_andares') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('numero_andares', $dados['numero_andares'] ?? '') }}"/>
        @error('numero_andares')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Tipo de Construção <strong class="text-red-700">*</strong></label>
        <select class="w-full rounded-lg border p-2  @error('tipo_construcao') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="tipo_construcao">
            <option value="Vertical" {{ old('tipo_construcao', $dados['tipo_construcao'] ?? '')=='Vertical' ? 'selected' : ''}}>Vertical</option>
            <option value="Horizontal" {{ old('tipo_construcao', $dados['tipo_construcao'] ?? '') == 'Horizontal' ? 'selected': '' }}>Horizontal</option>
        </select>
        @error('tipo_construcao')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div><label class="block text-sm font-medium">Classe do Imóvel <strong class="text-red-700">*</strong></label>
        <select class="w-full rounded-lg border p-2 @error('classe_imovel') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="classe_imovel">
            <option value="">{{ __('-- Selecione a classe --') }}</option>
            @foreach ($classesImovel as $classe)
                <option value="{{ $classe->id }}" {{ old('classe_imovel', $dados['classe_imovel'] ?? '') == $classe->id ? 'selected' : '' }}>{{ $classe->nome }} | P: {{ $classe->preco_m2 }}</option>
            @endforeach
        </select>
        @error('classe_imovel')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Fator de Localização <strong class="text-red-700">*</strong></label>
        <select class="w-full rounded-lg border p-2 @error('zona') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="zona">
            <option value="">{{ __('-- Selecione a zona --') }}</option>
            @foreach ($zonas as $zona)
                <option value="{{ $zona->id }}" {{ old('zona', $dados['zona'] ?? '') == $zona->id ? 'selected' : '' }}><strong>{{ $zona->nome }} </strong> | FL: {{ $zona->fator_localizacao }}</option>
            @endforeach
        </select>
        @error('zona')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div><label class="block text-sm font-medium">Finalidade do Imóvel <strong class="text-red-700">*</strong></label>
        <select class="w-full rounded-lg border p-2 @error('finalidade_imovel') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="finalidade_imovel">
            <option value="">{{ __('-- Selecione a finalidade --') }}</option>
            @foreach ($finalidadesImovel as $finalidade)
                <option value="{{ $finalidade->id }}" {{ old('finalidade_imovel', $dados['finalidade_imovel'] ?? '') == $finalidade->id ? 'selected' : '' }}>{{ $finalidade->nome }} | Taxa: {{ $finalidade->fator_finalidade }}</option>
            @endforeach
        </select>
        @error('finalidade_imovel')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Status de Isenção</label>
        <input type="text" name="status_isencao" class="w-full rounded-lg border p-2 @error('status_isencao') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('status_isencao', $dados['status_isencao'] ?? '') }}" />
        @error('status_isencao')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Área Isentada</label>
        <input type="number" name="area_isentada" class="w-full rounded-lg border p-2 @error('area_isentada') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror"  value="{{ old('area_isentada', $dados['area_isentada'] ?? '') }}"/>
        @error('area_isentada')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Tipo de Valor Patrimonial <strong class="text-red-700">*</strong></label>
        <select class="w-full rounded-lg border p-2 @error('tipo_valor_patrimonial') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="tipo_valor_patrimonial">
            <option value="Calculado" {{ old('tipo_valor_patrimonial', $dados['tipo_valor_patrimonial'] ?? '')=='Calculado' ? 'selected' : ''}}>Calculado</option>
            <option value="Estipulado" {{ old('tipo_valor_patrimonial', $dados['tipo_valor_patrimonial'] ?? '')=='Estipulado' ? 'selected' : ''}}>Estipulado</option>
        </select>
        @error('tipo_valor_patrimonial')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Valor Patrimonial <strong class="text-red-700">*</strong></label>
        <input type="number" name="valor_patrimonial" class="w-full rounded-lg border p-2 @error('valor_patrimonial') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" value="{{ old('valor_patrimonial', $dados['valor_patrimonial'] ?? '') }}"/>
        @error('valor_patrimonial')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Tipo de aquisição </label>
        <input type="text" name="tipo_aquisicao" class="w-full rounded-lg border p-2 @error('tipo_aquisicao') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror"  value="{{ old('tipo_aquisicao', $dados['tipo_aquisicao'] ?? '') }}"/>
        @error('tipo_aquisicao')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium">Número de Inserção na Matriz</label>
        <input type="text" name="numero_insercao_matriz" class="w-full rounded-lg border p-2 @error('numero_insercao_matriz') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror"  value="{{ old('numero_insercao_matriz', $dados['numero_insercao_matriz'] ?? '') }}"/>
        @error('numero_insercao_matriz')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="sm:col-span-3">
        <label class="block text-sm font-medium">Observações</label>
        <textarea class="w-full rounded-lg border p-2 @error('observacao') border-red-500 ring-1 ring-red-500 @else border-blue-300 @enderror" name="observacao">{{ old('observacao', $dados['observacao'] ?? '') }}</textarea>
        @error('observacao')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>



  <!-- Botões -->
  <div class="flex gap-4">
    <a href="{{ route('contribuintes.index') }}" class="px-4 py-2 rounded-lg border bg-gray-100">Voltar</a>
    {{-- <button type="button" id="btnSubmeter" class="px-4 py-2 rounded-lg bg-green-600 text-white">Salvar</button> --}}
    <button type="submit" class="px-4 py-2 rounded-lg bg-green-600 text-white">Salvar</button>
    <a  class="px-4 py-2 rounded-lg border bg-red-500 text-white" href="{{ route('contribuintes.limpar') }}">Limpar</a>
  </div>
</form>
    <!-- Resultado -->
  <div id="resultado" class="mt-6 hidden">
    <div class="rounded-xl border border-green-200 bg-green-50 p-4">
        <h3 class="font-semibold text-green-800 mb-2">Resultado do Cálculo</h3>
        <div class="text-sm text-gray-800 space-y-2">
            <p id="imposto"></p>
            <p id="valorPatrimonial"></p>
            <p class="text-gray-600">VP = (Ae × P × Fa) + (0.05 × Al × P) × Fl</p>

            <div id="coeficientes" class="grid grid-cols-1 sm:grid-cols-6 gap-2 text-xs"></div>
        </div>
    </div>
</div>

</div>

<script>

    function  calcularFatorIdade (ano) {
        let valor = 1.0;
        if (ano >= 2021) valor = 1.0;
        else if (ano >= 2015) valor = 0.95;
        else if (ano >= 2010) valor = 0.90;
        else if (ano >= 2005) valor = 0.85;
        else if (ano >= 1995) valor = 0.80;
        else if (ano >= 1985) valor = 0.75;
        else if (ano >= 1975) valor = 0.70;
        else valor = 0.65;
        return valor;
    }
    function parseNumber(v) {
        if (v === null || v === undefined) {
            return NaN;
        }

        if (typeof v === "number") {
            return v;
        }

        // transforma em string e remove espaços
        var s = String(v).trim().replace(/\s+/g, "");
        if (s.length === 0) {
            return NaN;
        }

        // substitui vírgula por ponto
        s = s.replace(/,/g, ".");

        // tenta converter
        var n = Number(s);
        if (isFinite(n)) {
            return n;
        } else {
            return NaN;
        }
    }
        const tipoRadios = document.querySelectorAll('input[name="tipoPessoa"]');
        const formSingular = document.getElementById("formSingular");
        const formJuridica = document.getElementById("formJuridica");

        tipoRadios.forEach((radio) => {
            radio.addEventListener("change", (e) => {
            if (e.target.value === "Singular") {
                formSingular.classList.remove("hidden");
                formJuridica.classList.add("hidden");
                // desabilita campos jurídicos
                formJuridica.querySelectorAll("input").forEach((i) => (i.disabled = true));
                formSingular.querySelectorAll("input").forEach((i) => (i.disabled = false));
            } else {
                formSingular.classList.add("hidden");
                formJuridica.classList.remove("hidden");
                // desabilita campos singulares
                formSingular.querySelectorAll("input").forEach((i) => (i.disabled = true));
                formJuridica.querySelectorAll("input").forEach((i) => (i.disabled = false));
            }
            });
        });
    function limparFormulario() {
        document.getElementById("resultado").classList.add("hidden"); // esconde os resultados
        document.getElementById("coeficientes").innerHTML = "";       // limpa coeficientes
        document.getElementById("valorPatrimonial").innerHTML = "";
        document.getElementById("imposto").innerHTML = "";
    }

    function calcularIPRA() {
        const ano = document.querySelector('[name="ano_construcao"]').value;
        const Ae = parseFloat(document.querySelector('[name="area_construida"]').value);
        const Al = parseFloat(document.querySelector('[name="area_terreno"]').value);
        const P = parseFloat(document.querySelector('[name="classe_imovel"]').value);
        const Fl = parseFloat(document.querySelector('[name="fator_localizacao"]').value);
        const uso = document.querySelector('[name="finalidade_imovel"] option:checked').value;
        const Fa = calcularFatorIdade(ano);

        // Labels auxiliares
        const custoLabel = document.querySelector('[name="classe_imovel"] option:checked').textContent;
        const zonaLabel = document.querySelector('[name="fator_localizacao"] option:checked').textContent;
        const usoLabel = document.querySelector('[name="finalidade_imovel"] option:checked').textContent;

        const taxa = uso === "Habitação" ? 0.004 : 0.007;


        console.log({ano, Ae, Al, P, Fl, Fa, custoLabel, zonaLabel, uso, taxa});
        // Fórmula do Valor Patrimonial
        const VP = ((Ae * P * Fa) + (0.05 * Al * P)  * Fl) ;

        // Imposto
        const imposto = VP * taxa ;

        // Mostrar resultado
        document.getElementById("resultado").classList.remove("hidden");
        document.getElementById("valorPatrimonial").innerHTML =
            `<span class="font-medium">Valor Patrimonial (VP):</span>
            ${VP.toLocaleString("pt-MZ", { minimumFractionDigits: 2, maximumFractionDigits: 2 })} MZN`;

        document.getElementById("imposto").innerHTML =
            `<span class="font-medium">Imposto IPRA:</span>
            ${imposto.toLocaleString("pt-MZ", { minimumFractionDigits: 2, maximumFractionDigits: 2 })} MZN
            <span class="text-gray-600">(taxa ${taxa}%, ${usoLabel})</span>`;

        // Mostrar coeficientes
        document.getElementById("coeficientes").innerHTML = `
            <div class="bg-white rounded-lg p-2 border"><span class="font-medium">Ano</span>: ${ano}</div>
            <div class="bg-white rounded-lg p-2 border"><span class="font-medium">Ae</span>: ${Ae}</div>
            <div class="bg-white rounded-lg p-2 border"><span class="font-medium">P</span>: ${P}
                <span class="text-gray-500">(${custoLabel})</span></div>
            <div class="bg-white rounded-lg p-2 border"><span class="font-medium">Fa</span>: 1</div>
            <div class="bg-white rounded-lg p-2 border"><span class="font-medium">Al</span>: ${Al}</div>
            <div class="bg-white rounded-lg p-2 border"><span class="font-medium">Fl</span>: ${Fl}
                <span class="text-gray-500">(${zonaLabel})</span></div>
        `;
    }
const btnSubmeter = document.getElementById("btnSubmeter");
  const modal = document.getElementById("confirmModal");
  const resumo = document.getElementById("dadosResumo");
  const cancelar = document.getElementById("cancelarBtn");
  const confirmar = document.getElementById("confirmarBtn");
  const form = document.getElementById("ipraForm");

//   btnSubmeter.addEventListener("click", () => {
//     const data = new FormData(form);
//     let html = "<ul class='space-y-1'>";
//     data.forEach((v, k) => {
//       if (v.trim()) html += `<li><strong>${k}:</strong> ${v}</li>`;
//     });
//     html += "</ul>";
//     resumo.innerHTML = html;
//     modal.classList.remove("hidden");
//     modal.classList.add("flex");
//   });






document.addEventListener('DOMContentLoaded', function() {
  const postoAdministrativoSelect = document.getElementById('postoAdministrativo');
  const bairroSelect = document.getElementById('bairro');

  postoAdministrativoSelect.addEventListener('change', function() {
    const postoAdministrativo = this.value;
    // console.log(postoAdministrativo);

    // Limpa os bairros existentes
    bairroSelect.innerHTML = '<option value="">-- Selecione -- </option>';

    if (postoAdministrativo) {
      fetch(`/bairros/${postoAdministrativo}`)
        .then(response => {
          if (!response.ok) throw new Error('Erro ao buscar bairros');
          return response.json();
        })
        .then(data => {
          data.forEach(value => {
            const option = document.createElement('option');
            option.value = value.id;
            option.textContent = value.nome;
            bairroSelect.appendChild(option);
          });
        })
        .catch(error => {
          console.error('Erro:', error);
        });
    }
  });
});

</script>
@endsection
