<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTezsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tezs', function (Blueprint $table) {
            $table->id();
            $table->string('ogrencinumara');
            $table->string('danısmannumara');
            $table->string('file');
            $table->string('konu');
            $table->string('fileiki');
            $table->string('onay');
            $table->string('konuid');
            $table->string('acıklama');
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
        Schema::dropIfExists('tezs');
    }
}
