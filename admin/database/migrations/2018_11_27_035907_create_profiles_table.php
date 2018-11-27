<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('ext');
            $table->text('address');
            $table->string('blood_type');
            $table->date('dob');
            $table->string('tin');
            $table->string('gsis');
            $table->string('phic');
            $table->string('pagibig');
            $table->string('designation');
            $table->string('e_fname');
            $table->string('e_mname');
            $table->string('e_lname');
            $table->text('e_address');
            $table->string('contact');
            $table->string('picture');
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
        Schema::dropIfExists('profiles');
    }
}
