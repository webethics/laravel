<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('upwork_id')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_url')->nullable();
            $table->string('client_budget')->nullable();
            $table->string('our_estimate')->nullable();
            $table->string('bidder_id')->nullable();
            $table->string('status')->nullable();
            // $table->string('reason_for_lost')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
