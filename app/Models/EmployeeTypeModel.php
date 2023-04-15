<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class EmployeeTypeModel extends Model
{
    protected $table = 'employeetype';
    protected $allowedFields = ['type'];    
}
