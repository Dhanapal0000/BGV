<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TBgVendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_bgvendor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('companyid')->unsigned();
            $table->string('vendorname', 50);
            $table->binary('logo'); // BLOB type for logo
            $table->string('login', 50);
            $table->string('password', 50);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('role')->default(0);
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_bgvendor');
    }
}
