<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id','username', 'profile_image', 'password', 'email', 'role_id'];
    protected $returnType    = \App\Entities\User::class;
    protected $beforeInsert = ['hashPassword'];

    protected $validationRules    = [
        'username' => 'required',
        'role_id' => 'required',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[8]',
    ];
    protected $validationMessages = [
        'Username' => [
            'required' => 'User is required.'
        ],
        'role_id' => [
            'required' => 'Role is required.'
        ],
        'email'  => [
            'required' => 'Email Address is required.',
            'valid_email' => 'Email address is invalid.',
            'is_unique' => 'Sorry. That email has already been taken. Please choose another.',
        ],
        'password' => [
            'required' => 'Password is required.',
            'min_length[8]' => 'Password must be atleast 8 characters long.'
        ],
    ];

    public function findUserByEmail($email)
    {
        $user = $this->where('email', $email)->first();
        return $user;
    }

    public function addUser($data)
    {
        $name = $data['username'];
        $email = $data['email'];
        $this->db->transStart();
        $userId = $this->insert($data, true);

        $this->db->query("INSERT INTO `clients`(`Name`, `Email_Address`, `user_id`) VALUES ('$name','$email','$userId')");
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            return false;
        }
        return true;
    }

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        unset($data['data']['Password']);
        return $data;
    }


    public function readall(){
        $query = "SELECT u.id,u.username,u.email,u.password,u.profile_image,r.name FROM `users` u JOIN roles r on r.id = u.role_id;";
        $result =  $this->db->query($query)->getResultArray();
        return $result;
    }
    public function readallemployeesandAdmin(){
        $query = "SELECT u.*,r.name FROM `users` u JOIN roles r on r.id = u.role_id WHERE r.name != 'Client';";
        $result =  $this->db->query($query)->getResultArray();
        return $result;
    }
    // query to select the user that are assign on project
    // SELECT u.*,r.name FROM `users` u JOIN roles r on r.id = u.role_id JOIN assignproject a on u.id = a.user_id WHERE r.name != 'Client' and a.project_id = 48;
    public function updatePassword($id, $password)
    {
        // dd($password,$id);
        $sql = "UPDATE users SET `password` = '{$password}' WHERE Id = $id";
        $result =  $this->db->query($sql);
        return $result;
    }

    public function setLinkExpiration($email, $token)
    {
        return $this->db->table('users')
            ->set('users.tokenExpired', date('Y-m-d H:i:s'))
            ->set('users.usertoken', $token)
            ->where('users.email', $email)
            ->update();
    }

    public function verifyToken($token)
    {
        $result =  $this->db->table('users')
            ->select('*')
            ->where('users.usertoken', $token)
            ->get()
            ->getResultArray();
        return $result;
    }
    public function checkTokenExpiry($tokenTime)
    {
        $tokenGenTime = strtotime($tokenTime);
        $currentTime = time();
        $timeDiff = $currentTime - $tokenGenTime;
        if ($timeDiff < 900) {
            return true;
        } else {
            return false;
        }
    }

}
