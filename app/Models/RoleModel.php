<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','CanViewQuotation','CanAddQuotation','CanEditQuotation','CanDeleteQuotation','CanViewClient',
    'CanAddClient','CanEditClient','CanDeleteClient','CanViewClientType','CanAddClientType','CanEditClientType','CanDeleteClientType',
    'CanViewProjectScope','CanAddProjectScope','CanEditProjectScope','CanDeleteProjectScope','CanViewUser','CanAddUser','CanEditUser','CanDeleteUser',
    'CanViewRole','CanAddRole','CanEditRole','CanDeleteRole','CanViewClientProject','CanAddClientProject','CanEditClientProject','CanDeleteClientProject','CanAssignProject','CanViewInvoice','CanAddInvoice','CanEditInvoice','CanDeleteInvoice'
    ,'CanViewEmployeeType','CanAddEmployeeType','CanEditEmployeeType','CanDeleteEmployeeType'];
    protected $validationRules    = [
        'name' => 'required|is_unique[roles.Name,id,{id}]',
    ];
    protected $validationMessages = [
        'name' => [
            'required' =>  'Name is a required field.',
            'is_unique' => 'Role with this name already exists. Please choose a unique role name.',
        ],
    ];
    protected $returnType    = \App\Entities\Role::class;
    
}
