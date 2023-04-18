<?php

namespace App\Controllers;

class Login extends BaseController
{
    private $auth = null;
    public function __construct()
    {
        $this->auth = service('auth');
    }
    public function index()
    {

        if (!empty(session()->get('isLoggedIn'))) {
            return redirect()->to('/Home');
        }
        if ($this->request->getMethod() == 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            if ($this->auth->login($email, $password)) {
                $user = $this->auth->getCurrentUser();
                session()->set('user_data', $user);

                return redirect()->to("/Home");
            } else {
                return redirect()->back()->withInput()->with('warning', 'Invalid Email or Password');
            }
        }
        return view("Login/index");
    }
    public function logout()
    {
        $this->auth->logout();
        return redirect()->to('/');
    }
    public function forget()
    {
        if ($this->request->getMethod() == 'post') {
            $email = $this->request->getPost('email');
            $userModel = new \App\Models\UserModel();
            $user = $userModel->findUserByEmail($email);
            if ($user) {
                $token = md5(uniqid($email, true));
                $result = $userModel->setLinkExpiration($email, $token);
                if ($result) {

                   
                    $emailVariables = array();
                    
                    $emailVariables['logoImage'] = site_url('public/assets/img/optimizedtransparent_logo.png');
                    $emailVariables['headicon'] = site_url('public/assets/img/icons/lock.png');
                    $emailVariables['iconlink'] = site_url("public/assets/vendor/fonts/boxicons.css");
                    $emailVariables['passwordResetLink'] = site_url('Login/resetPassword/' . $token);
                    $emailVariables['username'] = $user->username;
                    
                    $emailVariables['facebookImage'] = site_url('public/assets/img/icons/fb.png');
                    $emailVariables['linkedinImage'] = site_url('public/assets/img/icons/linkedin.png');
                    $emailVariables['facebooklink'] = 'https://www.facebook.com/remote.estimation/';
                    $emailVariables['linkedinlink'] = 'https://www.linkedin.com/company/remoteestimationllc/';
                    
                    $to = $email;
                    $message = file_get_contents(site_url('Login/resetEmailTemplate'));
                    foreach ($emailVariables as $key => $value) {
                        $message = str_replace('{{ ' . $key . ' }}', $value, $message);
                    }


                    $mailService = \Config\Services::email();
                    $mailService->setTo($to);
                    $mailService->setSubject('Password Reset');
                    $mailService->setMessage($message);
                    if ($mailService->send()) {
                        return redirect()->to(current_url())->with('success', 'Password Reset Link Sent successfully. Please check your email.');
                    } else {
                        return redirect()->back()->with('errors', 'Something went wrong. Please try again.');
                    }
                }
            } else {
                return redirect()->back()->withInput()->with('warning', 'Invalid Email');
            }
        }



        return view("Login/forget");
    }

    public function resetPassword($token)
    {
        $userModel = new \App\Models\UserModel();
        if (!empty($token)) {
            $result = $userModel->verifyToken($token);
            if ($result) {
                $userId = $result[0]['id'];
                $isValid =  $userModel->checkTokenExpiry($result[0]['tokenExpired']);
                if ($isValid) {
                    if ($this->request->getMethod() == 'post') {
                        $rules = [

                            'Password' => [
                                'label' => 'Password',
                                'rules' => 'required|min_length[8]'
                            ],
                            'confirmPassword' => [
                                'label' => 'confirmPassword',
                                'rules' => 'required|matches[Password]'
                            ]

                        ];
                        if ($this->validate($rules)) {
                            $password = $this->request->getVar('Password');
                            $password_hash = password_hash($password, PASSWORD_DEFAULT);
                            $result = $userModel->updatePassword($userId, $password_hash);
                            if ($result) {
                                return redirect()->to('/')->with('success', 'Password changed successfully.');
                            } else {
                                return redirect()->back()->with('errors', 'Unable to update password.');
                            }
                        } else {
                            return redirect()->back()->with('errors', 'Invalid');
                        }
                    }
                } else {
                    return redirect()->to(current_url())->with('errors', 'Token expired. Please try again.');
                }
            } else {
                return redirect()->back()->with('errors', 'Invalid token. Please try again.');
            }
        } else {
            return redirect()->back()->with('errors', 'Token not found.');
        }
        return view('Login/reset_password');
    }

    public function resetEmailTemplate()
    {
        return view('Email/resetEmailTemplate.html');
    }

    public function changePassword()
    {

        $data = [];
        $auth = service("auth");
        $data['LoggedInUser'] =  $auth->getCurrentUser();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'opassword' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Old password is a required field.'
                    ]
                ],
                'npassword' => [
                    'rules' => 'required|min_length[8]',
                    'errors' => [
                        'required' => 'New password is a required field.',
                        'min_length' => 'New Password should be at least 8 characters long.'
                    ]
                ],
                'cpassword' => [
                    'rules' => 'required|matches[npassword]',
                    'errors' => [
                        'required' => 'Confirm password is a required field.',
                        'matches' => 'Confirm Password must match with the New Password.'
                    ]
                ],

            ];
            if ($this->validate($rules)) {
                $opwd = $this->request->getVar('opassword');
                $npwd = $this->request->getVar('npassword');
                // dd($opwd,$npwd);
                if (password_verify($opwd, $data['LoggedInUser']->password)) {
                    $npwd_Hash = password_hash($npwd, PASSWORD_DEFAULT);
                    //update user password here
                    $userModel = new \App\Models\UserModel();
                    $result = $userModel->updatePassword($data['LoggedInUser']->id, $npwd_Hash);
                    if ($result) {
                        return redirect()->to(current_url())->with("success", "Password updated successfully");
                    } else {
                        session()->setFlashdata('error', 'Sorry. We are facing some issue . Please try again later');
                    }
                } else {
                    session()->setFlashdata('error', 'Old password is incorrect');
                    return redirect()->to(current_url());
                }
            } else {
                session()->setFlashdata('error', 'Please fix the below errors');
                $data['validation'] = $this->validator;
            }
        }
        return view("Login/changepassword", $data);
    }
}
