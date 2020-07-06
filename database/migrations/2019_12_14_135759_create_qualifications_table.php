<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('field')->nullable();
            $table->string('medium');
            $table->string('duration')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('institute')->nullable();
            $table->unsignedBigInteger('staff_id');
            $table->timestamps();

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
        Schema::dropIfExists('qualifications');
    }
}
