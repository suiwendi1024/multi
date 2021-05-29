<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index()->comment('categories表外键');
            $table->string('cover_url')->comment('封面');
            $table->string('name')->comment('名称');
            $table->decimal('price')->comment('单价');
            $table->text('description')->comment('描述');
            $table->unsignedSmallInteger('stock')->default(0)->comment('库存');
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
        Schema::dropIfExists('products');
    }
}
