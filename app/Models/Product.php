<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public $table = "products";
    protected $fillable = [
        'id',
        'nome_do_produto',
        'info',
        'preco',
        'created_at',
        'updated_at'
    ];
}
