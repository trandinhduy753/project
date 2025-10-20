<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('code', 15)->unique();
            $table->string('name', 70);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Table categories {
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
