<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_table', function (Blueprint $table) {
            $table->id();
            
            $table->string('tech_stack')->nullable();
            $table->string('past_experience')->nullable();
            $table->string('past_companies')->nullable();
            $table->string('tele_verification')->nullable();
            $table->string('email_verification')->nullable();    
            $table->string('hired_through')->nullable();
            $table->string('hired_on')->nullable();
            $table->datetime('increment_due')->nullable();
            $table->datetime('leaving_date')->nullable();
            $table->string('education')->nullable();
            $table->string('comments')->nullable();
            
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
        Schema::dropIfExists('hr_table');
    }
}
