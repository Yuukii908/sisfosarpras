<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKondisisTable extends Migration
{
    public function up()
    {
        Schema::create('kondisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kondisi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kondisis');
    }
}
