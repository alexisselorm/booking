<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
    
            // TODO Set user status as available or non-available
            // TODO People from same departments should be able to edit bookings
            $table->id()->unique();
            $table->string('fname',30);
            $table->string('mname',30)->nullable();
            $table->string('lname',30);
            $table->string('email');
            $table->string('password');
            // A user can be set as active or inactive
            $table->boolean('status')->default(1);
            $table->foreignId('department_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
