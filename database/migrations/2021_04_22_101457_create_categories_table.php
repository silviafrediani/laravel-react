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
				$table->text('name');
				$table->timestamps();
			});
			// tabella pivot
			Schema::create('post_category', function (Blueprint $table) {
				$table->id();
				$table->integer('post_id')->unsigned();
				$table->integer('category_id')->unsigned();
				$table->unique(['post_id', 'category_id']);
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
        Schema::dropIfExists('categories');
    }
}
