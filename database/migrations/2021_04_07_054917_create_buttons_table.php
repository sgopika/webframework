<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateButtonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buttons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file',100);
            $table->string('iconclass',50);
            $table->string('colorclass',10);
            $table->string('entitle',50);
            $table->string('maltitle',50);
            $table->string('entooltip',50);
            $table->string('maltooltip',50);
            $table->bigInteger('components_id');
            $table->bigInteger('articles_id');
            $table->unsignedBigInteger('menulinktypes_id');
            $table->foreign('menulinktypes_id')->references('id')->on('menulinktypes');
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
        Schema::dropIfExists('buttons');
    }
}
