<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('title');
            $table->mediumText('title_ne');
            $table->mediumText('subtitle')->nullable();
            $table->mediumText('subtitle_ne')->nullable(); 
            $table->string('image_url');
            $table->string('status');
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
        Schema::dropIfExists('carousels');
    }
}
