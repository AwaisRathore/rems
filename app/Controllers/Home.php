<?php

namespace App\Controllers;
class Home extends BaseController
{
    private $auth = null;
    public function __construct()
    {

        $this->auth = service("auth");
    }
    public function index()
    {
        $quotationModel = new \App\Models\QuotationModel();
        $clientModel = new \App\Models\ClientModel();
        $projectModel = new \App\Models\ProjectModel();
        $UserModel = new \App\Models\UserModel();
        $notificationModel = new \App\Models\NotificationModel();

        $sales = 0;
        $allprojects = $projectModel->getAllProjectsWithQuotations();
        foreach ($allprojects as $value) {
           $sales= $sales + ($value['Lump_Sump_Charges']-($value['Lump_Sump_Charges']*($value['Discount']/100)));
        }
        $user_data = session()->get('user_data');
        $user_id = session()->get('user_id');
        
        if ($this->auth->getUserRole()->name=="Admin") {
            $data = [
                'QuotationCount'=>count($quotationModel->getAllQuotationWithClient()),
                "ClientsCount"=>count($clientModel->getAllClients()),
                "ProjectCount"=>count($projectModel->getAllClientProjects()),
                "inprogressProjectCount"=>count($projectModel->getcountAllInProgesssProjects()),
                "completeProjectCount"=>$projectModel->getcountAllCompletedProjects(),
                "Sales"=>$sales,
                "user_data"=>$user_data,
                'usercount'=>count($UserModel->findAll()),
                'notification'=> $notificationModel->getAdminNotification(),
                'allQoutationcountthismonth'=> $quotationModel->getNOofQuotationperday(),
                'allacceptedQoutationcountthismonth'=> $quotationModel->getNOofAcceptedQuotationperday(),
            ];
        }
        if ($this->auth->getUserRole()->name=="Client") {
            $curentloginclient = $clientModel->getClientbyUserId($user_id);
            $clientId = $curentloginclient[0]['Id'];
            $data = ['ProjectCount'=>count($projectModel->getProjectsByClientId($clientId)),"inprogressProjectCount"=>count($projectModel->getcountInProgesssProjects($clientId)),'completeProjectCount'=>$projectModel->getcountCompletedProjects($clientId),'notification'=> $notificationModel->getUserNotification($user_id)];
        }
        if ($this->auth->getUserRole()->name=="Employee") {
            $user_id = session()->get('user_id');
           
            $data = [
                'ProjectCount'=>count($projectModel->getProjectsByEmployeesId($user_id)),
                "inprogressProjectCount"=>count($projectModel->getallProgressProjectofEmployees($user_id)),
                'completeProjectCount'=>count($projectModel->getallCompletedProjectofEmployees($user_id)),
                'notification'=> $notificationModel->getUserNotification($user_id)
            ];
        }
        
        return view("Home/index",$data);
    }
}
