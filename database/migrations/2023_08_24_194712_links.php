<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Links extends Migration
{
    
    public function up()
    {
        Schema::create('links', function (Blueprint $table){
			$table->string('url');
			$table->string('path');
			$table->timestamps();
		});
    }

    public function down()
    {
        Schema::dropIfExists('links');
    }
}
