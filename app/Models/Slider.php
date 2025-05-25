<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Slider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title_part_1',
        'title_part_2',
        'description',
        'image_url',
        'button_label_1',
        'button_link_1',
        'button_label_2',
        'button_link_2',
        'order',
        'status',
    ];
}
