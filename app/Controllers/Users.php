<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\EmployeeTypeModel;

class Users extends BaseController
{
    private $userModel = null;
    private $roleModel = null;
    private $clientModel = null;
    private $employeeTypeModel = null;
    private $auth = null;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->clientModel = new ClientModel();
        $this->employeeTypeModel = new EmployeeTypeModel();
        $this->auth = service("auth");
    }
    public function index($role = "all")
    {
        if (!$this->auth->getUserRole()->CanViewUser) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }

        $users = $this->userModel->readAll();
        return view(
            'Users/index',
            [
                "users" => $users
            ]
        );
    }
    public function new()
    {
        if (!$this->auth->getUserRole()->CanAddUser) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $roles = $this->roleModel->findAll();
        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);

            $image = $this->request->getFile('profile_image');
            $image_full_name = 'public/assets/img/avatars/user-avator.png';
            if ($image != '') {
                $imagedir = 'public/assets/img/users/';
                if ($image->move(ROOTPATH . $imagedir, $image->getRandomName())) {
                    $image_full_name = $imagedir . $image->getName();
                }
            }
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role_id' => $this->request->getPost('role'),
                'profile_image' => $image_full_name
            ];

            $success_user = false;
            if ($this->request->getPost('role') == 5) {
                if ($this->userModel->addUser($data)) {
                    $success_user = true;
                    
                } else {
                    return redirect()->back()->withInput()->with('errors', $this->userModel->errors())->with('warning', "Please fix the errors");
                }
            } else {
                if ($this->userModel->insert($data)) {
                    $success_user = true;
                    return redirect()->to("Users/index")->with('success', 'Email Sent successfully to user.');
                } else {
                    return redirect()->back()->withInput()->with('errors', $this->userModel->errors())->with('warning', "Please fix the errors");
                }
            }


            // email for register user

            // if ($success_user) {
                
            //     $password = $this->request->getPost('password');
            //     $email = $this->request->getPost('email');
            //     $emailVariables = array();

            //     $emailVariables['logoImage'] = site_url('public/assets/img/optimizedtransparent_logo.png');
            //     $emailVariables['headicon'] = site_url('public/assets/img/icon/user.png');
               
            //     $emailVariables['email'] = $email;
            //     $emailVariables['password'] = $password;
            //     $emailVariables['sitelink'] = site_url();

            //     $emailVariables['facebookImage'] = site_url('public/assets/img/icon/fb.png');
            //     $emailVariables['linkedinImage'] = site_url('public/assets/img/linkedin.png');
            //     $emailVariables['facebooklink'] = 'https://www.facebook.com/remote.estimation/';
            //     $emailVariables['linkedinlink'] = 'https://www.linkedin.com/company/remoteestimationllc/';

            //     $to = $email;
            //     $message = file_get_contents(site_url('Users/registerUserEmailTemplate'));
            //     foreach ($emailVariables as $key => $value) {
            //         $message = str_replace('{{ ' . $key . ' }}', $value, $message);
            //     }

            //     $mailService = \Config\Services::email();
            //     $mailService->setTo($to);
            //     $mailService->setSubject('Register User');
            //     $mailService->setMessage($message);
            //     if ($mailService->send()) {
            //         return redirect()->to("Users/index")->with('success', 'Email Sent successfully to user.');
            //     } else {
            //         return redirect()->to("Users/index")->with('errors', 'Something went wrong. Email Not Send.');
            //     }
            // }
        }

        return view('Users/new', [
            "role" => $roles
        ]);
    }

    public function registerUserEmailTemplate(){
        return view('Email/registerUserEmailTemplate.html');
    }

    public function delete()
    {
        if (!$this->auth->getUserRole()->CanDeleteUser) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $id = $this->request->getGet('delete_id');
        if ($this->userModel->delete($id)) {
            $output = array('status' => 'Users deleted Sucessfully');
        }

        return $this->response->setJSON($output);
    }

    public function edit($id)
    {
        if (!$this->auth->getUserRole()->CanEditUser) {
            return redirect()->to("Home")->with('warning', "You do not have rights to perform this operation.");
        }
        $roles = $this->roleModel->findAll();
        $employeetype = $this->employeeTypeModel->findAll();
        $data = $this->userModel->find($id);
        if ($this->request->getMethod() == 'post') {
            helper(['form', 'url']);

            $image = $this->request->getFile('profile_image');

            if ($image != '') {
                $imagedir = 'public/assets/img/users/';
                if ($image->move(ROOTPATH . $imagedir, $image->getRandomName())) {
                    $image_full_name = $imagedir . $image->getName();
                }
            } else {
                $image_full_name = $this->request->getPost('imageurl');
            }
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'id' => $this->request->getPost('id'),
                'role_id' => $this->request->getPost('role'),
                'profile_image' => $image_full_name
            ];

            if ($this->userModel->update($id, $data)) {
                return redirect()->to("Users/index");
            } else {
                return redirect()->back()->with('errors', $this->userModel->errors())->with('warning', "Please fix the errors");
            }
        }
        return view("Users/edit", ["users" => $data, "role" => $roles,'employeetype'=> $employeetype]);
    }


    public function editemployeeAdditionalInfo($id)
    {
        if($this->request->getMethod() == 'post'){
            $data = [
                'salary' => $this->request->getPost('salary'),
                'join_date' => $this->request->getPost('join_date'),
                'description' => $this->request->getPost('description'),
                'EmployeeType' => $this->request->getPost('EmployeeType'),
            ];

            if($this->userModel->updateEmployeeAdditionalInfo($id , $data)){
                return redirect()->to("Users/index");
            }

        }
    }

}
