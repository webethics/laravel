<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    public function up()
    {
		
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name',255);
           $table->nullableTimestamps();
            $table->softDeletes();
			
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}