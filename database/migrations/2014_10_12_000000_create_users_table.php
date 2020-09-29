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
            $table->id();
            $table->enum('type', ['user', 'admin'])->default('user');
            $table->string('name')->nullable();
            $table->string('number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->text('billing_address')->nullable();
            $table->string('upgrade_transaction_id')->nullable();
            $table->boolean('is_upgraded')->default(false);
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
