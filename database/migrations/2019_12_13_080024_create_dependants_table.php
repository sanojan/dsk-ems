<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dob')->nullable();
            $table->string('relationship');
            $table->string('designation')->nullable();
            $table->string('workplace')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('staff_id');

            $table->foreign('staff_id')
            ->references('id')->on('staff')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependants');
    }
}
