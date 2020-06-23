<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->integer('user_id');//to track the user we need to user id 
            $table->string('address');
            $table->string('phone_number');
            $table->boolean('isVerified')->default(false);
            $table->string('gender');
            $table->string('dob');
            $table->string('experience');
            $table->string('bio');
            $table->string('cover_letter');
            $table->string('resume');
            $table->string('avatar');
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
