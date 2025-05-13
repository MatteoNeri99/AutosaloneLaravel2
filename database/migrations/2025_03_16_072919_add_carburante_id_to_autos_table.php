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
            $table->unsignedBigInteger('carburante_id')->after('modello')->nullable();
            $table->foreign('carburante_id')->references('id')->on('carburantes')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('autos', function (Blueprint $table) {
            $table->dropForeign('autos_carburante_id_foreign');
            $table->dropColumn('carburante_id');
        });
    }
};
