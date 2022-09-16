<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracker_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("project_id")->unsigned();

            $table->string("trackingHours");
            $table->date("trackingDate");
            $table->text("tracking");
            $table->string("timezone");

            $table->integer("hourLimit")->default(40);
            $table->boolean("active")->default(true)->comment("[true=>active,false=>inactive]");
            $table->boolean("delete")->default(false);
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tracker_infos');
    }
}
