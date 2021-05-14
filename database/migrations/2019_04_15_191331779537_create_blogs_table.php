<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
		
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title',255);
            $table->string('slug',255)->nullable();
			$table->text('content');
			$table->string('auction_cat',255)->nullable();
			
			
			$table->string('image',255)->nullable();
			
			$table->string('original_image',255)->nullable();
			
            $table->string('mimes',255)->nullable();
			$table->integer('position')->nullable();
			 $table->integer('status')->nullable();
			
			$table->nullableTimestamps();
            $table->softDeletes();
			
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}