<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // id	size no	size shortcut	waist cm	hip cm	chest cm	length cm	prefix(uk)

        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->double('size_no')->comment('ex - 6,8,10,12');
            $table->string('size_shortcut')->comment('ex- l,xl,m,s');
            $table->string('prifix')->default('UK')->commnet('ex- UK, US');
            $table->double('waist_size')->comment('in cm');
            $table->double('hip_size')->comment('in cm');
            $table->double('chest_size')->comment('in cm');
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
        Schema::dropIfExists('sizes');
    }
}
