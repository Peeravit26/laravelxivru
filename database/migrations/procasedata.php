
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
        Schema::create('procasedata', function (Blueprint $table) {
            $table->string('name'); // ชื่อสินค้า
            $table->text('description'); // ที่อยู่
            $table->decimal('price', 8, 2); // อายุ (สูงสุด 999,999.99)
            $table->string('image')->nullable(); // ที่อยู่รูปภาพ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procase');
    }
};
