<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_no')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->timestamps();
            $table->enum('role', ['Farmer', 'Customer'])->default('Customer');
            $table->bigInteger('farmers_id')->nullable()->unsigned();
            $table->bigInteger('customers_id')->nullable()->unsigned();

            //relationship
            $table->foreign("farmers_id")->references("id")->on("farmers");
            $table->foreign("customers_id")->references("id")->on("customers");





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
};
