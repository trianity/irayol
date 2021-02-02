<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('section_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('notes');
            $table->string('media_type')->nullable()->default('video')->comment('video, audio, document, text');
            $table->string('url')->nullable();
            $table->integer('order')->default(0);
            $table->string('duration')->nullable();
            $table->string('access')->nullable()->default('pay')->comment('free, pay');
            $table->boolean('is_active');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
