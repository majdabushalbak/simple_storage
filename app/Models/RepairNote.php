<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairNote extends Model
{
    use HasFactory;

    protected $fillable = ['repair_id', 'note', 'status', 'cost'];

    // Relationship: belongs to a repair (car)
    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}
