<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormInputOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_input_options', function (Blueprint $table) {
            $table->id();
            $table->integer('form_input_id')->unsigned();
            $table->text('input');
            $table->timestamps();

            $table->foreign('form_input_id')->references('id')->on('form_inputs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_input_options');
    }
}
