<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\String\b;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'entity_type',
        'action',
        'result'
    ];

    public function entity($type)
    {
        switch ($type){
            case 'Deal':
                $class = Deal::class;
                break;
            case 'Contact':
            default:
                $class = Contact::class;
        }

        return $this->belongsTo($class);
    }

    public function entityName($type): string
    {
        return $this->entity($type)->first()->name;
    }
}
