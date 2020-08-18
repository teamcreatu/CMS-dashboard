<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('category_id')->nullable();
            $table->mediumText('title')->nullable();
            $table->mediumText('title_ne')->nullable();
            $table->mediumText('summary')->nullable();
            $table->mediumText('summary_ne')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_ne')->nullable();
            $table->mediumText('image_url')->nullable();
            $table->string('status')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('created_by')->nullable();
            $table->mediumText('updated_by')->nullable();
            $table->mediumText('deleted_at')->nullable();
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
