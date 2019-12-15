<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('workplace');
            $table->string('designation');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('service_name');
            $table->string('service_class');
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
        Schema::dropIfExists('service_histories');
    }
}
