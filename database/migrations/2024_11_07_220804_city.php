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
        // Schema::create('cities', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('region_id');
        //     $table->string('city');
        //     $table->timestamps();

        //     $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        // });
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('region_id');
            $table->string('city'); // 'city' column is required here
            $table->timestamps();
        
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
