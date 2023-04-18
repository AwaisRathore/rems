<?php

namespace App\Controllers;

use Config\App;

class ClientType extends BaseController
{
    private $auth = null;
    public function __construct()
    {
        
        $this->auth = service("auth");
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewClientType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $types = $clientTypeModel->getAllClientType();
        return view("ClientType/index", ['ClientType' => $types]);
    }
    public function add()
    {
        if (!$this->auth->getUserRole()->CanAddClientType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $ClientType = $this->request->getPost("clienttype");
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $clientTypeModel->insertType($ClientType);
        return redirect()->to("ClientType/index");
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddClientType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        return view("ClientType/new");
    }
    public function edit($Id)
    {
        if (!$this->auth->getUserRole()->CanEditClientType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $data = $clientTypeModel->getClientTypeById($Id);
        return view("ClientType/edit",["ClientType" => $data]);
    }
    public function update($Id)
    {
        if (!$this->auth->getUserRole()->CanEditClientType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $ClientType = $this->request->getPost("clienttype");
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $clientTypeModel->updateClientType($ClientType,$Id);
        return redirect()->to("ClientType/index");
    }
    public function delete($Id)
    {
        if (!$this->auth->getUserRole()->CanDeleteClientType) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $clientTypeModel->deleteClient($Id);
        return redirect()->to("ClientType/index");
    }
}