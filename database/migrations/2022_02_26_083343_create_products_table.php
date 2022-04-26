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
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->double('actual_price')->nullable();
            $table->double('discount')->default(0);
            $table->tinyInteger('discount_in')->default(0)->comment('0-percentage 1- bulk');
            $table->tinyInteger('is_discount')->default(0)->comment('0-not apply 1- apply');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');            
            $table->text('color_id')->nullable();
            $table->text('size_id')->nullable();
            $table->text('categories')->nullable()->comment("josn data store");
            $table->string('sub_categories')->nullable()->comment("josn data store");
            $table->string('length')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0- inactive 1- active'); 
            $table->text('model_detail')->nullable();  
            $table->tinyInteger('is_newarrival')->default(0)->comment('0- not 1- yes');
            $table->tinyInteger('in_stock')->default(1)->comment('0- no 1- yes');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();  
            $table->text('view_count')->default(0)->comment('use in most view parament');            
            $table->string('default_image')->nullable();
            $table->softDeletes();            
            $table->rememberToken();
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
