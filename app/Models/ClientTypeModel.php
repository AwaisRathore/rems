<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ClientTypeModel extends Model
{
    protected $table = 'clienttype';
    public function getAllClientType()
    {
        $query = "SELECT * FROM `clienttype`";
        $clients = $this->db->query($query)->getResultArray();
        return $clients;
    }

    public function getClientTypeById($Id)
    {
        $query = "SELECT * FROM `clienttype` WHERE Id=".$Id;
        $clienttype = $this->db->query($query)->getRowArray();
        return $clienttype;
    }

    public function insertType($Type)
    {
        if(!empty($Type)){
            $Type = addslashes($Type);
        }
        
        $query = "INSERT INTO `clienttype` (`Type`) VALUES ('$Type')";
        $this->db->query($query);

    }
    public function updateClientType($ClientType,$Id)
    {
        if(!empty($ClientType)){
            $ClientType = addslashes($ClientType);
        }
        
        $query ="UPDATE `clienttype` SET `Type`='$ClientType' WHERE Id=".$Id;
        $this->db->query($query);
        return true;
    }
    public function deleteClient($Id)
    {
        $query ="DELETE FROM `clienttype` WHERE Id=".$Id;
        $this->db->query($query);
    }
}
