<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryLotteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_lotteries', function (Blueprint $table) {
            $table->id();

            $table->string('area');
            $table->string('giaiDB');
            $table->string('giaiNhat');
            $table->string('giaiNhi');
            $table->string('giaiBa');
            $table->string('giaiTu');
            $table->string('giaiNam');
            $table->string('giaiSau');
            $table->string('giaiBay');
            $table->string('giaiTam');
            $table->date('date');
            $table->string('province');
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
        Schema::dropIfExists('history_lotteries');
    }
}
