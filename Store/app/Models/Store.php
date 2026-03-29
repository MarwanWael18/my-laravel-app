<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;
    protected $fillable = ['name' , 'user_id' , 'price' , 'description' , 'longdescription' , 'image'];

    public function user(){
        return $this->belongsTo(User::class , 'id');
    }
}
