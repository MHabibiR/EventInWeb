<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    // Kategori tiket ini berkiblat pada satu Event tertentu
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Kategori tiket ini digunakan oleh banyak peserta
    public function participants()
    {
        return $this->hasMany(Participant::class, 'ticket_category_id');
    }
}
