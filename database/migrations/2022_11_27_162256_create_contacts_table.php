<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'contacts', function ( Blueprint $table ) {
    $table->id();

//    $table->foreignId( 'user_id' )->constrained( 'users' )->onUpdate('cascade')->onDelete('cascade');
//    $table->integer('user_id')->unsigned()->nullable();
   $table->foreignId('user_id')->references('id')->on('users');
    // $table->foreignId('user_id')->references('id')->on('users')->nullable();
    //  ->references('id)->on('user);
    $table->string( 'name' );
    $table->string( 'email' );
    $table->string( 'address' );
    $table->timestamps();
} );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
