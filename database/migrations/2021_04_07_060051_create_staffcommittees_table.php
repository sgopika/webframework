<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffcommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffcommittees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('staffs_id');
            $table->foreign('staffs_id')->references('id')->on('staff');
            $table->unsignedBigInteger('committees_id');
            $table->foreign('committees_id')->references('id')->on('committees');
            $table->unsignedBigInteger('hierarchies_id');
            $table->foreign('hierarchies_id')->references('id')->on('hierarchies');
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
        Schema::dropIfExists('staffcommittees');
    }
}
