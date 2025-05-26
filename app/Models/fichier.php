<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fichier extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fichiers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'filename',
        'filename2',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
