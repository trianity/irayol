<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();  
            $table->bigInteger('user_id')->unsigned();          
            $table->string('title')->unique();
            $table->longText('content')->nullable();
            $table->string('slug')->unique();
            $table->string('titleseo')->nullable();
            $table->string('descseo')->nullable();
            $table->string('keywordseo')->nullable();

            $table->string('visibility')->nullable();
            $table->string('main_image')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
