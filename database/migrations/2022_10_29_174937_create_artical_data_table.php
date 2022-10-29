<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artical_data', function (Blueprint $table) {
            $table->id();
            $table->string('ArticalTitle');
            $table->string('Desc');
            $table->string('Dom');
            $table->string('ArticalLink');
            $table->dateTime('publishedAt');
            $table->bigInteger('WebsiteId')->unsigned();
            $table->foreign('WebsiteId')->references('id')->on('website_data');
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
        Schema::dropIfExists('artical_data');
    }
}
