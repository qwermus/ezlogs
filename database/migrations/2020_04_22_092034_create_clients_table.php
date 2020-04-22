<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 10);
            $table->string('surname', 10);
            $table->tinyInteger('age')->unsigned()->index();
            $table->char('license', 8); // Ohio AB123456
            $table->string('photo', 60);
            $table->string('phone_text', 15);
            $table->string('phone_int', 10);
            $table->text('address');
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
        Schema::dropIfExists('clients');
    }
}
