<?php

namespace App\Models;

use CodeIgniter\Model;

class GenderModel extends Model{
    protected $table = 'genders';
    protected $primaryKey = 'gender_id';
    protected $allowFields = [
        'gender'
    ];
    protected $returnType = 'object';
}