<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'address',
        'complement_address',
        'postal_code',
        'location',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
