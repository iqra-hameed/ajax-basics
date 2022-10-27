<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Prod extends Model
{
    use HasFactory;

        protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'image',
        'category_id',
    ];
    public function category() {
        return $this->hasOne(Category::class, 'id','category_id');
    }
}
