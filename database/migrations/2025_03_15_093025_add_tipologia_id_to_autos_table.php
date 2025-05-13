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
        Schema::table('autos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipologia_id')->after('modello')->nullable();
            $table->foreign('tipologia_id')->references('id')->on('tipologias')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('autos', function (Blueprint $table) {

            $table->dropForeign('autos_tipologia_id_foreign');
            $table->dropColumn('tipologia_id');

        });
    }
};
