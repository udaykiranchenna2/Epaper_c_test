<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epapers', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->text('pdf_file');
            $table->text('pdf_url')->nullable();
            $table->text('news_url')->nullable();
            $table->string('edition')->nullable();
            $table->integer('addedby')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('newsid')->unique();
            $table->string('newsno')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('epapers');
    }
};
