<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traitment;

class Invoice extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paid_at',
        'invoice_number',
        'address',
        'complement_address',
        'postal_code',
        'location',
        'tel',
        'tva',
        'total_price',
    ];

    protected $cast = [
        'realized_at' => 'datetime',
    ];

    public function traitments(): HasMany
    {
        return $this->hasMany(Traitment::class);
    }
}
