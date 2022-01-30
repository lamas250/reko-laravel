<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventHasBenefiteds extends Model
{
    protected $table = 'event_has_benefiteds';
    protected $fillable = ['event_id', 'benefited_id','photo_path','photo_time'];
}
