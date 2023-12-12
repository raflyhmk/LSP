<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'medic_id', 'borrow_date', 'return_date', 'is_return_requested', 'is_return_approved'];

    // Relasi ke model User dan Medic
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medic()
    {
        return $this->belongsTo(Medic::class);
    }
}