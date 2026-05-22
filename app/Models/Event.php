<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // Event ini dimiliki oleh seorang Organizer (User)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // Satu event memiliki banyak kategori tiket (misal: VIP, Regular)
    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class, 'event_id');
    }

    // Satu event memiliki banyak peserta yang terdaftar
    public function participants()
    {
        return $this->hasMany(Participant::class, 'event_id');
    }
}
