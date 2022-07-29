<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->string('name');

            $table->string('email');
            
            $table->bigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('designation_id')->nullable();
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('level_id')->nullable();
            $table->foreign('level_id')->references('id')->on('levels')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('reporting_mgr_id')->nullable();
            $table->foreign('reporting_mgr_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('age_group_id')->nullable();
            $table->foreign('age_group_id')->references('id')->on('age_groups')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('ethnicity_id')->nullable();
            $table->foreign('ethnicity_id')->references('id')->on('ethnicity')->onUpdate('cascade')->onDelete('cascade');

            $table->date('date_of_join')->nullable();

            $table->bigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
