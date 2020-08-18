<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_category_id')->unsigned();
            $table->integer('page_template_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('title_ne');
            $table->string('slug');
            $table->string('slug_ne');
            $table->string('image_url')->nullable();
            $table->LONGTEXT('description');
            $table->LONGTEXT('description_np');
            $table->foreign('page_category_id')->references('id')->on('page_categories')->onDelete('cascade');
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
        Schema::dropIfExists('pages');
    }
}
