<?php

namespace App\Http\Controllers;

use App\Exports\IpraFormsExport;
use App\Models\Bairro;
use App\Models\ClasseImovel;
use App\Models\FinalidadeImovel;
use App\Models\IpraForm;
use App\Models\PostoAdministrativo;
use App\Models\TipoDocumentoIdentificacao;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ContribuinteController extends Controller
{

    public function index ()
    {
        return view('contribuintes.index');
    }
   public function create()
    {
        $dados = session('ipra_dados');
        $primeiro = TipoDocumentoIdentificacao::first();
        $tiposDocumentoIdentificacao = TipoDocumentoIdentificacao::where('id', '!=', $primeiro->id)->get();
        $postosAdministrativos = PostoAdministrativo::with('bairros')->get();
        $zonas = Zona::all();
        $classesImovel = \App\Models\ClasseImovel::all();
        $finalidadesImovel = \App\Models\FinalidadeImovel::all();

        $bairros = ($postoId = old('posto_administrativo') ?? ($dados['posto_administrativo'] ?? null))
            ? (PostoAdministrativo::find($postoId)->bairros ?? collect())
            : collect();

        return view('contribuintes.create', compact('postosAdministrativos','tiposDocumentoIdentificacao', 'zonas', 'classesImovel', 'finalidadesImovel', 'dados', 'bairros'));
    }

    public function store(Request $request)
    {


    }

    public function show (IpraForm $ipraForm)
    {

        //Ipra calculation
        $Ae = $ipraForm->area_construida; //Area edificada
        $P = $ipraForm->classeImovel->preco_m2; // Preco medio por Metro quadrado
        $Fl = $ipraForm->zona->fator_localizacao; // Factor de Localizacao
        $Fa = $this->calcularFactorAntiguidade($ipraForm->ano_construcao); // Factor de Antiguidade
        $Al = $ipraForm->area_terreno - $ipraForm->area_construida; // Area de Logradouro
        $taxaUso = $ipraForm->finalidadeImovel->fator_finalidade;


        $Vp = ($Ae * $P * $Fa) + ( 0.05 * $Al * $P  ) * $Fl;
        $ipra = $Vp * $taxaUso;

        return view('contribuintes.show', compact('ipraForm','Ae', 'P', 'Fl', 'Fa', 'Al', 'taxaUso', 'Vp', 'ipra'));
    }


    public function validar(Request $request)
    {
 // Tipo de pessoa vem do form (ex: 'singular' ou 'colectiva')
    $tipoPessoa = $request->input('tipoPessoa');

    // Regras comuns (Imóvel)
    $regrasImovel = [
        'posto_administrativo' => 'required|numeric|exists:posto_administrativos,id',
        'bairro' => 'required|numeric|exists:bairros,id',
        'avenida' => 'required|string|max:100',
        'unidade_comunal' => 'nullable|string|max:100',
        'quarteirao' => 'nullable|string|max:50',
        'proximo_de' => 'nullable|string|max:100',
        'numero_talhao' => 'nullable|string|max:50',
        'numero_parcela' => 'nullable|string|max:50',
        'numero_contribuinte' => 'nullable|string|max:50',
        'ano_construcao' => 'required|integer|min:1800|max:' . date('Y'),
        'area_construida' => 'required|numeric|min:1',
        'area_terreno' => 'required|numeric|min:1',
        'numero_andares' => 'nullable|integer|min:1',
        'tipo_construcao' => 'required|string|max:50',
        'classe_imovel' => 'required|numeric|exists:classe_imovels,id',
        'zona' => 'required|exists:zonas,id',
        'finalidade_imovel' => 'required|exists:finalidade_imovels,id',
        'status_isencao' => 'nullable|string|max:255',
        'area_isentada' => 'nullable|numeric|min:0',
        'tipo_valor_patrimonial' => 'required|string|max:50',
        'valor_patrimonial' => 'nullable|numeric|min:0',
        'tipo_aquisicao' => 'nullable|string|max:50',
        'numero_insercao_matriz' => 'nullable|string|max:50',
        'pluscode' => 'nullable|string|max:50',
        'observacoes' => 'nullable|string|max:1000',
    ];

    // Regras Pessoa Singular
    $regrasSingular = [
        'ps_nome' => 'required|string|max:255',
        'ps_apelido' => 'required|string|max:255',
        'ps_tipo_documento' => 'required|numeric|exists:tipo_documento_identificacaos,id',
        'ps_numero_documento' => 'required|string|max:100',
        'ps_validade_documento' => 'required|date',
        'ps_nacionalidade' => 'required|string|max:100',
        'ps_nuit' => 'required|string|max:20',
        'ps_telefone' => ['required', 'regex:/^(82|83|84|85|86|87)\d{7}$/'],
        'ps_telefone_fixo' => 'nullable|string|max:20',
        'ps_telefone_opcional' => 'nullable|string|max:20',
        'ps_endereco' => 'required|string|max:255',
        'ps_email' => 'required|email',
    ];

    // Regras Pessoa Colectiva
    $regrasJuridica = [
        'pj_representante' => 'required|string|max:255',
        'pj_nome_empresa' => 'required|string|max:255',
        'pj_nuit' => 'required|string|max:20',
        'pj_telefone' => ['required', 'regex:/^(82|83|84|85|86|87)\d{7}$/'],
        'pj_telefone_fixo' => 'nullable|string|max:20',
        'pj_telefone_opcional' => 'nullable|string|max:20',
        'pj_endereco' => 'required|string|max:255',
        'pj_email' => 'required|email',
    ];

    // Combinar regras conforme o tipo de pessoa
    // Combinar regras conforme o tipo de pessoa
    if ($tipoPessoa === 'Singular') {
        $regras = array_merge($regrasSingular, $regrasImovel);
    } elseif ($tipoPessoa === 'Juridica') {
        $regras = array_merge($regrasJuridica, $regrasImovel);
    } else {
        $regras = $regrasImovel; // fallback
    }


        // $validator = Validator::make($request->all(), $regras);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $request->validate($regras, [
        'ps_telefone.regex' => 'O telefone deve começar com 82, 83, 84, 85, 86 ou 87 e conter 9 dígitos no total.',
        'pj_telefone.regex' => 'O telefone deve começar com 82, 83, 84, 85, 86 ou 87 e conter 9 dígitos no total.',
    ]);

        // Armazena dados em sessão temporária para confirmação
        $dados = $request->all();
        session(['ipra_dados' => $dados]);

        // Redireciona para a tela de confirmação
        return redirect()->route('contribuintes.confirmar');
    }

    public function confirmar(Request $request)
    {
        $dados = session('ipra_dados');
        $dataToShow = $dados;
        $classeImovel= ClasseImovel::find($dados['classe_imovel']);
        $zona = Zona::find($dados['zona']);
        $finalidadeImovel = FinalidadeImovel::find($dados['finalidade_imovel']);

        $dataToShow['ps_tipo_documento'] = optional(TipoDocumentoIdentificacao::find($dados['ps_tipo_documento']))->nome;
        $dataToShow['posto_administrativo'] = optional(PostoAdministrativo::find($dados['posto_administrativo']))->nome;
        $dataToShow['bairro'] = optional(Bairro::find($dados['bairro']))->nome;
        $dataToShow['classe_imovel'] = $classeImovel->nome;
        $dataToShow['zona'] =  $zona->nome;
        //Ipra calculation
        $Ae = $dataToShow['area_construida']; //Area edificada
        $P = $classeImovel->preco_m2; // Preco medio por Metro quadrado
        $Fl = $zona->fator_localizacao; // Factor de Localizacao
        $Fa = $this->calcularFactorAntiguidade($dataToShow['ano_construcao']); // Factor de Antiguidade
        $Al = $dataToShow['area_terreno'] - $dataToShow['area_construida']; // Area de Logradouro
        $taxaUso = $finalidadeImovel->fator_finalidade;


        $Vp = ($Ae * $P * $Fa) + ( 0.05 * $Al * $P  ) * $Fl;
        $ipra = $Vp * $taxaUso;

        if (!$dados) {
            return redirect()->route('contribuintes.create')->with('error', 'Nenhum dado encontrado para confirmar.');
        }



        return view('contribuintes.confirmar', compact('dados','dataToShow', 'Ae', 'P', 'Fl', 'Fa', 'Al', 'taxaUso', 'Vp', 'ipra', 'finalidadeImovel'));
    }

    public function salvar()
{
    $dados = session('ipra_dados');
    $saveData['tipo_pessoa'] = $dados['tipoPessoa'];
    if($dados['tipoPessoa'] === 'Singular') {
        $saveData['ps_nome'] = $dados['ps_nome'];
        $saveData['ps_apelido'] = $dados['ps_apelido'];
        $saveData['tipo_documento_identificacao_id'] = $dados['ps_tipo_documento'];
        $saveData['ps_numero_documento'] = $dados['ps_numero_documento'];
        $saveData['ps_validade_documento'] = $dados['ps_validade_documento'];
        $saveData['ps_nacionalidade'] = $dados['ps_nacionalidade'];
        $saveData['nuit'] = $dados['ps_nuit'];
        $saveData['telefone'] = $dados['ps_telefone'];
        $saveData['telefone_fixo'] = $dados['ps_telefone_fixo'];
        $saveData['telefone_opcional'] = $dados['ps_telefone_opcional'];
        $saveData['endereco'] = $dados['ps_endereco'];
        $saveData['email'] = $dados['ps_email'];
    } else {
        $saveData['pj_representante'] = $dados['pj_representante'];
        $saveData['pj_nome_empresa'] = $dados['pj_nome_empresa'];
        $saveData['tipo_documento_identificacao_id'] = 1; // Assuming '1' is the ID for 'Sem Documento'
        $saveData['nuit'] = $dados['pj_nuit'];
        $saveData['telefone'] = $dados['pj_telefone'];
        $saveData['telefone_fixo'] = $dados['pj_telefone_fixo'];
        $saveData['telefone_opcional'] = $dados['pj_telefone_opcional'];
        $saveData['endereco'] = $dados['pj_endereco'];
        $saveData['email'] = $dados['pj_email'];
    }
    $saveData['posto_administrativo_id'] = $dados['posto_administrativo'];
    $saveData['bairro_id'] = $dados['bairro'];
    $saveData['avenida'] = $dados['avenida'];
    $saveData['unidade_comunal'] = $dados['unidade_comunal'];
    $saveData['quarteirao'] = $dados['quarteirao'];
    $saveData['proximo_de'] = $dados['proximo_de'];
    $saveData['numero_talhao'] = $dados['numero_talhao'];
    $saveData['numero_parcela'] = $dados['numero_parcela'];
    $saveData['numero_contribuinte'] = $dados['numero_contribuinte'];
    $saveData['ano_construcao'] = $dados['ano_construcao'];
    $saveData['area_construida'] = $dados['area_construida'];
    $saveData['area_terreno'] = $dados['area_terreno'];
    $saveData['numero_andares'] = $dados['numero_andares'];
    $saveData['tipo_construcao'] = $dados['tipo_construcao'];
    $saveData['classe_imovel_id'] = $dados['classe_imovel'];
    $saveData['zona_id'] = $dados['zona'];
    $saveData['finalidade_imovel_id'] = $dados['finalidade_imovel'];
    $saveData['status_isencao'] = $dados['status_isencao'] ?? null;
    $saveData['area_isentada'] = $dados['area_isentada'] ?? null;
    $saveData['tipo_valor_patrimonial'] = $dados['tipo_valor_patrimonial'];
    $saveData['valor_patrimonial'] = $dados['valor_patrimonial'];
    $saveData['tipo_aquisicao'] = $dados['tipo_aquisicao'];
    $saveData['numero_insercao_matriz'] = $dados['numero_insercao_matriz'] ?? null;
    $saveData['pluscode'] = $dados['pluscode'] ?? null;
    $saveData['observacoes'] = $dados['observacoes'] ?? null;

    \App\Models\IpraForm::create($saveData);
    // Model::create($dados);
    session()->forget('ipra_dados');
    return redirect()->route('contribuintes.create')->with('success', 'Dados salvos com sucesso!');
}

   public function limpar()
{
    // $dados = session('ipra_dados');
    // Model::create($dados);
    session()->forget('ipra_dados');
    return redirect()->route('contribuintes.create')->with('success', 'Dados limpos com sucesso!');
}

    public function calcularFactorAntiguidade($ano)
    {
        $valor = 1.0;
        if ($ano >= 2021) $valor = 1.0;
        else if ($ano >= 2015) $valor = 0.95;
        else if ($ano >= 2010) $valor = 0.90;
        else if ($ano >= 2005) $valor = 0.85;
        else if ($ano >= 1995) $valor = 0.80;
        else if ($ano >= 1985) $valor = 0.75;
        else if ($ano >= 1975) $valor = 0.70;
        else $valor = 0.65;
        return $valor;
    }

     public function export()
    {
        return Excel::download(new IpraFormsExport, 'ipraforms.xlsx');
    }
}
