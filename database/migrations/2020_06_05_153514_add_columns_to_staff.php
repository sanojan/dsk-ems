<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->string('recruitment_type')->nullable();
            $table->string('appointment_no')->nullable();
            $table->date('appointment_date')->nullable();
            $table->string('personal_file_no')->nullable();
            $table->string('officer_subject')->nullable();
            $table->string('officer_branch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('recruitment_type');
            $table->dropColumn('appointment_no');
            $table->dropColumn('appointment_date');
            $table->dropColumn('personal_file_no');
            $table->dropColumn('officer_subject');
            $table->dropColumn('officer_branch');

        });
    }
}
