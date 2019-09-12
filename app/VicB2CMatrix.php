<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VicB2CMatrix extends Model {

	/**
     * The connection name for the model.
     *
     * @var string
     */

    protected $connection = 'ewhere';
    
    protected $table = 'Matrice_VIC_B2C';
}
