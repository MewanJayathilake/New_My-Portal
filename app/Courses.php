<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
     protected $fillable=['c_id','c_name','c_streamname','c_code','c_delivery',
    'c_isactive','c_type','c_shortdescription','c_primaryimage','c_secondaryimage','c_status'];
}
