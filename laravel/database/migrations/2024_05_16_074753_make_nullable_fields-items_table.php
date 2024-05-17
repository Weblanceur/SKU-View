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
        Schema::table('items', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('barcode')->nullable()->change();
            $table->text('vendor_code')->nullable()->change();
            $table->text('image')->nullable()->change();
            $table->text('pdf')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('title')->change();
            $table->string('barcode')->change();
            $table->text('vendor_code')->change();
            $table->text('image')->change();
            $table->text('pdf')->change();
        });
    }
};
