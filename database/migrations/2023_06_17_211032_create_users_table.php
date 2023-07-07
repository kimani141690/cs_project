<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farmers_id')->nullable()->unsigned();
            $table->bigInteger('customers_id')->nullable()->unsigned();
            $table->enum('role', ['Farmer', 'Customer'])->default('Customer');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('account_status', ['activated', 'inactive', 'blocked'])->default('inactive');
            $table->string('google_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

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
