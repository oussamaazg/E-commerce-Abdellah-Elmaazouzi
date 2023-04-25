<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    
    protected $table = 'lignesCommande';

    protected $fillable = [
        'product_id',
        'commande_id',
        'quantity',
    ];
    
}
