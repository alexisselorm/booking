<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            
            // TODO Remove duration from bookings
            // TODO Create logs for editing a booking

            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('venue_id');
            $table->string('name');
            $table->string('department');
            $table->string('event');
            $table->string('phone');
            $table->string('email');
            $table->text('event_desc');
            $table->date('start_date');
            $table->time('start_time');
            $table->time('end_time');
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
        Schema::dropIfExists('bookings');
    }
}
