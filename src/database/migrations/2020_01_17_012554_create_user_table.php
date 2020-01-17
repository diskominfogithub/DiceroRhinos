<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string("username")->unique();
            $table->string("password")->nullable(false);
            $table->string("email")->nullable(false);

            // relasi many to one
            // user - role
            $table->unsignedBigInteger("id_role");
            $table
                ->foreign("id_role")
                ->references("id_role")
                ->on("role");

            // relasi many to one
            // user - opd
            $table->unsignedBigInteger("id_opd");
            $table
                ->foreign("id_opd")
                ->references("id_opd")
                ->on("opd");
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}
