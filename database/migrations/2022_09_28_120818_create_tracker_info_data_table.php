<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackerInfoDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracker_info_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tracker_id')->unsigned();
            $table->string('tracking_date');
            $table->longText('tracking_data');
            $table->string("hours");
            $table->foreign("tracker_id")->on("tracker_infos")->references("id");
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
        Schema::dropIfExists('tracker_info_data');
    }
}
