<?php

namespace App\Models;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Judulprojek extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('pembimbing', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logbook()
    {
        return $this->hasMany(Logbook::class);
    }

    public function presentasi()
    {
        return $this->belongsTo(Presentasi::class);
    }
}
