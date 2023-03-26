<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'clients';
    protected $allowedFields =['Name','Email_Address','user_id'];

    public function getAllClients()
    {
        $query = "SELECT c.*,ct.Type FROM `clients` c left join `clienttype` ct on ct.Id= c.Client_Type";
        $clients = $this->db->query($query)->getResultArray();
        return $clients;
    }
    public function getClientbyUserId($id)
    {
        $query = "SELECT c.Id FROM `clients` c where c.user_id = $id";
        $clients = $this->db->query($query)->getResultArray();
        return $clients;
    }
    public function insertClient($ClientData)
    {   $ClientName = $ClientData['Client_Name'];
        $Email_Address = $ClientData['Email_Address'];
        $Phone_Number = $ClientData['Phone_Number'];
        $Client_Type = $ClientData['Client_Type'];
        if(is_null($Client_Type))
        {
            $query = "INSERT INTO `clients`(`Name`, `Email_Address`, `Phone_Number`) VALUES ('$ClientName','$Email_Address','$Phone_Number')";
        }
        else
        {
            $query = "INSERT INTO `clients`(`Name`, `Email_Address`, `Phone_Number`, `Client_Type`) VALUES ('$ClientName','$Email_Address','$Phone_Number',$Client_Type)";
        }
        $this->db->query($query);
    }
    public function getClientsById($Id)
    {
        $query = "SELECT * FROM `clients` WHERE Id=".$Id;
        $client = $this->db->query($query)->getRowArray();
        return $client;
    }

    public function updateClientById($Id,$Data)
    {
        $Name = $Data['Client_Name'];
        $Email_Address = $Data['Email_Address'];
        $Phone_Number = $Data['Phone_Number'];
        $Client_Type= $Data['Client_Type'];
        $query ="UPDATE `clients` SET `Name`='$Name',`Email_Address`='$Email_Address',`Phone_Number`='$Phone_Number',`Client_Type`='$Client_Type' WHERE Id=".$Id;
        $this->db->query($query);
    }
    public function deleteClient($Id)
    {
        $query ="DELETE FROM `clients` WHERE Id=".$Id;
        $this->db->query($query);
    }
}
