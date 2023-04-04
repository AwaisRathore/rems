<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\ClientModel;

class Profile extends BaseController
{
    private $userModel = null;
    private $roleModel = null;
    private $auth = null;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->auth = service("auth");
    }
    public function index()
    {
        
        $users = $this->userModel->readAll();
        if($this->request->getMethod()=='post'){
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
                'id' => $this->request->getPost('id'),
                'profile_image' => $image_full_name
            ];
            if ($this->userModel->updateProfile($data)) {
                return redirect()->to("Profile/index");
            } else {
                return redirect()->back()->with('errors', $this->userModel->errors())->with('warning', "Please fix the errors");
            }
        }
        return view(
            'Profile/index',
            [
                "user" => $this->auth->getCurrentUser(),
            ]
        );
    }
    

}
