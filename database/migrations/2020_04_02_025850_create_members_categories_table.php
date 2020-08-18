<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_ne');
            $table->string('status');
            $table->mediumText('created_by')->nullable();
            $table->mediumText('updated_by')->nullable();
            $table->string('deleted_at')->nullable(); 
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
        Schema::dropIfExists('members_categories');
    }
}
