<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'city',
        'zip_code',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        return "{$this->address_line1}, {$this->address_line2}, {$this->city}, {$this->zip_code}";
    }

    // Scopes
    public function scopeCity($query, $city)
    {
        return $query->where('city', $city);
    }

    // Custom Methods




}
