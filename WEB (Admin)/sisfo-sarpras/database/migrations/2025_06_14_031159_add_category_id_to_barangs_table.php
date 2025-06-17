<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('barangs', function (Blueprint $table) {
        $table->unsignedBigInteger('category_id')->after('stok');

        // Jika pakai relasi foreign key:
        // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('barangs', function (Blueprint $table) {
        // Kalau pakai foreign key, drop foreign key dulu
        // $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}

};
