<?php 

if(!function_exists('dispalyPermissionsIcons')){
function dispalyPermissionsIcons($permission){
    if ($permission){
        return '
            <td class="text-primary">
            <i class="bx bx-check bx-md"></i>
            </td>';
    } else{
        return ' <td class="text-danger">
        <i class="bx bx-x bx-md"></i>
        </td>';
    }
}
}

function noOfNotqouted(){
    $quotationModel = new \App\Models\QuotationModel();
    $notQoutedcount = count($quotationModel->getAllNotQoutedQuotation());

    return $notQoutedcount;
}

function unreadAdminNotification(){
    $notificationModel = new \App\Models\NotificationModel();
    $adminUnreadNotification = $notificationModel->getCountAdminNotification();
    return $adminUnreadNotification;
}

function unreadUserNotification(){
    $notificationModel = new \App\Models\NotificationModel();
    $user_id = session()->get('user_id');
    $userUnreadNotification = $notificationModel->getCountNotificationbyuserid($user_id);

    return $userUnreadNotification;
}
