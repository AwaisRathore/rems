<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class QuotationModel extends Model
{
    protected $table = 'quotations';

    public function getAllQuotationWithClient()
    {
        $query = "SELECT q.*,c.Name as Client_Name, c.Email_Address as Client_EmailAddress FROM `quotations` q join `clients` c on q.Client_Id = c.Id ORDER BY q.Id DESC";
        $Quotations = $this->db->query($query)->getResultArray();
        $invoices = $this->getInvoicesWithQuotations();
        foreach ($Quotations as &$quotation) {
            foreach ($invoices as $invoice) {
                if ($quotation['Quotation_Id'] == $invoice->Quotation_Id) {
                    $isInvoiceGenerated = true;
                    $quotation['invoice'] = $invoice->Invoice_Id;
                }
            }
        }
        return $Quotations;
    }
    public function getNOofQuotationperday()
    {
        $query = "SELECT DATE(created_at) AS day, COUNT(Id) AS num_quotations FROM quotations WHERE created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 14 DAY) GROUP BY day ORDER by Id ASC;";
        $Quotations = $this->db->query($query)->getResultArray();
        return $Quotations;
    }
    public function getNOofAcceptedQuotationperday()
    {
        $query = "SELECT DATE(created_at) AS day, COUNT(Id) AS num_quotations FROM quotations WHERE created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 14 DAY) and status = 1 GROUP BY day ORDER by Id ASC;";
        $Quotations = $this->db->query($query)->getResultArray();
        return $Quotations;
    }
    public function getAllQuotationWithClientId($ClientId)
    {
        $query = "SELECT q.*,c.Name as Client_Name, c.Email_Address as Client_EmailAddress FROM `quotations` q join `clients` c on q.Client_Id = c.Id where q.Client_Id = $ClientId ORDER BY q.Id DESC";
        $Quotations = $this->db->query($query)->getResultArray();
        return $Quotations;
    }
    public function getAllNotQoutedQuotation()
    {
        $query = "SELECT q.*,c.Name as Client_Name, c.Email_Address as Client_EmailAddress FROM `quotations` q join `clients` c on q.Client_Id = c.Id JOIN projects p on p.Quotation_Id= q.Id WHERE p.Lump_Sump_Charges =0 GROUP by q.Id ORDER BY q.Id DESC";
        $Quotations = $this->db->query($query)->getResultArray();
        $invoices = $this->getInvoicesWithQuotations();
        foreach ($Quotations as &$quotation) {
            foreach ($invoices as $invoice) {
                if ($quotation['Quotation_Id'] == $invoice->Quotation_Id) {
                    $isInvoiceGenerated = true;
                    $quotation['invoice'] = $invoice->Invoice_Id;
                }
            }
        }
        return $Quotations;
    }
    public function getAllNotQoutedQuotationbyclientId($ClientId)
    {
        $query = "SELECT q.*,c.Name as Client_Name, c.Email_Address as Client_EmailAddress FROM `quotations` q join `clients` c on q.Client_Id = c.Id JOIN projects p on p.Quotation_Id= q.Id WHERE p.Lump_Sump_Charges =0 and q.Client_Id = $ClientId GROUP by q.Id ORDER BY q.Id DESC";
        $Quotations = $this->db->query($query)->getResultArray();
        return $Quotations;
    }
    public function getAllQoutedQuotation()
    {
        $query = "SELECT q.*,c.Name as Client_Name, c.Email_Address as Client_EmailAddress FROM `quotations` q join `clients` c on q.Client_Id = c.Id JOIN projects p on p.Quotation_Id= q.Id WHERE p.Lump_Sump_Charges !=0 GROUP by q.Id ORDER BY q.Id DESC";
        $Quotations = $this->db->query($query)->getResultArray();
        $invoices = $this->getInvoicesWithQuotations();
        foreach ($Quotations as &$quotation) {
            foreach ($invoices as $invoice) {
                if ($quotation['Quotation_Id'] == $invoice->Quotation_Id) {
                    $isInvoiceGenerated = true;
                    $quotation['invoice'] = $invoice->Invoice_Id;
                }
            }
        }
        return $Quotations;
    }
    public function getQuotationfromprojectid($project_id)
    {
        $query = "SELECT q.Id FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id WHERE p.Id = $project_id";
        $Quotations = $this->db->query($query)->getResultArray();
        return $Quotations;
    }
    public function getAllQoutedQuotationbyclientId($ClientId)
    {
        $query = "SELECT q.*,c.Name as Client_Name, c.Email_Address as Client_EmailAddress FROM `quotations` q join `clients` c on q.Client_Id = c.Id JOIN projects p on p.Quotation_Id= q.Id WHERE p.Lump_Sump_Charges !=0 and q.Client_Id = $ClientId GROUP by q.Id ORDER BY q.Id DESC";
        $Quotations = $this->db->query($query)->getResultArray();
        return $Quotations;
    }
    public function getQuotationById($Id)
    {
        $query = "SELECT q.*,c.Name as Client_Name, c.Email_Address as Client_EmailAddress FROM `quotations` q join `clients` c on q.Client_Id = c.Id where q.Id = " . $Id . "";
        $Quotations = $this->db->query($query)->getRowArray();
        $notificatinModel = new \App\Models\NotificationModel();
        $user_id = NULL;
        if (current_userRole()->name == 'Client') {
            $user_id = current_user()->id;
        }
        $notificatinModel->updatedstatus($Id, $user_id);
        return $Quotations;
    }
    public function addNewQuotation($Project_Data, $ClientId, $Discount)
    {
        //Add Quotation
        $query = "INSERT INTO `quotations`(`Client_Id`,`Discount`,`status`) VALUES ('$ClientId','$Discount','1')";
        $this->db->query($query);
        $QuotationId = $this->db->insertID();
        //Add Project
        $Project_Ids = array();
        foreach ($Project_Data as $value) {
            $project_name = $value["project-name"];
            $delivery_date = $value["delivery-date"];
            $lump_sump = $value["lump-sump"];
            $query = "INSERT INTO `projects`(`Project_Name`, `Delivery_Date`, `Quotation_Id`, `Lump_Sump_Charges`) VALUES ('$project_name','$delivery_date',' $QuotationId','$lump_sump')";
            $this->db->query($query);
            array_push($Project_Ids, $this->db->insertID());
        }
        // Add Custom made quotation Id
        $project_counts = count($Project_Ids);
        $custom_quotation_id = $QuotationId . $project_counts . date('m/d/Y');
        $query = "UPDATE `quotations` SET `Quotation_Id`='$custom_quotation_id' WHERE Id=" . $QuotationId;
        $this->db->query($query);
        //Add Project Scopes
        $i = 0;
        foreach ($Project_Data as $value) {
            foreach ($value['project_scope'] as $project_scope_type) {

                $query = "INSERT INTO `projectscopes`(`Project_Id`, `ProjectScopeType`) VALUES ('$Project_Ids[$i]','$project_scope_type')";
                $this->db->query($query);
            }
            $i++;
        }
    }
    public function editQuotation($Project_Data, $ClientId, $Discount, $id)
    {
        //Edit Quotation

        $query = "UPDATE `quotations` SET `Client_Id`='$ClientId',`Discount`='$Discount' where Id ='$id'";
        $this->db->query($query);
        $QuotationId = $id;
        $sql = "SELECT q.Client_Id FROM `quotations` q WHERE q.Id = $QuotationId";
        $ClientId = $this->db->query($sql)->getResultArray();
        // dd($ClientId);
        $clientid =  $ClientId[0]['Client_Id'];
        $sql = "SELECT c.user_id FROM `clients` c WHERE c.Id = $clientid";
        $UserId = $this->db->query($sql)->getResultArray();
        $user_id =  $UserId[0]['user_id'];

        //Edit Project
        $Project_Ids = array();
        $projects_name = array();
        foreach ($Project_Data as $value) {
            $project_name = $value["project-name"];
            $project_id = $value["project-id"];
            $delivery_date = $value["delivery-date"];
            $lump_sump = $value["lump-sump"];
            $query = "UPDATE `projects` SET `Project_Name`='$project_name',`Delivery_Date`='$delivery_date',`Lump_Sump_Charges`='$lump_sump' where `Id`='$project_id'";
            $this->db->query($query);
            array_push($Project_Ids, $project_id);
            array_push($projects_name, $project_name);
        }
        // Add Custom made quotation Id
        $project_counts = count($Project_Ids);
        $this->db->query($query);
        //Add Project Scopes
        $i = 0;
        $j = 0;
        $Project_scope_Ids = array();
        foreach ($Project_Data as $value) {
            $query = "SELECT * FROM `projectscopes` p WHERE p.Project_Id='{$Project_Ids[$i]}'";
            $result = $this->db->query($query)->getResultArray();
            foreach ($result as $project_scope_id) {
                $projectscope_id = $project_scope_id["Id"];
                array_push($Project_scope_Ids, $projectscope_id);
            }
            count($Project_scope_Ids);
            foreach ($value['project_scope'] as $project_scope_type) {
                if (!in_array($value, $result)) {
                    $query = "INSERT INTO `projectscopes`(`Project_Id`, `ProjectScopeType`) VALUES ('$Project_Ids[$i]','$project_scope_type')";
                    $this->db->query($query);
                }
            }
            foreach ($result as $projectscope) {
                if (!in_array($projectscope, $value)) {
                    $scope_id = $projectscope['Id'];
                    $query = "DELETE FROM `projectscopes` WHERE `projectscopes`.`Project_Id`=$Project_Ids[$i] and `projectscopes`.`Id`=$scope_id";
                    $this->db->query($query);
                }
            }
            $i++;
        }

        if ($user_id != '') {
            $project_name = join(',', $projects_name);
            $notificatinModel = new \App\Models\NotificationModel();
            $message = "Congratulation! Your Projects " . $project_name . " are qouted!";
            $notificatinModel->addqoutationNotification($QuotationId, $message, $user_id);
        }
    }

    public function deleteQuotation($QuotationId)
    {
        $query = "DELETE q,p,ps FROM quotations q join projects p on p.Quotation_Id = q.Id join projectscopes ps on ps.Project_Id = p.Id where q.Id =" . $QuotationId;
        $this->db->query($query);
    }

    public function getprojectbyQoutationID($id)
    {
        $query = "SELECT * FROM `projects` p WHERE p.Quotation_Id=$id";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    public function getProjectScopes($project_ids)
    {
        $project_ids = join(',', $project_ids);
        $sql = "SELECT ps.*, pt.Type_Names FROM `projectscopes` ps JOIN `projectscopetypes` pt on ps.ProjectScopeType = pt.Id WHERE ps.Project_Id IN ($project_ids);";
        $result = $this->db->query($sql)->getResultArray();
        return $result;
    }

    public function deleteprojects($id)
    {
        $query = "DELETE FROM `projects` WHERE Id = $id";
        $this->db->query($query);
    }

    public function reviewqoutation($data, $id)
    {
        $review = $data['review'];
        $query = "UPDATE `quotations` SET `review`='$review' where Id = $id";
        $this->db->query($query);
        $QuotationId = $id;
        $sql = "SELECT q.Client_Id FROM `quotations` q WHERE q.Id = $QuotationId";
        $ClientId = $this->db->query($sql)->getResultArray();
        $clientid =  $ClientId[0]['Client_Id'];
        $sql = "SELECT c.user_id,c.Name FROM `clients` c WHERE c.Id = $clientid";
        $UserId = $this->db->query($sql)->getResultArray();
        $clientName =  $UserId[0]['Name'];
        $notificatinModel = new \App\Models\NotificationModel();
        $message = "oops! " . $clientName . " Reject the Quotation.";
        $notificatinModel->addqoutationNotificationwithoutuserid($QuotationId, $message);
    }
    public function acceptquotation($id)
    {
        $query = "UPDATE `quotations` SET `status`='1',`review`=NULL where Id = $id";
        $this->db->query($query);
        $QuotationId = $id;
        $sql = "SELECT q.Client_Id FROM `quotations` q WHERE q.Id = $QuotationId";
        $ClientId = $this->db->query($sql)->getResultArray();
        $clientid =  $ClientId[0]['Client_Id'];
        $sql = "SELECT c.user_id,c.Name FROM `clients` c WHERE c.Id = $clientid";
        $UserId = $this->db->query($sql)->getResultArray();
        $clientName =  $UserId[0]['Name'];
        $notificatinModel = new \App\Models\NotificationModel();
        $message = "Congratulation! " . $clientName . " accept the Qoutation";
        $notificatinModel->addqoutationNotificationwithoutuserid($QuotationId, $message);
    }
    public function saveInvoice($QuotationId, $InvoiceId)
    {
        $sql = "INSERT INTO `invoices` (`QuotationId`, `Invoice_Id`) VALUES ('$QuotationId', '$InvoiceId');";
        return $this->db->query($sql);
    }
    public function getInvoicesWithQuotations()
    {
        $sql = "SELECT q.Quotation_Id, i.Invoice_Id FROM `invoices` i JOIN `quotations` q on q.Id = i.QuotationId;";
        return $this->db->query($sql)->getResultObject();
    }
}
