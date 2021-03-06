<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wares', function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->unsignedBigInteger('product_id')->index()->comment('products表外键');
            $table->unsignedTinyInteger('quantity')->default(1)->comment('数量');
            $table->decimal('amount')->default(0)->comment('金额');
            $table->boolean('is_selected')->default(false)->comment('是否选中');
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
        Schema::dropIfExists('wares');
    }
}
