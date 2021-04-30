<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
					$table->id()->unique();
					$table->bigInteger('post_author')->unsigned();
					$table->foreign('post_author')->on('users')->references('id')->onDelete('cascade');
					$table->longText('post_content');
					$table->text('post_title');
					$table->text('post_excerpt');
					$table->string('post_status', 20);
			    $table->timestamp('date_scheduled', 0)->nullable();
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
        Schema::dropIfExists('posts');
    }
}
