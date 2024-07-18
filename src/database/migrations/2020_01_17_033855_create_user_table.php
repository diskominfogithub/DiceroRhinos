<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
             $table->string('nik', 100)->nullable()->unique();
            $table->string('nama', 100)->nullable();
            $table->string('nip', 100)->nullable()->unique();
            $table->string("username")->unique();
            $table->string('jenis_kelamin', 100)->nullable();
            $table->string("password")->nullable(false);
            $table->string("email")->nullable(true);

            // relasi many to one
            // user - role
            $table->unsignedBigInteger("id_role")->nullable(true);
            $table
                ->foreign("id_role")
                ->references("id_role")
                ->on("role");

            // relasi many to one
            // user - opd
            $table->unsignedBigInteger("id_opd")->nullable(true);
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
