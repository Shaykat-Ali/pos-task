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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('category_id');
            $table->integer('product_id');
            $table->string('purchase_no');
            $table->date('purchase_date');
            $table->longText('description')->nullable();
            $table->double('buying_qty');
            $table->double('unit_price');
            $table->double('buying_price');
            $table->tinyInteger('status')->default('0')->comment('0=pending,1=approved');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
