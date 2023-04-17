<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->string('post_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('home')->default(0);
            $table->integer('cod')->default(0);
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
};
