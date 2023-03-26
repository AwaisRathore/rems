<?php

namespace App\Controllers;

use function PHPUnit\Framework\isNull;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class ClientProject extends BaseController
{
    private $auth = null;
    public function __construct()
    {
        $this->auth = service("auth");
    }
    public function index()
    {
        if (!$this->auth->getUserRole()->CanViewClientProject) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }

        $clientModel = new \App\Models\ClientModel();
        $projectModel = new \App\Models\ProjectModel();
        $ProgressModel = new \App\Models\ProgressModel();
        $ProjectScopeModel = new \App\Models\ProjectScopeModel();
        $userModel = new \App\Models\UserModel();
        $ClientsData = $clientModel->getAllClients();



        $user_id = session()->get('user_id');
        $role_id = session()->get('role_id');
        if ($role_id == 5) {
            $curentloginclient = $clientModel->getClientbyUserId($user_id);
            $clientId = $curentloginclient[0]['Id'];
            $data = [
                'ProjectScopes' => $ProjectScopeModel->getProjectScopesforproject(),
                'clientproject' => $projectModel->getProjectsByClientId($clientId),
                'assignproject' => $projectModel->getassignProject(),
                'totalprojectprogress' => $ProgressModel->totalprojectprogress(),
            ];
        } else if ($role_id == 2) {
            $data = [
                'ProjectScopes' => $ProjectScopeModel->getProjectScopesforproject(),
                'clientproject' => $projectModel->getProjectsByEmployeesId($user_id),
                'totalprojectprogress' => $ProgressModel->totalprojectprogress(),
                'assignproject' => $projectModel->getassignProject()
            ];
        } else {
            $data = [
                'ProjectScopes' => $ProjectScopeModel->getProjectScopesforproject(),
                'clientproject' => $projectModel->getAllClientProjects(),
                'totalprojectprogress' => $ProgressModel->totalprojectprogress(),
                'assignproject' => $projectModel->getassignProject()
            ];
        }
        // dd($data);
        return view("ClientProject/index", $data);
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddClientProject) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }

        $user_id = session()->get('user_id');
        // dd($user_id);
        $clientModel = new \App\Models\ClientModel();
        $ProjectScopeModel = new \App\Models\ProjectScopeModel();
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $projectModel = new \App\Models\ProjectModel();
        $types = $clientTypeModel->getAllClientType();
        $ClientsData = $clientModel->getAllClients();
        $curentloginclient = $clientModel->getClientbyUserId($user_id);
        // dd($curentloginclient);
        $ProjectScopes = $ProjectScopeModel->getAllProjectScopes();
        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);
            $Data_Projects = array();
            $i = 1;
            // dd($this->request->getPost("project-name-'.$i.'"));
            while (true) {
                if (empty($this->request->getPost("project-name-" . $i . ""))) {
                    break;
                } else {

                    $file_full_name = array();
                    $files = $this->request->getFileMultiple("project_file_" . $i . "");
                    if (!empty($files[0]->getname())) {
                        $filedir = 'public/assets/projectfile/';
                        $file_full_name = [];
                        foreach ($files as $file) {
                            if ($file->move(ROOTPATH . $filedir, $file->getRandomName())) {
                                array_push(
                                    $file_full_name,
                                    $filedir . $file->getName()
                                );
                            }
                        }
                    }
                    // dd($file_full_name);
                    $Data_Projects['project-' . $i . ''] = array(
                        'project-name' => $this->request->getPost("project-name-" . $i . ""),
                        'delivery-date' => $this->request->getPost("delivery_date_" . $i . ""),
                        'project_scope' => $this->request->getPost("project-scope-" . $i . ""),
                        'project_file' => $file_full_name,
                        'project_file_link' => $this->request->getPost("project_file_link_" . $i . ""),
                        'project-type' => $this->request->getPost("project-type-" . $i . ""),
                        'notes' => $this->request->getPost("notes-" . $i . ""),
                    );
                }
                $i++;
            }
            $clientid = $this->request->getPost("client_id");
            $projectModel->addNewProject($Data_Projects, $clientid);
            // if(){
            return redirect()->to("ClientProject/index");
            // }
        }

        return view("ClientProject/new", ["ProjectScopes" => $ProjectScopes, "currentclient" => $curentloginclient]);
    }

    public function assignProject()
    {
        $projectModel = new \App\Models\ProjectModel();
        $data = [
            'projectid' => $this->request->getPost('projectid'),
            'users' => $this->request->getPost('assign-user'),
            'CanViewFile' => $this->request->getPost('CanViewFile'),
            'CanViewFileUrl' => $this->request->getPost('CanViewFileUrl'),
        ];
        // dd($data);
        $projectModel->assignProject($data);

        return redirect()->back();
    }

    public function getusersforassignproject()
    {
        $id = $this->request->getPost('projectid');
        $projectModel = new \App\Models\ProjectModel();
        $data['allusers'] = $projectModel->getFilteredUsersForAProject($id);
        return $this->response->setJSON($data);
    }

    public function view($id)
    {
        $user_id = session()->get('user_id');
        $projectModel = new \App\Models\ProjectModel();
        $progressModel = new \App\Models\ProgressModel();
        $ProjectScopeModel = new \App\Models\ProjectScopeModel();
        $commentsModel = new \App\Models\CommentsModel();


        if ($this->auth->getUserRole()->name == 'Employee') {
            $assignEmployees = $projectModel->getassignProject();
            $ass_employee = array();
            foreach ($assignEmployees as $as_value) {
                if ($as_value['project_id'] == $id) {
                    array_push($ass_employee, $as_value['user_id']);
                }
            }
            if (!in_array($user_id, $ass_employee)) {
                return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
            }
        }

        $data = [
            'project' => $projectModel->getAllClientProjectsbyID($id),
            'assignusers' => $projectModel->getassignUserbyProjectId($id),
            'countassignusers' => $projectModel->getCountassignUserbyProjectId($id),
            'projectscope' => $ProjectScopeModel->getProjectScopesByProjectId($id),
            'comments' => $commentsModel->getCommentsbyId($id),
            'subcomments' => $commentsModel->getascCommentsbyId($id),
            'progress' => $progressModel->projectProgress($id),
            'employeeprogress' => $progressModel->projectProgressbyemployeeId($id, $user_id),
            'worklog' => $progressModel->readallbyprjectId($id, $user_id),
            'progressFile' => $progressModel->getAllprogressfile($id),
            'totalprojectprogress' => $progressModel->totalprojectprogress(),
            'allworks' => $progressModel->getProjectsprogressById($id),
        ];
        // dd($data);
        return view("ClientProject/view", $data);
    }



    public function deleleAssignUser($Projectid)
    {
        $projectModel = new \App\Models\ProjectModel();
        $id = $this->request->getGet('delete_id');
        if ($projectModel->deleteassignUser($id, $Projectid)) {
            $output = array('status' => 'Assign Member deleted Sucessfully');
            return $this->response->setJSON($output);
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        if (!$this->auth->getUserRole()->CanEditClientProject) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $user_id = session()->get('user_id');
        // dd($user_id);
        $clientModel = new \App\Models\ClientModel();
        $ProjectScopeModel = new \App\Models\ProjectScopeModel();
        $clientTypeModel = new \App\Models\ClientTypeModel();
        $projectModel = new \App\Models\ProjectModel();
        $types = $clientTypeModel->getAllClientType();
        $ClientsData = $clientModel->getAllClients();
        $curentloginclient = $clientModel->getClientbyUserId($user_id);
        $ProjectScopes = $ProjectScopeModel->getAllProjectScopes();
        $previousScopes = $ProjectScopeModel->getProjectScopesByProjectId($id);
        $project = $projectModel->find($id);
        if ($this->request->getPost('submit')) {
            $i = 1;
            while (true) {
                if (empty($this->request->getPost("project-name-" . $i . ""))) {
                    break;
                } else {

                    $file_full_name = array();
                    $files = $this->request->getFileMultiple("project_file_" . $i . "");
                    if (!empty($files[0]->getname())) {
                        $previous_file = $this->request->getPost("previous_file");
                        $filedir = 'public/assets/projectfile/';
                        $file_full_name = [];
                        foreach ($files as $file) {
                            if ($file->move(ROOTPATH . $filedir, $file->getRandomName())) {
                                array_push(
                                    $file_full_name,
                                    $filedir . $file->getName()
                                );
                            }
                        }
                        $file_full_name = array_merge($file_full_name, $previous_file);
                    } else {
                        $file_full_name = $this->request->getPost("previous_file");
                        // dd($file_full_name);
                    }
                    // dd($file_full_name);
                    $Data_Projects['project-' . $i . ''] = array(
                        'project-name' => $this->request->getPost("project-name-" . $i . ""),
                        'delivery-date' => $this->request->getPost("delivery_date_" . $i . ""),
                        'project_scope' => $this->request->getPost("project-scope-" . $i . ""),
                        'project_file' => $file_full_name,
                        'project_file_link' => $this->request->getPost("project_file_link_" . $i . ""),
                        'project-type' => $this->request->getPost("project-type-" . $i . ""),
                        'notes' => $this->request->getPost("notes-" . $i . ""),
                    );
                }
                $i++;
            }

            $projectModel->EditProject($Data_Projects, $id);

            return redirect()->to("ClientProject/index");
        }
        return view('ClientProject/edit', ["ProjectScopes" => $ProjectScopes, "currentclient" => $curentloginclient, "project" => $project, 'previousScopes' => $previousScopes]);
    }

    public function deleteproject()
    {
        if (!$this->auth->getUserRole()->CanDeleteClientProject) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $projectModel = new \App\Models\ProjectModel();
        $id = $this->request->getGet('delete_id');
        if ($projectModel->deleteProject($id)) {
            $output = array('status' => 'Project deleted Sucessfully');
            return $this->response->setJSON($output);
        }
    }

    public function newComment($id)
    {
        $commentModel = new \App\Models\CommentsModel();
        $notificationModel = new \App\Models\NotificationModel();
        $user_id = session()->get('user_id');
        $rfi = $this->request->getPost("RFI");
        if ($rfi == null) {
            $data = [
                'comment' => $this->request->getPost("comment"),
                'project_id' => $id,
                'user_id' => $user_id,
            ];
        } else {
            $data = [
                'comment' => $this->request->getPost("comment"),
                'project_id' => $id,
                'user_id' => $user_id,
                'RFI' => $this->request->getPost("RFI")
            ];
        }
        $username = current_user()->username;
        $projectname = $this->request->getPost("project_name");
        $clientId = $this->request->getPost("clientname");
        if ($commentModel->insert($data)) {
            $message = "{$username} posted a comment on {$projectname}";
            $notificationModel->addprojectNotificationwithoutUserId($id, $message);
            $notificationModel->addprojectNotification($clientId, $id, $message);
            return redirect()->back();
        }
    }

    public function replyComment($projectid, $comment_id)
    {
        $commentModel = new \App\Models\CommentsModel();
        $notificationModel = new \App\Models\NotificationModel();
        $user_id = session()->get('user_id');
        // dd($comment_id);
        $data = [
            'comment' => $this->request->getPost("commentreply"),
            'project_id' => $projectid,
            'user_id' => $user_id,
            'parentComment_id' => $comment_id,
        ];
        // dd($data);
        $username = current_user()->username;
        $projectname = $this->request->getPost("project_name");
        $clientId = $this->request->getPost("clientname");

        if ($commentModel->insert($data)) {
            $message = "{$username} is add reply on {$projectname}";
            $notificationModel->addprojectNotificationwithoutUserId($projectid, $message);
            $notificationModel->addprojectNotification($clientId, $projectid, $message);
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function deleteComment()
    {
        $commentModel = new \App\Models\CommentsModel();
        $id = $this->request->getGet('delete_id');
        $commentModel->delete($id);
        $output = array('status' => 'Comment deleted Sucessfully');
        return $this->response->setJSON($output);
    }

    public function EditComment($id)
    {
        $commentModel = new \App\Models\CommentsModel();
        $rfi = $this->request->getPost("RFI");
        if ($rfi == null) {
            $data = [
                'comment' => $this->request->getPost("commentreply"),
                'RFI' => 0
            ];
        } else {
            $data = [
                'comment' => $this->request->getPost("commentreply"),
                'RFI' => $this->request->getPost("RFI")
            ];
        }
        $commentModel->update($id, $data);
        return redirect()->back();
    }

    public function rejectProject($id)
    {
        $user_id = session()->get('user_id');
        $projectModel = new \App\Models\ProjectModel();
        $review =  $this->request->getPost("review");
        $projectModel->rejectProject($id, $user_id, $review);
        return redirect()->back();
    }
    public function acceptProject($id)
    {
        $user_id = session()->get('user_id');
        $projectModel = new \App\Models\ProjectModel();
        $projectModel->acceptProject($id, $user_id);
        return redirect()->back();
    }

    public function deliverProject($id)
    {
        $projectModel = new \App\Models\ProjectModel();

        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);


            $filename = array();
            $files = $this->request->getFileMultiple("deliver_file");
            if (!empty($files[0]->getname())) {
                $filedir = 'public/assets/projectfile/';
                $filename = [];
                foreach ($files as $file) {
                    if ($file->move(ROOTPATH . $filedir, $file->getRandomName())) {
                        array_push(
                            $filename,
                            $filedir . $file->getName()
                        );
                    }
                }
            }

            $data = [
                'file' => $filename
            ];
            // dd($data);
            if ($projectModel->deliverProject($id, $data)) {
                return redirect()->back();
            } else {
                return redirect()->back()->withInput()->with('errors', $projectModel->errors())->with('warning', "Please fix the errors");
            }
        }
    }

    public function markascompletedProject($id)
    {
        $projectModel = new \App\Models\ProjectModel();
        $projectModel->markascompletedProject($id);
        return redirect()->back();
    }

    public function Addfiles($id)
    {
        $projectModel = new \App\Models\ProjectModel();
        $files = $this->request->getFileMultiple("project_file");
        if (!empty($files[0]->getname())) {
            $previous_file = $this->request->getPost("previous_file");
            $filedir = 'public/assets/projectfile/';
            $files_full_name = [];
            foreach ($files as $file) {
                if ($file->move(ROOTPATH . $filedir, $file->getRandomName())) {
                    array_push(
                        $files_full_name,
                        $filedir . $file->getName()
                    );
                }
            }
            $files_full_name = array_merge($files_full_name, $previous_file);
        } else {
            $files_full_name = $this->request->getPost("previous_file");
        }
        $data = [
            'projectfile' => $files_full_name,
            'projectfilelink' => $this->request->getPost("project_file_link"),
        ];

        if($projectModel->addfiles($id,$data)){
            return redirect()->back();
        }

    }
}
