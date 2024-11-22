<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'description',
        'amount'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
