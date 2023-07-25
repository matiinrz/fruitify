<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read integer id
 * @property string name
 * @property string text
 * @property string country
 * @property string picture
 * @property string status
 * @property-read string created_at
 * @property-read string updated_at
 */
class Province extends Model
{
    protected $table = "provinces";
    public $timestamps = true;
    protected $fillable = ["name", "text", "country", "picture"];
    protected $hidden = [
        "text", "country", "picture", "created_at", "updated_at"
    ];
}
