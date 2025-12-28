<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->index();
            $table->string('category')->index();
            $table->string('sub_category')->nullable();
            $table->decimal('ratings', 3, 2)->nullable();
            $table->text('address');
            $table->string('area')->index();
            $table->string('city')->index();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->boolean('is_duplicate')->default(false);
            $table->boolean('is_incomplete')->default(false);
            $table->unsignedBigInteger('master_record_id')->nullable()->index(); // Link for duplicates
            $table->softDeletes();
            $table->timestamps();

            // Compound index for duplicate checking performance
            $table->index(['business_name', 'city', 'area'], 'idx_duplicate_check');
        });
    }

    public function down(): void {
        Schema::dropIfExists('businesses');
    }
};
