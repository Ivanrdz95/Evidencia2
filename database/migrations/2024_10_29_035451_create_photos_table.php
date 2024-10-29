<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
// database/migrations/xxxx_xx_xx_xxxxxx_create_photos_table.php

public function up()
{
    Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->string('path');
        $table->timestamps();
    });
}

}
