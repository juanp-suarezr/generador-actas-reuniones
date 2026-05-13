<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_acta');
            $table->string('tema');
            $table->string('subproceso')->nullable();
            $table->date('fecha');
            $table->string('numero_acta')->nullable();
            $table->enum('tipo', ['interna', 'externa']);
            $table->string('lugar')->nullable();
            $table->string('responsable')->nullable();
            $table->text('descripcion')->nullable();
            $table->json('compromisos')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('share_token')->unique()->nullable();
            $table->timestamp('share_expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
