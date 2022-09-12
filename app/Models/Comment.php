<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'ca_id',
        'pro_id',
        'comment'
    ];
    protected function product(){
        return $this->belongsTo(Product::class , 'pro_id','id');
    }
    protected function user(){
        return $this->belongsTo(Product::class , 'ca_id','id');
    }
}
