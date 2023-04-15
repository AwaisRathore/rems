<?php

namespace App\Controllers;

use Config\App;

class EmployeeType extends BaseController
{
    private $auth = null;
    public function __construct()
    {
        
        $this->auth = service("auth");
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewEmployeeType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $employeeTypeModel = new \App\Models\EmployeeTypeModel();
        $types = $employeeTypeModel->findAll();
        return view("EmployeeType/index", ['EmployeeType' => $types]);
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddEmployeeType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        if($this->request->getMethod() == 'post'){
            $data = [
                'type' => $this->request->getPost("employeetype"),
            ];
            // dd($data);
            $employeeTypeModel = new \App\Models\EmployeeTypeModel();
            $employeeTypeModel->insert($data);
            return redirect()->to("EmployeeType/index");
        }
        return view("EmployeeType/new");
    }
    
    public function edit($Id)
    {
        if (!$this->auth->getUserRole()->CanEditEmployeeType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $employeeTypeModel = new \App\Models\EmployeeTypeModel();
        $data = $employeeTypeModel->find($Id);
        if($this->request->getMethod() == 'post'){
            $data = [
                'type' => $this->request->getPost("employeetype"),
            ];
            $employeeTypeModel->update($Id,$data);
            return redirect()->to("EmployeeType/index");
        }
        return view("EmployeeType/edit",["EmployeeType" => $data]);
    }
    
    public function delete()
    {
        if (!$this->auth->getUserRole()->CanDeleteEmployeeType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $id = $this->request->getGet('delete_id');
        $employeeTypeModel = new \App\Models\EmployeeTypeModel();
        if ($employeeTypeModel->delete($id)) {
            $output = array('status' => 'Employee Type deleted Sucessfully');
        }

        return $this->response->setJSON($output);
    }
}