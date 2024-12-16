<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('title_domain');
            $table->string('description');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('is_featured')->default(1);
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
        Schema::dropIfExists('posts');
    }
}
