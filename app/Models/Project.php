<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['name','code_name','code_slug','company_id','status_type','start_date','end_date'];
}
