<?php

namespace App\Controllers;

use Config\App;

class Client extends BaseController
{
    private $auth = null;
    
    public function __construct()
    {
        
        $this->auth = service("auth");
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewClient) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientModel = new \App\Models\ClientModel();
        $data = $clientModel->getAllClients();
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $types = $clientTypeModel->getAllClientType();
        return view("Client/index", ['clientsData' => $data, 'ClientType' => $types]);
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddClient) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $types = $clientTypeModel->getAllClientType();
        return view("Client/new", ['ClientType' => $types]);
    }
    public function add()
    {
        $clientModel = new \App\Models\ClientModel();
        $data = [
            "Client_Name" => $this->request->getPost('clientName'),
            "Email_Address" => $this->request->getPost('clientEmailAddress'),
            "Phone_Number" => $this->request->getPost('clientPhoneNumber'),
            "Client_Type" => $this->request->getPost('clientType')
        ];
        $clientModel->insertClient($data);
        return redirect()->to("Client/index");
    }
    public function ajaxSubmit()
    {
        $clientModel = new \App\Models\ClientModel();
        $data = [
            "Client_Name" => $this->request->getPost('clientName'),
            "Email_Address" => $this->request->getPost('clientEmailAddress'),
            "Phone_Number" => $this->request->getPost('clientPhoneNumber'),
            "Client_Type" => $this->request->getPost('clientType')
        ];
        $clientModel->insertClient($data);
        $data = [
            'success' => true
        ];
        return $this->response->setJSON($data);
    }
    public function edit($Id)
    {
        if (!$this->auth->getUserRole()->CanEditClient) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientModel = new \App\Models\ClientModel();
        $client = $clientModel->getClientsById($Id);
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $types = $clientTypeModel->getAllClientType();
        return view('Client/edit', ["Client" => $client, 'ClientType' => $types]);
    }
    public function update($Id)
    {
        $clientModel = new \App\Models\ClientModel();
        $data = [
            "Client_Name" => $this->request->getPost('clientName'),
            "Email_Address" => $this->request->getPost('clientEmailAddress'),
            "Phone_Number" => $this->request->getPost('clientPhoneNumber'),
            "Client_Type" => $this->request->getPost('clientType')
        ];
        $clientModel->updateClientById($Id, $data);
        return redirect()->to("Client/index");
    }
    public function delete($Id)
    {
        if (!$this->auth->getUserRole()->CanDeleteClient) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientModel = new \App\Models\ClientModel();
        $clientModel->deleteClient($Id);
        return redirect()->to("Client/index");
    }
}
