<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('path')->nullable();
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('status')->default(true);
            $table->string('home')->default(0);
            $table->integer('cod')->default(0);
            $table->integer('parent_id')->default(0);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
