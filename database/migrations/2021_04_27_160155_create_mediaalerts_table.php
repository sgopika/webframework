<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaalertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediaalerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('entitle',50);
            $table->string('maltitle',50);
            $table->string('ensubtitle',100);
            $table->string('malsubtitle',250);
            $table->text('enbrief',50);
            $table->text('malbrief',50);
            $table->text('encontent',50);
            $table->text('malcontent',50);
            $table->text('poster');
            $table->string('alt',50);
            $table->text('file');
            $table->string('size',50);
            $table->string('duration',50);
            $table->tinyInteger('homepagestatus')->default('1');
            $table->unsignedBigInteger('filetypes_id');
            $table->foreign('filetypes_id')->references('id')->on('filetypes');
            $table->unsignedBigInteger('contenttypes_id');
            $table->foreign('contenttypes_id')->references('id')->on('contenttypes');
            $table->integer('contributor_status')->default('0');
            $table->integer('contributor_userid');
            $table->timestamp('contributor_timestamp')->nullable();
            $table->integer('moderator_status')->default('0');
            $table->integer('moderator_userid');
            $table->timestamp('moderator_timestamp')->nullable();
            $table->integer('approve_status')->default('0');
            $table->integer('approve_userid');
            $table->timestamp('approve_timestamp')->nullable();
            $table->Integer('lock_status')->default('0');
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
        Schema::dropIfExists('mediaalerts');
    }
}
