<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            
            // TODO Regular name and alias
            // TODO Make "location" a different table
            $table->id();
            $table->string('name')->unique();
            $table->string('alias');
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->foreignId('location_id')->nullable();
            $table->text('description');
            $table->string('image');
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
        Schema::dropIfExists('venues');
    }
}
