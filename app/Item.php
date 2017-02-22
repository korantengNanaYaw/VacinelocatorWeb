<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    /*
     *     $table->string('region');
            $table->text('district');
            $table->text('sub-district');
            $table->text('facility');
            $table->text('coordinates');
     *
     * */

public $fillable = ['region','district','sub_district','facility','coordinates'];

}