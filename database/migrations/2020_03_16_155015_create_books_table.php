<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->string('original_title',255)->nullable();
            $table->smallInteger('publication_year')->nullable();
            $table->string('isbn',255)->nullable();
            $table->string('language_code');
            $table->text('image')->nullable();
            $table->text('thumbnail')->nullable();
            $table->smallInteger('average_rating')->nullable();
            $table->bigInteger('total_ratings')->nullable();
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
        Schema::dropIfExists('books');
    }
}
