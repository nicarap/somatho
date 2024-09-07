<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "tel",
        "message",
        "read_at"
    ];

    protected $casts = ["read_at" => "datetime"];

    public function isReaded(): bool
    {
        return $this->read_at !== null;
    }
}
