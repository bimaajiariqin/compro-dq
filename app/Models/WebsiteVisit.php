<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteVisit extends Model
{
    protected $table = 'website_visits';

    protected $fillable = [
        'visit_date',
        'count',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];
}