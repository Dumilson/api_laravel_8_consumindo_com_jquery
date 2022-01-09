<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    
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
