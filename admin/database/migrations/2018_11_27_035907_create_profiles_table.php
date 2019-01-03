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
            $table->string('ext')->nullable();
            $table->string('sex');
            $table->text('address');
            $table->string('contact');
            $table->string('blood_type');
            $table->date('dob');
            $table->string('hospital_id');
            $table->string('tin')->nullable();
            $table->string('gsis')->nullable();
            $table->string('phic')->nullable();
            $table->string('pagibig')->nullable();
            $table->string('designation');
            $table->string('e_fname');
            $table->string('e_mname');
            $table->string('e_lname');
            $table->text('e_address');
            $table->string('e_contact');
            $table->string('picture')->nullable();
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
