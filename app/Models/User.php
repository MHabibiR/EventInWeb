<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Jika user bertindak sebagai Organizer, dia bisa memiliki banyak Event
    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    // Seorang user (peserta) bisa mendaftar di banyak event (banyak data partisipasi)
    public function participations()
    {
        return $this->hasMany(Participant::class, 'user_id');
    }

    // Seorang user bisa memiliki banyak riwayat transaksi pembelian tiket
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}
