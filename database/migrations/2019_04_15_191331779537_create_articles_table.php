<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
		
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
			$table->string('title',255);
            $table->string('slug',255)->nullable();
			$table->string('description',255)->nullable();
			$table->string('featured_image',255)->nullable();
			$table->string('files',255)->nullable();;
            $table->string('slideshow',255)->nullable();
            $table->string('editableFile',255)->nullable();
            $table->string('category',255)->nullable();
			$table->string('meta_title',255)->nullable();
			$table->string('type',255)->nullable();
			$table->string('author',255)->nullable();
			$table->integer('total_viewed')->nullable();
            $table->integer('total_dwlnd_pdf')->nullable();
            $table->integer('total_dwlnd_editable')->nullable();
            $table->integer('full_access_requested')->nullable();
            $table->integer('views')->nullable();
            $table->integer('payment')->nullable();
            $table->integer('status')->nullable();
            $table->integer('is_protected')->nullable();
            $table->integer('is_featured')->nullable();
            $table->integer('position_order')->nullable();
			$table->text('excerpt');
			$table->text('preview_imgs');
			$table->text('meta_description');
			$table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}