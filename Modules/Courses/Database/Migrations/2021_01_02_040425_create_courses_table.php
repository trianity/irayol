<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instructor_id')->unsigned();
            $table->string('title');
            $table->string('level')->comment('basic, intermediate, advance');
            $table->string('slug')->unique();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('required')->nullable()->comment('Requisitos del curso');
            $table->text('includes')->nullable()->comment('Datos del curso');
            $table->string('image')->nullable();
            $table->string('visibility')->nullable()->comment('published, draft, pending_review');
            $table->string('access')->nullable()->default('pay')->comment('free, pay');
            $table->timestamps();

            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
