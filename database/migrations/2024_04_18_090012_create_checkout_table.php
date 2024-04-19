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
        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->string('email', 50);
            $table->enum('payment', ['bank', 'ewallet']);
            $table->string('fname', 30);
            $table->string('lname', 30);
            $table->string('address', 40);
            $table->integer('postal', false, true)->length(4);
            $table->string('city', 20);
            $table->string('product', 20);
            $table->string('phone', 11); // Using string to accommodate phone formats
            $table->decimal('total', 10, 2); // Decimal field with precision of 10 and scale of 2
            $table->timestamps();
            $table->softDeletes();  // Adding softDeletes
        });

        Schema::create('checkout_product', function (Blueprint $table) {
            $table->unsignedBigInteger('checkout_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity');

            $table->foreign('checkout_id')->references('id')->on('checkout')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_product');
        Schema::dropIfExists('checkout');
    }
};
