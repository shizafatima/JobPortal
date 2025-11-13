<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    use HasFactory;
    // The table associated with the model, which we created manually
    protected $table = 'job_listings';

    //Add below property to avoid mass assignment error(laravel's security)
    // protected $fillable = ['employer_id', 'title', 'salary'];

    protected $guarded = [];
}
