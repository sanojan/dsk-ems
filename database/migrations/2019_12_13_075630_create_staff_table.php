<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('gender');
            $table->string('civil_status');
            $table->string('religion');
            $table->string('nationality');
            $table->date('dob');
            $table->mediumText('permanant_address')->nullable();
            $table->mediumText('temporary_address')->nullable();
            $table->string('mobile_no', 10)->nullable();
            $table->string('landline_no', 10)->nullable();
            $table->string('email')->nullable();
            $table->string('nic', 12);
            $table->string('service');
            $table->string('designation');
            $table->string('class');            
            $table->string('profile_pic')->nullable()->default('noimage.png');
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
        Schema::dropIfExists('staff');
    }
}
