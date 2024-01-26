<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesiModel extends Model
{
    use HasFactory;
    protected $table = 'profesi';
    protected $fillable = [
        'id',
        'jenisprofesi',
        'status'
    ];
}
