<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
		
		
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
			
            $table->string('plan_id',255)->nullable();
			$table->string('stripe_plan_id',255)->nullable();
			$table->string('title',255)->nullable();
			$table->string('arabic_title',255)->nullable();;
            $table->string('slug',255)->nullable();
            $table->double('price')->nullable();
                     
            $table->integer('status')->nullable();
            $table->integer('num_of_users')->nullable();
            $table->integer('display_order')->nullable();
            $table->integer('mem_length')->nullable();
       
			$table->text('description');
			$table->text('arabic_description');

			$table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
}