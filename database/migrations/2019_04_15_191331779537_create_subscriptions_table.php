<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
		
	
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
			 $table->integer('status')->nullable();
			$table->string('paymentMethod')->nullable();
            $table->string('subscription_id')->nullable();
			
            $table->string('payer_id')->nullable();
			$table->string('plan_id')->nullable();;
           	$table->datetime('subscription_start')->nullable();
            $table->datetime('subscription_end')->nullable();
            $table->string('payer_name')->nullable();
            $table->string('payer_mail');
			
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
