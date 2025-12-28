<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model {
    use SoftDeletes;

    protected $fillable = [
        'business_name', 'category', 'sub_category', 'ratings', 
        'address', 'area', 'city', 'phone1', 'phone2', 
        'is_duplicate', 'is_incomplete', 'master_record_id'
    ];

    public function duplicates() {
        return $this->hasMany(Business::class, 'master_record_id');
    }

    public function master() {
        return $this->belongsTo(Business::class, 'master_record_id');
    }
}
