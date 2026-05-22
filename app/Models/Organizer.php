<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    // Hubungan balik ke akun User utama (One-to-One atau One-to-Many tergantung desain DB)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
