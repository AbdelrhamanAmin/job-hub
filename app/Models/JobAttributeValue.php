<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['job_board_id', 'attribute_id', 'value'];

    public function job()
    {
        return $this->belongsTo(JobBoard::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
