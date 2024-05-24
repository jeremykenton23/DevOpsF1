<?php

// app/Models/Race.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' should match the foreign key name in the 'races' table
    }
}


