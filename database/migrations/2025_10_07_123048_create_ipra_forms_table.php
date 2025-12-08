<?php

use App\Models\Bairro;
use App\Models\PostoAdministrativo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpraFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipra_forms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('tipo_pessoa', ['Singular', 'Juridica'])->default('Singular');
            $table->string('ps_nome')->nullable();
            $table->string('ps_apelido')->nullable();
            $table->foreignIdFor(\App\Models\TipoDocumentoIdentificacao::class);
            $table->string('ps_numero_documento')->nullable();
            $table->date('ps_validade_documento')->nullable();
            $table->string('ps_nacionalidade')->nullable();
            $table->string('pj_representante')->nullable();
            $table->string('pj_nome_empresa')->nullable();
            $table->string('nuit');
            $table->string('telefone');
            $table->string('telefone_fixo')->nullable();
            $table->string('telefone_opcional')->nullable();
            $table->string('endereco');
            $table->string('email');
            $table->string('pluscode');
            $table->foreignIdFor(PostoAdministrativo::class);
            $table->foreignIdFor(Bairro::class);
            $table->string('avenida')->nullable();
            $table->string('unidade_comunal')->nullable();
            $table->string('quarteirao')->nullable();
            $table->string('proximo_de')->nullable();
            $table->string('numero_talhao')->nullable();
            $table->string('numero_parcela')->nullable();
            $table->string('numero_contribuinte')->nullable();
            $table->year('ano_construcao');
            $table->decimal('area_construida',10,2);
            $table->decimal('area_terreno', 10,2);
            $table->integer('numero_andares');
            $table->string('tipo_construcao');
            $table->foreignIdFor(\App\Models\ClasseImovel::class);
            $table->foreignIdFor(\App\Models\Zona::class);
            $table->foreignIdFor(\App\Models\FinalidadeImovel::class);
            $table->string('status_isencao')->nullable();
            $table->decimal('area_isentada', 10,2)->nullable();
            $table->string('tipo_valor_patrimonial');
            $table->decimal('valor_patrimonial',  15, 2)->nullable();
            $table->string('tipo_aquisicao')->nullable();
            $table->string('numero_insercao_matriz')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ipra_forms');
    }
}
