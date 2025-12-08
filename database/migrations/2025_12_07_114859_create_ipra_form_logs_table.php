<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpraFormLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ipra_form_logs', function (Blueprint $table) {
            $table->id();

            // Relaciona ao registo do ipra_forms alterado
            $table->uuid('ipra_form_id');
            $table->foreign('ipra_form_id')
                ->references('id')
                ->on('ipra_forms')
                ->onDelete('cascade');

            // Quem fez a alteração
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            // JSONs com estado anterior e novo estado
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();

            // Tipo da ação (update, create, delete)
            $table->string('action')->default('update');

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
        Schema::dropIfExists('ipra_form_logs');
    }
}
