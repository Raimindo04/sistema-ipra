<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna role_id depois da coluna id
            $table->foreignIdFor(Role::class)
                  ->nullable()        // permite usuário sem papel inicial
                  ->after('id')
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->nullOnDelete();   // se o role for apagado, seta NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
