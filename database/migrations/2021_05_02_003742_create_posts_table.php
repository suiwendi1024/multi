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
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->comment('users表外键');
            $table->unsignedBigInteger('category_id')->index()->comment('categories表外键');
            $table->string('title')->comment('标题');
            $table->text('body')->comment('正文');
            $table->string('cover_url')->comment('封面');
            $table->text('summary')->comment('摘要');
            $table->unsignedMediumInteger('views')->default(0)->comment('浏览量');
            $table->timestamps();
            $table->softDeletes()->comment('软删除');
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
