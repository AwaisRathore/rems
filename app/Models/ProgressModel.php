<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'projectprogress';
    protected $allowedFields = ['progress', 'start_time', 'end_time', 'file', 'description', 'project_id', 'user_id'];


    public function getProjectsprogressById($id)
    {
        $query = "SELECT p.*,u.username FROM `projectprogress` p JOIN users u on u.id = p.user_id WHERE p.project_id = $id order by p.id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if($r['file'] != null){
                $r['file'] = explode(',', $r['file']);
            }
           
        }
        return $result;
    }

    public function projectProgress($id)
    {
        $query = "SELECT MAX(p.progress) as max_progress FROM `projectprogress` p WHERE p.project_id = $id";
        $result = $this->db->query($query)->getRowArray();
        $max_progress = $result['max_progress'];
        return $max_progress;
    }
    public function projectProgressbyemployeeId($id,$user_id)
    {
        $query = "SELECT MAX(p.progress) as max_progress FROM `projectprogress` p WHERE p.project_id = $id and p.user_id = $user_id";
        $result = $this->db->query($query)->getRowArray();
        $max_progress = $result['max_progress'];
        
        return $max_progress;
    }
    public function readallbyprjectId($id,$user_id)
    {
        $query = "SELECT p.*,u.username FROM `projectprogress` p JOIN users u on u.id = p.user_id WHERE p.project_id = $id and p.user_id = $user_id order by p.id desc";
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if($r['file'] != null){
                $r['file'] = explode(',', $r['file']);
            }   
        }
        return $result;
    }

    public function getAllprogressfile($id){
        $query = "SELECT p.*,u.username FROM `projectprogress` p JOIN users u on u.id = p.user_id WHERE p.project_id = $id  order by p.id desc";
        
        $result = $this->db->query($query)->getResultArray();
        foreach ($result as &$r) {
            if($r['file'] != null){
                $r['file'] = explode(',', $r['file']);
            }
            
            
        }
        return $result;
    }
    public function totalprojectprogressbyid($id){
        $query = "SELECT AVG(max_progress) AS avg_max_progress
        FROM (
          SELECT user_id, MAX(progress) AS max_progress
          FROM projectprogress pp JOIN projects p on p.Id = pp.project_id WHERE pp.project_id = $id
          GROUP BY user_id
        ) AS max_progress_table;";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
    public function totalprojectprogress(){
        $query = "SELECT user_id, project_id, AVG(max_progress) AS avg_max_progress FROM (SELECT user_id, project_id, MAX(progress) AS max_progress FROM projectprogress GROUP BY user_id, project_id ) AS max_progress_table GROUP BY user_id, project_id;";
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }

    public function addprogress($data){

        $progress = $data['progress'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $project_id = $data['project_id'];
        $user_id = $data['user_id'];
        $description = $data['description'];
        $file = $data['file'];
        $file = join(',', $file);
        $query = "INSERT INTO `projectprogress`(`progress`, `start_time`, `end_time`, `file`, `description`, `project_id`, `user_id`) VALUES ('$progress','$start_time','$end_time','$file','$description','$project_id','$user_id')";
        $this->db->query($query);
        return true;
    }


}
