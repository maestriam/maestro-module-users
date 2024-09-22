<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Nome da tabela de usuários que será criada pelo módulo
     *
     * @var string
     */
    private string $table = 'users';

    /**
     * Nome da tabela padrão que vem junto com projetos Laravel. 
     *
     * @var string
     */
    private string $legacy = 'users_legacy';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table)) {
            Schema::rename($this->table, $this->legacy);
        }
        
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
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
        Schema::dropIfExists($this->table);
        Schema::rename($this->legacy, $this->table);
    }
};
