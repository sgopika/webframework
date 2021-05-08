<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershiprequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membershiprequests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->unsignedBigInteger('offices_id');
            $table->foreign('offices_id')->references('id')->on('offices');
            $table->unsignedBigInteger('departments_id');
            $table->foreign('departments_id')->references('id')->on('departments');
            $table->unsignedBigInteger('designations_id');
            $table->foreign('designations_id')->references('id')->on('designations');
            $table->bigInteger('mobile');
            $table->string('email',50);
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
        Schema::dropIfExists('membershiprequests');
    }
}
