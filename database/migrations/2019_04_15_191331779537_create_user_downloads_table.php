<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDownloadsTable extends Migration
{
    public function up()
    {
        Schema::create('user_downloads', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->integer('article_id');
			$table->string('type');
			$table->string('language')->nullable();;
            
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_downloads');
    }
}
