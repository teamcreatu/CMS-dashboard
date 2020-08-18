<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description')->nullable();
            $table->longText('description_ne')->nullable();
            $table->mediumText('fb_link')->nullable();
            $table->mediumText('tw_link')->nullable();
            $table->mediumText('email_id')->nullable();
            $table->string('emergency_contact')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
