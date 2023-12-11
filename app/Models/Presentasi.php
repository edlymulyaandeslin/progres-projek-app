<?php

namespace App\Models;

use App\Models\User;
use App\Models\Judulprojek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presentasi extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    protected $dates = [
        'tanggal'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function judul()
    {
        return $this->belongsTo(Judulprojek::class);
    }
}
