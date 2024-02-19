<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('category_name');
        //    $table->primary('category_name');

            $table->string('category_description')->nullable();
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
        Schema::drop(' categories');
    }
}
