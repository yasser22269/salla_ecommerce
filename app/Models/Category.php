<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Custom Methods

    /**
     * Get the total number of products in the category.
     *
     * @return int
     */
    public function getProductCount()
    {
        return $this->products->count();
    }

    /**
     * Get the average price of products in the category.
     *
     * @return float|null
     */
    public function getAverageProductPrice()
    {
        $totalPrice = $this->products->sum('price');
        $productCount = $this->getProductCount();

        return $productCount > 0 ? $totalPrice / $productCount : null;
    }

    /**
     * Get a list of product names in the category.
     *
     * @return array
     */
    public function getProductNames()
    {
        return $this->products->pluck('name')->toArray();
    }

    /**
     * Check if the category has any products.
     *
     * @return bool
     */
    public function hasProducts()
    {
        return $this->getProductCount() > 0;
    }


    public function getactive(){
        return $this->status ==0 ? 'غير مفعل' : "مفعل";
    }

    public function Parent(){
        return $this->belongsTo(self::class,'parent_id');
    }



    public  function scopeParent($query){
        return $query->whereNull('parent_id');
    }

    //get all childrens=

    public function children(){
        return $this->hasMany(Self::class,'parent_id','id');
    }
}

