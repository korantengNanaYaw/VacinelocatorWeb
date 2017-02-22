<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 22 Feb 2017 11:47:51 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Facility
 * 
 * @property int $id
 * @property string $region
 * @property string $district
 * @property string $sub_district
 * @property string $facility
 * @property string $coordinates
 * @property string $bcg
 * @property string $opv
 * @property string $penta
 * @property string $pneumo
 * @property string $rota
 * @property string $measles_rubella
 * @property string $yellow_fever
 * @property string $meningitis_a
 * @property string $vitamin_a_dose
 * @property string $nutrition_services
 * @property string $phone
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Facility extends Eloquent
{
	protected $table = 'facility';

	protected $fillable = [
		'region',
		'district',
		'sub_district',
		'facility',
		'coordinates',
		'bcg',
		'opv',
		'penta',
		'pneumo',
		'rota',
		'measles_rubella',
		'yellow_fever',
		'meningitis_a',
		'vitamin_a_dose',
		'nutrition_services',
		'phone',
		'email'
	];
}
