<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiletypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filetypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('entitle',50);
            $table->string('maltitle',100);
            $table->boolean('status')->default('1');
            $table->unsignedBigInteger('contenttypes_id');
            $table->foreign('contenttypes_id')->references('id')->on('contenttypes');
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
        Schema::dropIfExists('filetypes');
    }
}
