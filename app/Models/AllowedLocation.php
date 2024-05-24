<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedLocation extends Model
{
    use HasFactory;

    protected $fillable = ['location'];

    // Optioneel: geef de tabelnaam expliciet op als deze niet overeenkomt met de conventie
    // protected $table = 'allowed_locations';

    // Optioneel: geef de primaire sleutel expliciet op als deze niet overeenkomt met de conventie
    // protected $primaryKey = 'id';
}
