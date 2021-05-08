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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('malname',100);
            $table->bigInteger('mobile');
            $table->unsignedBigInteger('staffcategories_id');
            $table->foreign('staffcategories_id')->references('id')->on('staffcategories');
            $table->unsignedBigInteger('designations_id');
            $table->foreign('designations_id')->references('id')->on('designations');
            $table->unsignedBigInteger('departments_id');
            $table->foreign('departments_id')->references('id')->on('departments');
            $table->unsignedBigInteger('offices_id');
            $table->foreign('offices_id')->references('id')->on('offices');
            $table->boolean('2fa')->default('0');;
            $table->tinyInteger('otp')->default('0');
            $table->timestamp('otpsentts')->useCurrent();
            $table->timestamp('otpverifiedts')->useCurrent();
            $table->unsignedBigInteger('usertypes_id');
            $table->foreign('usertypes_id')->references('id')->on('usertypes');
            $table->boolean('status')->default('1');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
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
