<?php

namespace App\Controllers;

use function PHPUnit\Framework\isNull;

class Quotation extends BaseController
{
    private $auth = null;
    public function __construct()
    {
        $this->auth = service("auth");
    }
    public function index()
    {

        if (!$this->auth->getUserRole()->CanViewQuotation) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $quotationModel = new \App\Models\QuotationModel();
        $notQoutedcount = count($quotationModel->getAllNotQoutedQuotation());
        $Qoutedcount = count($quotationModel->getAllQoutedQuotation());
        $clientModel = new \App\Models\ClientModel();
        $user_id = session()->get('user_id');
        $role_id = session()->get('role_id');
        if ($role_id == 5) {
            $curentloginclient = $clientModel->getClientbyUserId($user_id);
            $clientId = $curentloginclient[0]['Id'];
            $notQoutedcount = count($quotationModel->getAllNotQoutedQuotationbyClientId($clientId));
            $data = ["QuotationData" => $quotationModel->getAllQuotationWithClientId($clientId), "NotQuotedQoutation" => $quotationModel->getAllNotQoutedQuotationbyclientId($clientId), 'notqoutedcount' => $notQoutedcount, "QuotedQoutation" => $quotationModel->getAllQoutedQuotationbyclientId($clientId), 'qoutedcount' => $Qoutedcount];
        } else {
            $data = ["QuotationData" => $quotationModel->getAllQuotationWithClient(), "NotQuotedQoutation" => $quotationModel->getAllNotQoutedQuotation(), 'notqoutedcount' => $notQoutedcount, "QuotedQoutation" => $quotationModel->getAllQoutedQuotation(), 'qoutedcount' => $Qoutedcount];
        }
        return view("Quotation/index", $data);
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddQuotation) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $clientModel = new \App\Models\ClientModel();
        $ProjectScopeModel = new \App\Models\ProjectScopeModel();
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $types = $clientTypeModel->getAllClientType();
        $ClientsData = $clientModel->getAllClients();
        $ProjectScopes = $ProjectScopeModel->getAllProjectScopes();
        return view("Quotation/new", ["ClientType" =>  $types, "ClientsData" => $ClientsData, "ProjectScopes" => $ProjectScopes]);
    }
    public function add()
    {
        if (!$this->auth->getUserRole()->CanAddQuotation) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $Data_Projects = array();
        $i = 1;
        while (true) {
            if (empty($this->request->getPost("project-name-" . $i . ""))) {
                break;
            } else {
                $Data_Projects['project-' . $i . ''] = array(
                    'project-name' => $this->request->getPost("project-name-" . $i . ""),
                    'delivery-date' => $this->request->getPost("delivery-date-" . $i . ""),
                    'lump-sump' => $this->request->getPost("lump-sump-" . $i . ""),
                    'project_scope' => $this->request->getPost("project-scope-" . $i . "")
                );
            }
            $i++;
        }
        //Client Information
        $Client = $this->request->getPost("client");
        //Discount 
        $Discount = 0;
        if (!empty($this->request->getPost('Discount'))) {
            $Discount = $this->request->getPost('Discount');
        }
        $quotationModel = new \App\Models\QuotationModel();
        $quotationModel->addNewQuotation($Data_Projects, $Client, $Discount);
        return redirect()->to("Quotation/index");
    }
    public function view($QuotationId)
    {
        if (!$this->auth->getUserRole()->CanViewQuotation) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $ProjectScopeModel = new \App\Models\ProjectScopeModel();
        $projectModel = new \App\Models\ProjectModel();
        $quotationModel = new \App\Models\QuotationModel();
        return view('Quotation/view', [
            "ProjectScopes" => $ProjectScopeModel->getProjectScopesById($QuotationId),
            "Projects" => $projectModel->getProjectsById($QuotationId), "Quotation" => $quotationModel->getQuotationById($QuotationId)
        ]);
    }
    public function delete()
    {
        if (!$this->auth->getUserRole()->CanDeleteQuotation) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $id = $this->request->getGet('delete_id');
        $quotationModel = new \App\Models\QuotationModel();
        $quotationModel->deleteQuotation($id);
        $output = array('status' => 'Qoutation deleted Sucessfully');
        return $this->response->setJSON($output);
    }
    public function edit($id)
    {
        if (!$this->auth->getUserRole()->CanEditQuotation) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $quotationModel = new \App\Models\QuotationModel();
        $clientModel = new \App\Models\ClientModel();
        $ProjectScopeModel = new \App\Models\ProjectScopeModel();
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $types = $clientTypeModel->getAllClientType();
        $qoutation = $quotationModel->find($id);
        $project = $quotationModel->getprojectbyQoutationID($id);
        $project_ids = [];
        foreach ($project as $p) {
            array_push($project_ids, $p['Id']);
        }
        $project_scopes = $quotationModel->getProjectScopes(($project_ids));
        $ClientsData = $clientModel->getAllClients();
        $ProjectScopes = $ProjectScopeModel->getAllProjectScopes();


        if ($this->request->getPost('submit')) {
            $Data_Projects = array();
            $i = 1;
            while (true) {
                if (empty($this->request->getPost("project-name-" . $i . ""))) {
                    break;
                } else {
                    $Data_Projects['project-' . $i . ''] = array(
                        'project-id' => $this->request->getPost("project-id-" . $i . ""),
                        'project-name' => $this->request->getPost("project-name-" . $i . ""),
                        'delivery-date' => $this->request->getPost("delivery-date-" . $i . ""),
                        'lump-sump' => $this->request->getPost("lump-sump-" . $i . ""),
                        'project_scope' => $this->request->getPost("project-scope-" . $i . "")
                    );
                }
                $i++;
            }
            //Client Information
            $Client = $this->request->getPost("client");
            //Discount 
            $Discount = 0;
            if (!empty($this->request->getPost('Discount'))) {
                $Discount = $this->request->getPost('Discount');
            }
            $quotationModel = new \App\Models\QuotationModel();
            $quotationModel->editQuotation($Data_Projects, $Client, $Discount, $id);
            return redirect()->to("Quotation/index");
        }

        return view("Quotation/edit", ["ClientType" =>  $types, "ClientsData" => $ClientsData, "ProjectScopes" => $ProjectScopes, "previousScopes" => $project_scopes, "qoutation" => $qoutation, "projectDetail" => $project]);
    }

    public function deleteproject()
    {
        if (!$this->auth->getUserRole()->CanDeleteQuotation) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $id = $this->request->getGet('delete_id');
        $quotationModel = new \App\Models\QuotationModel();
        $quotationModel->deleteprojects($id);
        $output = array('status' => 'Project deleted Sucessfully');
        return $this->response->setJSON($output);
    }

    public function projectqoutation($id)
    {
        $quotationModel = new \App\Models\QuotationModel();
        $qoutationid = $quotationModel->getQuotationfromprojectid($id);
        $qoutationid = $qoutationid[0]['Id'];
        return redirect()->to("Quotation/view/" . $qoutationid . "");
    }

    public function ReviewQuotation($id)
    {
        $quotationModel = new \App\Models\QuotationModel();
        $data = [
            'review' => $this->request->getPost("review")
        ];
        $quotationModel->reviewqoutation($data, $id);
        return redirect()->to("Quotation/index");
    }
    public function acceptquotation($id)
    {
        $quotationModel = new \App\Models\QuotationModel();
        $quotationModel->acceptquotation($id);
        return redirect()->to("Quotation/index");
    }
    public function generateInvoice()
    {
        if ($this->request->getMethod() == "post") {
            $quotation_id = $this->request->getPost("qoutation_id");
            $ProjectScopeModel = new \App\Models\ProjectScopeModel();
            $projectModel = new \App\Models\ProjectModel();
            $quotationModel = new \App\Models\QuotationModel();
            $data = [
                "ProjectScopes" => $ProjectScopeModel->getProjectScopesById($quotation_id),
                "Projects" => $projectModel->getProjectsById($quotation_id),
                "Quotation" => $quotationModel->getQuotationById($quotation_id)
            ];
            $invoice_object = new Invoices();
            $response = $invoice_object->createPayPalInvoice($data);
            if (isset($response->id)) {
                $sendResponse = $invoice_object->sendInvoice($response->id);
                if (isset($sendResponse->href)) {
                    if ($quotationModel->saveInvoice($quotation_id, $response->id)) {
                        $result = ['success', 'Invoice created successfully'];
                    } else {
                        $result = ['failed', 'Invoice cannot be generated.'];
                    }
                } else {
                    $result = ['failed', 'Invoice cannot be generated.'];
                }
            } else {
                $result = ['failed', 'Invoice cannot be generated.'];
            }
            return json_encode($result);
            // return json_encode($data);
        }
    }

    public function changeStatus()
    {
        $quotationModel = new \App\Models\QuotationModel();
        if ($this->request->getMethod() == "post") {
            $data = [
                "status" => $this->request->getPost('changestatus'),
                "reason" => $this->request->getPost('review'),
                "QuotationId" => $this->request->getPost('qoutationId'),
            ];
            // dd($data);
            if($quotationModel->changeStatus($data)){
                return redirect()->to("Quotation/index");
            }
            
        }
    }

}
