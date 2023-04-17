<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('header_logo');
            $table->string('footer_logo');
            $table->text('footer_desc');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('about_title');
            $table->text('about_desc');
            $table->string('home')->default(0);
            $table->integer('cod')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
