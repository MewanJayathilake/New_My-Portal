<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onsite extends Model
{
    //Onsite connect with tabale and columns

    protected $fillable=['organisation_name', 'contact_name','contact_number','contact_email','course','course_venue','trainig_session','additional_comment'];
    
   
   protected $table = 'onpage';

}