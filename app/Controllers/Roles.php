<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;

class Roles extends BaseController
{
    private $roleModel = null;
    private $auth = null;
    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->auth = service("auth");
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewRole) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $roles = $this->roleModel->findAll();
        // dd($users);
        return view(
            'Roles/index',
            [
                "role" => $roles
            ]
        );
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddRole) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        if ($this->request->getMethod() == 'post') {
            $data = [
                "name" => $this->request->getPost('rolename'),
            ];
            if ($this->roleModel->insert($data)) {
                return redirect()->to("Roles/index");
            } else {
                return redirect()->back()->with('errors', $this->roleModel->errors())->with('warning', "Please fix the errors");
            }
        }
        return view('Roles/new');
    }
    public function edit($id)
    {
        if (!$this->auth->getUserRole()->CanEditRole) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $role = $this->roleModel->find($id);
        if ($this->request->getMethod() == 'post') {
            $updateRolePermissions = new \App\Entities\Role($this->request->getPost());
            $this->mapRequestObjectWithDbObject($role, $updateRolePermissions);
            if ($role->hasChanged()) {
                if ($this->roleModel->update($role->id, $role)) {
                    return redirect()->to("Roles/index")->with('success', 'Roles and their permissions are updated successfully.');
                } else {
                    return redirect()->back()->with('errors', $this->roleModel->errors())
                        ->with('warning', 'Please fix the errors')
                        ->withInput();
                }
            } else {
                return redirect()->to("Roles")->with("success", "There's nothing to update.");
            }
        }
        return view("Roles/edit", ["role" => $role]);
    }

    public function delete()
    {
        if (!$this->auth->getUserRole()->CanDeleteRole) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $id = $this->request->getGet('delete_id');
        
        if ($id == 1 || $id == 2 || $id == 5) {
            return redirect()->back()->with('warning', "Default Role Can't be delete");
        } else {
            
            if ($this->roleModel->delete($id)) {
                $output = array('status' => 'Role deleted Sucessfully');
            }

            return $this->response->setJSON($output);
            
        }
    }

    private function mapRequestObjectWithDbObject(&$dbObj, $requestObj)
    {
        $dbObj->Role = $requestObj->Role;
        $dbObj->CanViewUser = $requestObj->CanViewUser;
        $dbObj->CanEditUser = $requestObj->CanEditUser;
        $dbObj->CanAddUser = $requestObj->CanAddUser;
        $dbObj->CanDeleteUser = $requestObj->CanDeleteUser;


        $dbObj->CanViewQuotation = $requestObj->CanViewQuotation;
        $dbObj->CanAddQuotation = $requestObj->CanAddQuotation;
        $dbObj->CanEditQuotation = $requestObj->CanEditQuotation;
        $dbObj->CanDeleteQuotation     = $requestObj->CanDeleteQuotation;

        $dbObj->CanViewQuestion = $requestObj->CanViewQuestion;
        $dbObj->CanAddQuestion = $requestObj->CanAddQuestion;
        $dbObj->CanEditQuestion = $requestObj->CanEditQuestion;
        $dbObj->CanDeleteQuestion  = $requestObj->CanDeleteQuestion;

        $dbObj->CanViewClient = $requestObj->CanViewClient;
        $dbObj->CanAddClient = $requestObj->CanAddClient;
        $dbObj->CanEditClient = $requestObj->CanEditClient;
        $dbObj->CanDeleteClient  = $requestObj->CanDeleteClient;

        $dbObj->CanViewClientType  = $requestObj->CanViewClientType;
        $dbObj->CanAddClientType = $requestObj->CanAddClientType;
        $dbObj->CanEditClientType = $requestObj->CanEditClientType;
        $dbObj->CanDeleteClientType = $requestObj->CanDeleteClientType;


        $dbObj->CanViewProjectScope = $requestObj->CanViewProjectScope;
        $dbObj->CanAddProjectScope = $requestObj->CanAddProjectScope;
        $dbObj->CanEditProjectScope  = $requestObj->CanEditProjectScope;
        $dbObj->CanDeleteProjectScope  = $requestObj->CanDeleteProjectScope;

        $dbObj->CanViewRole = $requestObj->CanViewRole;
        $dbObj->CanAddRole = $requestObj->CanAddRole;
        $dbObj->CanEditRole  = $requestObj->CanEditRole;
        $dbObj->CanDeleteRole  = $requestObj->CanDeleteRole;

        $dbObj->CanViewInvoice = $requestObj->CanViewInvoice;
        $dbObj->CanAddInvoice = $requestObj->CanAddInvoice;
        $dbObj->CanEditInvoice  = $requestObj->CanEditInvoice;
        $dbObj->CanDeleteInvoice  = $requestObj->CanDeleteInvoice;

        $dbObj->CanViewClientProject = $requestObj->CanViewClientProject;
        $dbObj->CanAddClientProject = $requestObj->CanAddClientProject;
        $dbObj->CanEditClientProject  = $requestObj->CanEditClientProject;
        $dbObj->CanDeleteClientProject  = $requestObj->CanDeleteClientProject;
        $dbObj->CanAssignProject  = $requestObj->CanAssignProject;
    }
}
