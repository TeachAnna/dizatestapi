<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('intro')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(true);
            $table->integer('views')->default(0);
            $table->integer('like')->default(0);
            $table->integer('cod')->default(0);
            $table->string('home')->nullable();

            $table->integer('parent_id')->default(0);

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('meta_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_key')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
