<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectModel extends Model
{
    protected $table = 'projects';

    public function getProjectsById($Id)
    {
        $query = "SELECT p.* FROM `quotations` q  join `projects` p on p.Quotation_Id = q.Id where q.Id = " . $Id . "";
        $projects = $this->db->query($query)->getResultArray();
        return $projects;
    }
    public function getProjectsByClientId($Id)
    {
        $query = "SELECT q.Client_Id,c.Name,a.*,p.Id,p.Project_Name,p.Delivery_Date,p.Quotation_Id,p.Lump_Sump_Charges,p.Project_file,p.project_file_link,p.notes,p.project_type,p.deliver_file,p.status as projectStatus,q.status as qoutationStatus FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id LEFT JOIN assignproject a on a.project_id = p.Id WHERE q.Client_Id=$Id GROUP by p.Id order by p.Id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {

            if ($r['Project_file'] != null) {
                $r['Project_file'] = explode(',', $r['Project_file']);
            }
            if ($r['project_file_link'] != null) {
                $r['project_file_link']  = explode(',', $r['project_file_link']);
            }
        }
        return $result;
    }
    public function getcountInProgesssProjects($Id)
    {;
        $query = "SELECT p.Id as projectcount FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id LEFT JOIN assignproject a on a.project_id = p.Id WHERE q.Client_Id=$Id AND p.status= 0 AND a.user_id is not null GROUP by p.Id";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    public function getcountAllInProgesssProjects()
    {;
        $query = "SELECT p.Id as projectcount FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id LEFT JOIN assignproject a on a.project_id = p.Id WHERE p.status= 0 AND a.user_id is not null GROUP by p.Id";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    public function getcountCompletedProjects($Id)
    {
        $query = "SELECT COUNT(p.Id) as projectcount FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id WHERE q.Client_Id=$Id AND p.status= 1";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    public function getcountAllCompletedProjects()
    {
        $query = "SELECT COUNT(p.Id) as projectcount FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id WHERE p.status= 1";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    public function getAllClientProjects()
    {

        $query = "SELECT q.Client_Id,c.Name,a.*,p.Id,p.Project_Name,p.Delivery_Date,p.Quotation_Id,p.Lump_Sump_Charges,p.Project_file,p.project_file_link,p.notes,p.project_type,p.deliver_file,p.status as projectStatus,q.status as qoutationStatus,q.status as qoutationStatus FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id LEFT JOIN assignproject a on a.project_id = p.Id GROUP by p.Id order by p.Id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if ($r['Project_file'] != null) {
                $r['Project_file'] = explode(',', $r['Project_file']);
            }
            if ($r['project_file_link'] != null) {
                $r['project_file_link']  = explode(',', $r['project_file_link']);
            }
        }
        return $result;
    }
    public function getAllClientProjectsbydeliverydate()
    {

        $query = "SELECT q.Client_Id,c.Name,a.*,p.Id,p.Project_Name,p.Delivery_Date,p.Quotation_Id,p.Lump_Sump_Charges,p.Project_file,p.project_file_link,p.notes,p.project_type,p.deliver_file,p.status as projectStatus,q.status as qoutationStatus,q.status as qoutationStatus FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id LEFT JOIN assignproject a on a.project_id = p.Id GROUP by p.Id order by p.Delivery_Date asc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if ($r['Project_file'] != null) {
                $r['Project_file'] = explode(',', $r['Project_file']);
            }
            if ($r['project_file_link'] != null) {
                $r['project_file_link']  = explode(',', $r['project_file_link']);
            }
        }
        return $result;
    }
    public function getAllClientProjectsbyID($id)
    {
        $query = "SELECT q.Client_Id,c.Name,c.user_id as clientId,a.*,p.Id,p.Project_Name,p.Delivery_Date,p.Quotation_Id,p.Lump_Sump_Charges,p.Project_file,p.admin_uploaded_file,p.admin_file_link,p.project_file_link,p.notes,p.project_type,p.deliver_file  ,p.status as projectStatus,q.status as qoutationStatus FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id LEFT JOIN assignproject a on a.project_id = p.Id where p.Id = $id GROUP by p.Id order by p.Id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if ($r['Project_file'] != null) {
                $r['Project_file'] = explode(',', $r['Project_file']);
            }
            if ($r['admin_uploaded_file'] != null) {
                $r['admin_uploaded_file'] = explode(',', $r['admin_uploaded_file']);
            }
            if ($r['project_file_link'] != null) {
                $r['project_file_link']  = explode(',', $r['project_file_link']);
            }
            if ($r['admin_file_link'] != null) {
                $r['admin_file_link']  = explode(',', $r['admin_file_link']);
            }
            if ($r['deliver_file'] != 0) {
                $r['deliver_file']  = explode(',', $r['deliver_file']);
            }
        }
        $notificatinModel = new \App\Models\NotificationModel();

        $user_id = null;
        if (current_userRole()->name == 'Admin') {
            $user_id = null;
        } else {
            $user_id = current_user()->id;
        }


        $notificatinModel->updatedprojectstatus($id, $user_id);
        return $result;
    }
    public function getAllProjects()
    {
        $query = "SELECT * FROM `projects` ";
        $projects = $this->db->query($query)->getResultArray();
        return $projects;
    }
    public function getAllProjectsWithQuotations()
    {
        $query = "SELECT p.*,q.* FROM projects p join quotations q on p.Quotation_Id = q.Id";
        $projects = $this->db->query($query)->getResultArray();
        return $projects;
    }

    public function addNewProject($Project_Data, $ClientId)
    {
        //Add Quotation
        $query = "INSERT INTO `quotations`(`Client_Id`, `Discount`) VALUES ('$ClientId','0')";
        $this->db->query($query);
        $QuotationId = $this->db->insertID();
        //Add Project
        $Project_Ids = array();
        // dd($Project_Data);
        foreach ($Project_Data as $value) {
            $project_name = $value["project-name"];
            $delivery_date = $value["delivery-date"];
            $lump_sump = 0;
            $project_file = $value["project_file"];
            $project_file_link = $value["project_file_link"];
            $project_type = $value["project-type"];
            $notes = $value["notes"];
            $project_file = join(',', $project_file);
            $query = "INSERT INTO `projects`(`Project_Name`, `Delivery_Date`, `Quotation_Id`, `Lump_Sump_Charges`, `Project_file`, `project_file_link`, `notes`, `project_type`) VALUES ('$project_name','$delivery_date','$QuotationId','$lump_sump','$project_file','$project_file_link','$notes','$project_type')";
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

        $sql = "SELECT q.Client_Id FROM `quotations` q WHERE q.Id = $QuotationId";
        $ClientId = $this->db->query($sql)->getResultArray();
        $clientid =  $ClientId[0]['Client_Id'];
        $sql = "SELECT c.user_id,c.Name FROM `clients` c WHERE c.Id = $clientid";
        $UserId = $this->db->query($sql)->getResultArray();
        $clientName =  $UserId[0]['Name'];
        $notificatinModel = new \App\Models\NotificationModel();
        $message = "Congratulation! " . $clientName . " Added new projects and waiting for qoute!";
        $notificatinModel->addqoutationNotificationwithoutuserid($QuotationId, $message);
    }
    public function EditProject($Project_Data, $id)
    {
        //Add Project
        $Project_Ids = array();
        // dd($Project_Data);
        foreach ($Project_Data as $value) {
            $project_name = $value["project-name"];
            $delivery_date = $value["delivery-date"];
            $project_file = $value["project_file"];
            $project_file_link = $value["project_file_link"];
            $project_type = $value["project-type"];
            $notes = $value["notes"];
            if(!empty($project_file)){
                $project_file = join(',', $project_file);
            }
            $query = "UPDATE `projects` SET `Project_Name`='$project_name',`Delivery_Date`='$delivery_date',`Project_file`='$project_file',`project_file_link`='$project_file_link',`notes`='$notes',`project_type`='$project_type' WHERE Id = $id";
            $this->db->query($query);
            array_push($Project_Ids, $this->db->insertID());
        }
        // Add Custom made quotation Id
        $project_counts = count($Project_Ids);

        $this->db->query($query);
        //Add Project Scopes
        $i = 0;
        foreach ($Project_Data as $value) {
            $query = "SELECT * FROM `projectscopes` p WHERE p.Project_Id='{$id}'";
            $result = $this->db->query($query)->getResultArray();
            foreach ($value['project_scope'] as $project_scope_type) {
                if (!in_array($value, $result)) {
                    $query = "INSERT INTO `projectscopes`(`Project_Id`, `ProjectScopeType`) VALUES ('$id','$project_scope_type')";
                    $this->db->query($query);
                }
            }
            foreach ($result as $projectscope) {
                if (!in_array($projectscope, $value)) {
                    $scope_id = $projectscope['Id'];
                    $query = "DELETE FROM `projectscopes` WHERE `projectscopes`.`Project_Id`=$id and `projectscopes`.`Id`=$scope_id";
                    $this->db->query($query);
                }
            }
            $i++;
        }
    }

    public function assignProject($data)
    {
        $projectid = $data['projectid'];
        $CanViewFile = $data['CanViewFile'];
        $CanViewFileUrl = $data['CanViewFileUrl'];
        $query = "SELECT * FROM `assignproject` a WHERE a.project_id = $projectid";
        $result = $this->db->query($query)->getResultArray();
        $notificationModel = new \App\Models\NotificationModel();
        $assignerName = current_user()->username;
        // dd($data);
        foreach ($data['users'] as $users) {
            $query = "INSERT INTO `assignproject`(`user_id`, `project_id`,`CanViewFile`,`CanViewFileUrl`) VALUES ('$users','$projectid','$CanViewFile','$CanViewFileUrl')";
            $this->db->query($query);
            $message = 'New project is assigned to you by ' . $assignerName . '';
            $notificationModel->addprojectNotification($users, $projectid, $message);
        }
    }

    public function getassignProject()
    {
        $query = "SELECT a.*,u.username,u.profile_image FROM `assignproject` a join users u on u.id = a.user_id JOIN projects p on p.Id = a.project_id";
        $assignproject = $this->db->query($query)->getResultArray();
        return $assignproject;
    }
    public function getassignUserbyProjectId($id)
    {
        $query = "SELECT u.id,u.username,u.profile_image,ap.* FROM `assignproject` ap JOIN users u on ap.user_id = u.id WHERE ap.project_id = $id";
        $assignproject = $this->db->query($query)->getResultArray();
        return $assignproject;
    }
    public function getCountassignUserbyProjectId($id)
    {
        $query = "SELECT count(u.id) as assignusercount FROM `assignproject` ap JOIN users u on ap.user_id = u.id WHERE ap.project_id = $id";
        $assignproject = $this->db->query($query)->getResultArray();
        return $assignproject;
    }
    public function deleteassignUser($userid, $projectid)
    {
        $this->db->transStart();
        $query = "DELETE FROM `assignproject` WHERE user_id = $userid and project_id = $projectid";
        $this->db->query($query);
        $query = "DELETE FROM `projectprogress` WHERE user_id = $userid AND project_id = $projectid";
        $this->db->query($query);
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return false;
        }
        return true;
    }
    public function getFilteredUsersForAProject($project_id)
    {
        $sql = "SELECT u.id FROM `users` u JOIN `roles` r on r.id = u.role_id JOIN assignproject a on u.id = a.user_id WHERE a.project_id = $project_id;";
        $already_assigned_users = $this->db->query($sql)->getResultObject();
        $sql = "SELECT * FROM `users`;";
        $users = $this->db->query($sql)->getResultArray();
        $user_ids = array_column($users, 'id');
        $as_user_ids = array_column($already_assigned_users, 'id');
        $user_ids = array_diff($user_ids, $as_user_ids);
        $user_ids = join(',', $user_ids);
        $sql = "SELECT u.*,r.name FROM `users` u JOIN roles r on r.id = u.role_id where u.id in ($user_ids) AND u.role_id != 5;";
        $users = $this->db->query($sql)->getResultArray();
        return $users;
    }


    public function deleteProject($id)
    {
        $query = "SELECT p.Quotation_Id FROM `projects` p WHERE p.Id = $id";
        $QuotationId = $this->db->query($query)->getResultArray();
        $q_id = $QuotationId[0]['Quotation_Id'];
        $query = "SELECT COUNT(p.Quotation_Id) as q_count FROM `projects` p WHERE p.Quotation_Id = $q_id";
        $QuotationCount = $this->db->query($query)->getResultArray();
        $quotaionIdCount = $QuotationCount[0]['q_count'];
        if ($quotaionIdCount == 1) {
            $query = "DELETE FROM `quotations` where Id = $q_id";
            $this->db->query($query);
            return true;
        } else {
            $query = "DELETE FROM `projects` WHERE Id = $id";
            $this->db->query($query);
            return true;
        }
    }

    public function getProjectsByEmployeesId($id)
    {
        $query = "SELECT q.Client_Id,c.Name,a.*,p.Id,p.Project_Name,p.Delivery_Date,p.Quotation_Id,p.Lump_Sump_Charges,p.Project_file,p.project_file_link,p.notes,p.project_type,p.deliver_file,p.status as projectStatus,q.status as qoutationStatus FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id LEFT JOIN assignproject a on a.project_id = p.Id where a.user_id = $id GROUP by p.Id order by p.Id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if ($r['Project_file'] != null) {
                $r['Project_file'] = explode(',', $r['Project_file']);
            }
            if ($r['project_file_link'] != null) {
                $r['project_file_link']  = explode(',', $r['project_file_link']);
            }
        }
        return $result;
    }
    public function getallProgressProjectofEmployees($id)
    {
        $query = "SELECT q.Client_Id, p.*,c.Name,q.status as qoutationStatus FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id JOIN assignproject a on a.project_id = p.Id where a.user_id = $id and a.status = 1 and p.status = 0 order by p.Id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if ($r['Project_file'] != null) {
                $r['Project_file'] = explode(',', $r['Project_file']);
            }
            if ($r['project_file_link'] != null) {
                $r['project_file_link']  = explode(',', $r['project_file_link']);
            }
        }
        return $result;
    }
    public function getallCompletedProjectofEmployees($id)
    {
        $query = "SELECT q.Client_Id, p.*,c.Name,q.status as qoutationStatus FROM `quotations` q JOIN projects p on p.Quotation_Id = q.Id JOIN clients c on c.Id = q.Client_Id JOIN assignproject a on a.project_id = p.Id where a.user_id = $id and a.status = 1 and p.status = 1 order by p.Id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if ($r['Project_file'] != null) {
                $r['Project_file'] = explode(',', $r['Project_file']);
            }
            if ($r['project_file_link'] != null) {
                $r['project_file_link']  = explode(',', $r['project_file_link']);
            }
        }
        return $result;
    }

    public function rejectProject($id, $userid, $review)
    {
        $query = "UPDATE `assignproject` a SET a.status=0, a.assignReview= '$review' WHERE a.user_id = $userid and a.project_id = $id";
        $this->db->query($query);
        $notificatinModel = new \App\Models\NotificationModel();
        $employeeName = current_user()->username;
        $message = "" . $employeeName . " has rejected the Project";
        $notificatinModel->addprojectNotificationwithoutUserId($id, $message);
        return true;
    }
    public function acceptProject($id, $userid)
    {
        $query = "UPDATE `assignproject` a SET a.`status`=1 WHERE a.user_id = $userid and a.project_id = $id;";
        $this->db->query($query);
        $notificatinModel = new \App\Models\NotificationModel();
        $employeeName = current_user()->username;
        $message = "" . $employeeName . " has accepted the Project";
        $notificatinModel->addprojectNotificationwithoutUserId($id, $message);
        return true;
    }

    public function deliverProject($id, $data)
    {
        // dd($data);
        $deliverfile = $data['file'];
        $deliverfile = join(',', $deliverfile);

        $query = "UPDATE `projects` p SET `deliver_file`='$deliverfile' WHERE p.Id = $id";
        $this->db->query($query);

        $sql = "SELECT p.Quotation_Id, p.Project_Name FROM `projects` p WHERE p.Id = $id";
        $qoutationId = $this->db->query($sql)->getResultArray();
        $QuotationId =  $qoutationId[0]['Quotation_Id'];
        $projectName =  $qoutationId[0]['Project_Name'];
        $sql = "SELECT q.Client_Id FROM `quotations` q WHERE q.Id = $QuotationId";
        $ClientId = $this->db->query($sql)->getResultArray();
        // dd($ClientId);
        $clientid =  $ClientId[0]['Client_Id'];
        $sql = "SELECT c.user_id FROM `clients` c WHERE c.Id = $clientid";
        $UserId = $this->db->query($sql)->getResultArray();
        $user_id =  $UserId[0]['user_id'];

        if ($user_id != '') {
            $notificatinModel = new \App\Models\NotificationModel();
            $message = "Your " . $projectName . " has been reviewed and delivered by the administrator";
            $notificatinModel->addprojectNotification($user_id, $id, $message);
        }

        return true;
    }

    public function markascompletedProject($id)
    {
        $query = "UPDATE `projects` p SET `status`='1' WHERE p.Id = $id";
        $this->db->query($query);
        $sql = "SELECT p.Quotation_Id, p.Project_Name FROM `projects` p WHERE p.Id = $id";
        $qoutationId = $this->db->query($sql)->getResultArray();
        $QuotationId =  $qoutationId[0]['Quotation_Id'];
        $projectName =  $qoutationId[0]['Project_Name'];
        $sql = "SELECT q.Client_Id FROM `quotations` q WHERE q.Id = $QuotationId";
        $ClientId = $this->db->query($sql)->getResultArray();
        $clientid =  $ClientId[0]['Client_Id'];
        $notificatinModel = new \App\Models\NotificationModel();
        $sql = "SELECT c.user_id,c.Name FROM `clients` c WHERE c.Id = $clientid";
        $UserId = $this->db->query($sql)->getResultArray();
        $user_id =  $UserId[0]['user_id'];
        $clientname =  $UserId[0]['Name'];
        if (current_userRole()->name == 'Admin') {
            if ($user_id != '') {
                $notificatinModel = new \App\Models\NotificationModel();
                $message = "Your project" . $projectName . " has been mark as comleted by admin";
                $notificatinModel->addprojectNotification($user_id, $id, $message);
            }
        } else {

            $message = "" . $clientname . " mark " . $projectName . " as completed";
            $notificatinModel->addprojectNotificationwithoutUserId($id, $message);
        }
    }

    public function addfiles($id, $data)
    {
        $project_file = $data['projectfile'];
        if (!empty($project_file)) {
            $project_file = join(',', $project_file);
        }

        $project_file_link = $data['projectfilelink'];
        $query = "UPDATE `projects` SET `admin_uploaded_file`='$project_file',`admin_file_link`='$project_file_link' WHERE Id = $id";
        if ($this->db->query($query)) {
            return true;
        } else {
            return false;
        }
    }
}
