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
    Schema::table('peminjamans', function (Blueprint $table) {
        if (!Schema::hasColumn('peminjamans', 'status')) {
            $table->string('status')->default('aktif');
        }
    });
}



    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('peminjamans', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
