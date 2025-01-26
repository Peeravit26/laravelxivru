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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('user_id')->nullable();
            $table->string('leave_type_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('total_leave')->nullable();
            $table->string('status');
            $table->text('comments')->nullable();
            $table->integer('approver_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
