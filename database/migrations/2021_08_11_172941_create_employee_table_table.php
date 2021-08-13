<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_table', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('emp_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('professional_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->datetime('date_of_joining')->nullable();
            $table->datetime('date_of_birth')->nullable();
            $table->string('current_salary')->nullable();
            $table->string('category')->nullable();
            $table->string('pan_details')->nullable();
            $table->string('epfo_details')->nullable();
            $table->string('esi_details')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('ifsc_code')->nullable();
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
        Schema::dropIfExists('employee_table');
    }
}
