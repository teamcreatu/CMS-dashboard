<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_id')->nullable();
            $table->mediumText('name')->nullable();
            $table->mediumText('name_ne')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('summary_ne')->nullable();
            $table->mediumText('contact_no')->nullable();
            $table->mediumText('image_url')->nullable();
            $table->string('section');
            $table->string('section_ne');
            $table->string('email');
            $table->string('post');
            $table->string('post_ne');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('members');
    }
}