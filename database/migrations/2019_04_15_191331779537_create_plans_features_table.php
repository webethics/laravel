<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansFeaturesTable extends Migration
{
    public function up()
    {
		
		
        Schema::create('plan_features', function (Blueprint $table) {
            $table->increments('id');
			
            $table->string('plan_id',255)->nullable();
			$table->string('feature_text',255)->nullable();
			$table->string('arabic_feature_text',255)->nullable();
			$table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plan_features');
    }
}