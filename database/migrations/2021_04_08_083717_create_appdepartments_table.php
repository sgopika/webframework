<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppdepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appdepartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('deptcategories_id');
            $table->foreign('deptcategories_id')->references('id')->on('deptcategories');
            $table->unsignedBigInteger('departments_id');
            $table->foreign('departments_id')->references('id')->on('departments');
            $table->string('entitle',50);
            $table->string('maltitle',50);
            $table->text('enabout',50);
            $table->text('malabout',50);
            $table->text('enstructure',50);
            $table->text('malstructure',50);
            $table->text('encontact',50);
            $table->text('malcontact',50);
            $table->text('enrelatedlinks',50);
            $table->text('malrelatedlinks',50);
            $table->text('enservices',50);
            $table->text('malservices',50);
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
        Schema::dropIfExists('appdepartments');
    }
}
