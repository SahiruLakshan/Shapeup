<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In migration file
public function up()
{
    Schema::create('asset_allocations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained();
        $table->foreignId('sub_category_id')->constrained('sub_categories');
        $table->string('serial_number');
        $table->string('company');
        $table->string('location');
        $table->string('branch');
        $table->foreignId('employee_id')->constrained();
        $table->decimal('value', 10, 2);
        $table->date('date');
        $table->text('description')->nullable();
        $table->boolean('status')->default(1);
        $table->timestamps();
        $table->foreign('serial_number')->references('serial_number')->on('assets');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_allocations');
    }
};
