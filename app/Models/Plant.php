<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'notes',
        'temp',
        'soil',
        'air',
        'status',
        'trigger_shower',
        'callback_shower',
        'created_by',
        'updated_at',
    ];

    public $incrementing = false;

    // Metode untuk mencari nilai kunci primer yang tersedia
    public static function getAvailablePrimaryKey()
    {
        $lastId = static::max('id');
        $availableId = null;

        for ($i = 1; $i <= $lastId; $i++) {
            $exists = static::where('id', $i)->exists();
            if (!$exists) {
                $availableId = $i;
                break;
            }
        }

        if (is_null($availableId)) {
            $availableId = $lastId + 1;
        }
        return $availableId;
    }

    // Override metode untuk menyimpan data baru
    public function save(array $options = [])
    {
        if(!$this->id){
            $this->id = static::getAvailablePrimaryKey();
        }
        return parent::save($options);
    }

    public function createdBy() {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}