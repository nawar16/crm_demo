<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Permission;

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


                /** Create new permissions */
                $acpp = Permission::create([
                    'display_name' => 'Manage salaries',
                    'name' => 'salary-manage',
                    'description' => 'Be able to manage salaries for all users',
                    'grouping' => 'hr',
                ]);
        
                /** Create new permissions */
                $vcpp = Permission::create([
                    'display_name' => 'View salaries',
                    'name' => 'salary-view',
                    'description' => 'Be able to view salaries for all users and see who is absent today on the dashboard',
                    'grouping' => 'hr',
                ]);
        
                $roles = \App\Models\Role::whereIn('name', ['owner', 'administrator'])->get();
        
                foreach ($roles as $role) {
                    $role->permissions()->attach([$acpp->id, $vcpp->id]);
                }
                
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
