<?php
namespace App\Controllers;
class Notification extends BaseController
{
    private $auth = null;
    public function __construct()
    {
        $this->auth = service("auth");
    }
    public function index()
    {
        $notificationModel = new \App\Models\NotificationModel();
        
        if ($this->auth->getUserRole()->name=="Admin") {
            $data = [
                'notification'=> $notificationModel->getAdminNotification()
            ];
        }
        if ($this->auth->getUserRole()->name=="Client") {
            $user_id = session()->get('user_id');
            $data = [
                'notification'=> $notificationModel->getUserNotification($user_id)
            ];
        }
        if ($this->auth->getUserRole()->name=="Employee") {
            $user_id = session()->get('user_id');
            $data = [
                'notification'=> $notificationModel->getUserNotification($user_id)
            ];
        }
        
        return view("Notification/index",$data);
    }

    public function refresh_notifications() {
        if(current_userRole()->name == 'Admin'){
            $unread_notifications = unreadAdminNotification()[0]['unreadNotification'];
        }
           
        if(current_userRole()->name == 'Client' || current_userRole()->name == 'Employee'){
            $unread_notifications = unreadUserNotification()[0]['unreadNotification'];
        }
        
        return json_encode($unread_notifications);
    }
}
