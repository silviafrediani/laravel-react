<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
		public function up()
		{
			Schema::create('roles', function (Blueprint $table) {
				$table->id();
				$table->string('name', 64)->unique();
				$table->timestamps();
			});
			// tabella pivot
			Schema::create('role_user', function (Blueprint $table) {
				$table->id();
				$table->integer('role_id')->unsigned();
				$table->integer('user_id')->unsigned();
				$table->unique(['role_id', 'user_id']);
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
        Schema::dropIfExists('roles');
    }
}
