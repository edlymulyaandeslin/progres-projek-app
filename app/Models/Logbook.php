<?php

namespace App\Models;

use App\Models\User;
use App\Models\Judulprojek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Testing\Fluent\Concerns\Has;

class Logbook extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('description', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhere('created_at', 'like', '%' . $search . '%');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function judul()
    {
        return $this->belongsTo(Judulprojek::class, 'judul_id', 'id');
    }
}
