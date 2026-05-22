<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // Tiket fisik/QR ini dipegang oleh satu data partisipasi peserta
    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}
