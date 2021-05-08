<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appsections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ensectionname',50);
            $table->string('malsectionname',50);
            $table->text('ensectiondetails',50);
            $table->text('malsectiondetails',50);
            $table->unsignedBigInteger('appdepartments_id');
            $table->foreign('appdepartments_id')->references('id')->on('appdepartments');
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
        Schema::dropIfExists('appsections');
    }
}
