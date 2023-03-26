<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notification';

    public function getAdminNotification()
    {
        $query = "SELECT * FROM `notification` n WHERE n.user_id is Null ORDER by n.created_at DESC";
        $notification = $this->db->query($query)->getResultArray();
        return $notification;
    }
    public function getUserNotification($user_id)
    {
        $query = "SELECT * FROM `notification` n WHERE n.user_id = $user_id ORDER by n.created_at DESC";
        $notification = $this->db->query($query)->getResultArray();
        return $notification;
    }
    public function getCountAdminNotification()
    {
        $query = "SELECT COUNT(id) as unreadNotification FROM `notification` n WHERE n.user_id is Null and n.status = 0 ORDER by n.created_at DESC";
        $unreadnotification = $this->db->query($query)->getResultArray();
        return $unreadnotification;
    }
    public function getCountNotificationbyuserid($id)
    {
        $query = "SELECT COUNT(id) as unreadNotification FROM `notification` n WHERE n.user_id = $id and n.status = 0 ORDER by n.created_at DESC";
        $unreadnotification = $this->db->query($query)->getResultArray();
        return $unreadnotification;
    }
    public function addqoutationNotification($qoutationid,$message,$user_id)
    {
        $query = "INSERT INTO `notification`( `message`,`user_id`, `qoutation_id`) VALUES ('$message','$user_id','$qoutationid')";
        $this->db->query($query);
    }
    public function addqoutationNotificationwithoutuserid($qoutationid,$message)
    {
        $query = "INSERT INTO `notification`( `message`, `qoutation_id`) VALUES ('$message','$qoutationid')";
        $this->db->query($query);
    }
    public function updatedstatus($id,$user_id)
    {
        // dd($user_id);
        if($user_id === null){
            $query = "UPDATE `notification` n SET n.`status`='1' where n.qoutation_id = $id and n.user_id is NULL";
        }else{
            $query = "UPDATE `notification` n SET n.`status`='1' where n.qoutation_id = $id and n.user_id = $user_id";
        }
        $this->db->query($query);
    }
    public function updatedprojectstatus($projectid,$user_id)
    {
        if($user_id === null){
            $query = "UPDATE `notification` n SET n.`status`='1' where n.project_id = $projectid and n.user_id is NULL";
            $this->db->query($query);
        }else{
            $query = "UPDATE `notification` n SET n.`status`='1' where n.project_id = $projectid and n.user_id = $user_id";
            $this->db->query($query);
        }
        
    }

    public function addprojectNotification($userid,$projectid, $message){
        $query = "INSERT INTO `notification`( `message`, `user_id`, `project_id`) VALUES ('$message','$userid','$projectid')";
        $this->db->query($query);
    }
    public function addprojectNotificationwithoutUserId($projectid, $message){
        $query = "INSERT INTO `notification`( `message`,  `project_id`) VALUES ('$message','$projectid')";
        $this->db->query($query);
    }
    
   
}
