<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpyLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spy_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lid');
            $table->string('url');
            $table->integer('visits')->default(0);
            $table->string('page_title');
            $table->integer('user_id')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('public')->default(true);
            $table->string('created_ip');
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
        Schema::dropIfExists('spy_links');
    }
}
