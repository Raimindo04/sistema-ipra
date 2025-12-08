<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToIpraFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ipra_forms', function (Blueprint $table) {
            // Adiciona a coluna user_id após o id (opcional)
            $table->foreignIdFor(User::class)
                ->constrained()     // referencia a tabela users e id automaticamente
                ->onDelete('cascade'); // quando o user é apagado, apaga o formulário
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ipra_forms', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
