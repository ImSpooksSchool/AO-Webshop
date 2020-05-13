<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name");
            $table->string("label")->nullable();
            $table->timestamps();
        });

        DB::table("roles")->insert(
            [
                "name" => "user",
                "label" => "User"
            ]
        );

        DB::table("roles")->insert(
            [
                "name" => "admin",
                "label" => "Administrator"
            ]
        );

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger("role_id")->default(1);
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
