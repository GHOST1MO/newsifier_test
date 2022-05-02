<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('username')->unique();
			$table->unsignedInteger('karma_score')->default(0);
			$table->bigInteger('image_id')->unsigned();
			$table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
};
