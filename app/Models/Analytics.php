<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_views',
        'unique_visitors',
        'sales',
        'conversion_rate',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessors
    public function getFormattedConversionRateAttribute()
    {
        return number_format($this->conversion_rate, 2);
    }

    // Scopes
    public function scopeHighPageViews($query, $threshold = 1000)
    {
        return $query->where('page_views', '>', $threshold);
    }

    // Custom Methods

    /**
     * Calculate the revenue based on sales and conversion rate.
     *
     * @return float
     */
    public function calculateRevenue()
    {
        return $this->sales * $this->conversion_rate;
    }

    /**
     * Check if the analytics data indicates a successful campaign.
     *
     * @return bool
     */
    public function isSuccessfulCampaign()
    {
        return $this->conversion_rate > 0.05; // Example threshold, adjust as needed
    }
}
