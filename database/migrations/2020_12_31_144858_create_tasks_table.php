<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content');
            $table->string('status');
            $table->unsignedBigInteger('genba_id');
            $table->date('start_day');
            $table->date('end_day');
            $table->boolean('alart');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('genba_id')->references('id')->on('upload_images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
