<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('website_id')->constrained();
      $table->string('title')->unique();
      $table->string('description');
      $table->text('content');
      $table->timestamp('mail_sent_at')->nullable();

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('posts');
  }
}
