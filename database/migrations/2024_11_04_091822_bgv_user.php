<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BgvUser  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgv_user', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('username');
            $table->string('password');
            $table->string('customername');
            $table->string('customerid');
            $table->string('companyid');
            $table->string('role');
            $table->string('modules');
            $table->string('domain');
            $table->string('userid');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgv_user');
    }
}
