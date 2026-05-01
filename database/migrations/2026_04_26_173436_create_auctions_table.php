<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //tabel mobil yang akan dilelang
        Schema::create('cars', function (Blueprint $table){ 
            $table->id();
            $table->string('merk');
            $table->string('model');
            $table->integer('tahun');
            $table->integer('odometer')->nullable();
            $table->string('mesin')->nullable();
            $table->string('warna')->nullable();
            $table->char('grade',1)->nullable();
            $table->string('gambar1')->nullable();
            $table->text('deskripsi')->nullable();
            $table->bigInteger('harga_awal');
            $table->timestamps();
        });
        //tabel sesi lelang
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('status', ['pending', 'active', 'closed'])->default('pending');
            $table->timestamps();
            });
        //tabel penawaran    
        Schema::create('bids', function (Blueprint $table){
            $table->id();
            $table->bigInteger('bid_amount');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('auction_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
        Schema::dropIfExists('auctions');
        Schema::dropIfExists('cars');
    }
};
