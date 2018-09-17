<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWebPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wp_slug')->unique();
            $table->string('wp_title')->nullable();
            $table->string('wp_sub_title')->nullable();
            $table->string('wp_tags')->nullable();
            $table->text('wp_content')->nullable();
            $table->enum('wp_status', ['published', 'draft', 'inactive']);
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
        Schema::drop('web_pages');
    }
}
