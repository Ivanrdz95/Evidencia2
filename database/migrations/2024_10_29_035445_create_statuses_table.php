<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
// database/migrations/xxxx_xx_xx_xxxxxx_create_statuses_table.php

public function up()
{
    Schema::create('statuses', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}

}
