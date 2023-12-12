<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowsTable extends Migration
{
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('medic_id');
            $table->date('borrow_date');
            $table->date('return_date');
            $table->timestamps();
            $table->boolean('is_return_requested')->default(false);
            $table->boolean('is_return_approved')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medic_id')->references('id')->on('medics');
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrows');
    }
}
