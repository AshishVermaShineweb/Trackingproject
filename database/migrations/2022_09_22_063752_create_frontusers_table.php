<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontusers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger("company_id")->unsigned();
            $table->string("username");
            $table->text("token");
            $table->string("department");
            $table->date("dob");
            $table->string("phone");
            $table->integer("screen_capture")->default(0);
            $table->string("desktop_mode");
            $table->integer("notify_user")->default(0);
            $table->string("timezone");
            $table->string("loginip");
            $table->boolean("active")->default(true);
            $table->boolean("delete")->default(false);
            $table->date("last_logindate");
            $table->foreign('company_id')->references('id')->on('companies');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('frontusers');
    }
}
