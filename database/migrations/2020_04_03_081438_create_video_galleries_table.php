<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('title')->nullable();
            $table->mediumText('title_ne')->nullable();
            $table->longText('video_url')->nullable();
            $table->longText('status')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('video_galleries');
    }
}
