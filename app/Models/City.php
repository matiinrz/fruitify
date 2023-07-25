<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property-read integer id
 * @property-read integer province_id
 * @property string name
 * @property string text
 * @property string country
 * @property string picture
 * @property string status
 * @property-read string created_at
 * @property-read string updated_at
 */
class City extends Model
{
    protected $table = "cities";
    public $timestamps = true;
    protected $fillable = ["province_id", "name", "text", "country", "picture"];
    protected $hidden = [
        "text", "country", "picture", "created_at", "updated_at"
    ];
}
