<?php

// app/Models/Photo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['order_id', 'path', 'is_delivered'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
