<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettervolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newslettervolumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('poster');
            $table->string('alt',50);
            $table->string('entitle',50);
            $table->string('maltitle',50);
            $table->string('entooltip',50);
            $table->string('maltooltip',50);
            $table->date('releasedate');
            $table->string('size',50);
            $table->string('duration',50);
            $table->unsignedBigInteger('filetypes_id');
            $table->foreign('filetypes_id')->references('id')->on('filetypes');
            $table->unsignedBigInteger('contenttypes_id');
            $table->foreign('contenttypes_id')->references('id')->on('contenttypes');
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
        Schema::dropIfExists('newslettervolumes');
    }
}
