<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeptintroductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deptintroductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file1',100);
            $table->string('alt1',50);
            $table->string('enuser1',50);
            $table->string('maluser1',100);
            $table->string('endesg1',50);
            $table->string('maldesg1',100);
            $table->string('file2',100);
            $table->string('alt2',50);
            $table->string('enuser2',50);
            $table->string('maluser2',100);
            $table->string('endesg2',50);
            $table->string('maldesg2',100);
            $table->string('entooltip',50);
            $table->string('maltooltip',100);
            $table->string('entitle',50);
            $table->string('maltitle',100);
            $table->string('ensubtitle',100);
            $table->string('malsubtitle',250);
            $table->text('enbrief',50);
            $table->text('malbrief',100);
            $table->text('encontent',50);
            $table->text('malcontent',100);
            $table->tinyInteger('homepagestatus')->default('1');
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
        Schema::dropIfExists('deptintroductions');
    }
}
