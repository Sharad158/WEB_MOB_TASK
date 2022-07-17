<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $primaryKey = 'blog_id';

    public function getImageAttribute($value){
        if($value != '' && $value != null){
            if(isset($value)) {
                return (url('/resources/uploads/blog_image/').'/').$value;
            }else{
                return '';
            }
        }else {
            return '';
        }
    }
}
