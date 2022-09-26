<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('month')->nullable();

            $table->integer('leave_days')->nullable();
            $table->integer('unjustfied_days')->nullable();
            $table->integer('deduction_days')->nullable();
            $table->integer('unjustified_hour')->nullable();
            $table->integer('deduction_hour')->nullable();
            $table->integer('sick_days')->nullable();
            $table->integer('annual_days')->nullable();
            $table->integer('leave_hour')->nullable();
            $table->integer('late_hour')->nullable();
            $table->integer('total_hour')->nullable();
            $table->float('basic_salary')->nullable();
            $table->integer('accomdation')->nullable();
            $table->integer('transport')->nullable();
            $table->integer('tele_communication')->nullable();
            $table->float('total_salary')->nullable();
            $table->integer('absence_deduction_day')->nullable();
            $table->integer('total_leaves')->nullable();
            $table->integer('over_time_count')->nullable();
            $table->integer('over_time')->nullable();
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
        Schema::dropIfExists('salaries');
    }
}
