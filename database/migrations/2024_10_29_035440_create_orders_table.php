<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
// database/migrations/xxxx_xx_xx_xxxxxx_create_orders_table.php

public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_number')->unique();
        $table->string('customer_name');
        $table->string('customer_number')->unique();
        $table->text('fiscal_data');
        $table->text('delivery_address');
        $table->text('notes')->nullable();
        $table->foreignId('status_id')->constrained()->onDelete('cascade');
        $table->boolean('is_deleted')->default(false);
        $table->timestamps();
    });
}

}
