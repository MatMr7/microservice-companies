<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->uuid('uuid');
            $table->string('name');
            $table->string('url');
            $table->string('phone')->nullable();
            $table->string('whatsapp');
            $table->string('email')->unique();
            $table->string('facebook')->unique()->nullable();
            $table->string('instagram')->unique()->nullable();
            $table->string('youtube')->unique()->nullable();
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
        Schema::dropIfExists('companies');
    }
}