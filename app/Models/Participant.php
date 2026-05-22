<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    // Data partisipasi ini merujuk ke satu Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // Data partisipasi ini dimiliki oleh satu User (Peserta)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Peserta ini memilih satu kategori tiket tertentu
    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }

    // Hubungan ke data detail fisik tiket/QR code jika dipisah
    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'participant_id');
    }
}
