<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_name');
            $table->string('menu_name_ne');
            $table->integer('priority_no');
            $table->string('menu_type');
            $table->string('active_status');
            $table->string('icon')->nullable();
            $table->string('page_url')->nullable();
            $table->string('page_url_ne')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('is_parent')->nullable();
            $table->string('slug');
            $table->string('created_by');
            $table->string('updated_by');
            $table->softDeletes();
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
        Schema::dropIfExists('menus');
    }
}
