<?php

namespace App\Controllers;

use Config\App;

class ProjectScopeType extends BaseController
{
    private $auth = null;
    public function __construct()
    {
        
        $this->auth = service("auth");
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewProjectScope) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $projectScopeTypeModel = new \App\Models\ProjectScopeTypeModel();
        $types = $projectScopeTypeModel->getAllProjectScopeType();
        return view("ProjectScopeType/index", ['ProjectScopeType' => $types]);
    }
    public function add()
    {
        if (!$this->auth->getUserRole()->CanAddProjectScope) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $ProjectType = $this->request->getPost("projectscopetype");
        $projectScopeTypeModel = new \App\Models\ProjectScopeTypeModel();
        $projectScopeTypeModel->insertType($ProjectType);
        return redirect()->to("ProjectScopeType/index");
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddProjectScope) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        return view("ProjectScopeType/new");
    }
    public function edit($Id)
    {
        if (!$this->auth->getUserRole()->CanEditProjectScope) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $projectScopeTypeModel = new \App\Models\ProjectScopeTypeModel();
        $data = $projectScopeTypeModel->getProjectScopeTypeById($Id);
        return view("ProjectScopeType/edit",["ProjectScopeType" => $data]);
    }
    public function update($Id)
    {
        if (!$this->auth->getUserRole()->CanEditProjectScope) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $ProjectType = $this->request->getPost("projectscopetype");
        $projectScopeTypeModel = new \App\Models\ProjectScopeTypeModel();
        $projectScopeTypeModel->updateProjectScopeTypeById($ProjectType,$Id);
        return redirect()->to("ProjectScopeType/index");
    }
    public function delete($Id)
    {
        if (!$this->auth->getUserRole()->CanDeleteProjectScope) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $projectScopeTypeModel = new \App\Models\ProjectScopeTypeModel();
        $projectScopeTypeModel->deleteProjectScopeType($Id);
        return redirect()->to("ProjectScopeType/index");
    }
}