<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'name', 'phone', 'type', 'image']; // ✅ must include image
    // One car has many notes
    public function notes()
    {
        return $this->hasMany(RepairNote::class);
    }
}
