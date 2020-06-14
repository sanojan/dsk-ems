<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualifications', function (Blueprint $table) {
            $table->string('subject')->nullable();
            $table->string('grade', 1)->nullable();         
            $table->string('index_no')->nullable();
            $table->string('center_no')->nullable();
            $table->integer('year')->nullable();
            $table->string('attempt')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualifications', function (Blueprint $table) {            
            $table->dropColumn('subject');
            $table->dropColumn('grade');
            $table->dropColumn('index_no');
            $table->dropColumn('center_no');
            $table->dropColumn('year');
            $table->dropColumn('attempt');
        });
    }
}
