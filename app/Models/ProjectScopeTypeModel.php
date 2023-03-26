<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ProjectScopeTypeModel extends Model
{
    protected $table = 'projectscopetypes';
    public function getAllProjectScopeType()
    {
        $query = "SELECT * FROM `projectscopetypes`";
        $projects = $this->db->query($query)->getResultArray();
        return $projects;
    }
    public function getProjectScopeTypeById($Id)
    {
        $query = "SELECT * FROM `projectscopetypes` WHERE Id=".$Id;
        $projecttype = $this->db->query($query)->getRowArray();
        return $projecttype;
    }

    public function insertType($data)
    {
        $types = explode(",",$data);
        foreach ($types as $type) {
            $this->db->query("INSERT INTO `projectscopetypes`(`Type_Names`) VALUES ('$type')");
        }
    }
    public function updateProjectScopeTypeById($ProjectType,$Id)
    {
        $query ="UPDATE `projectscopetypes` SET `Type_Names`='$ProjectType' WHERE Id=".$Id;
        $this->db->query($query);
    }
    public function deleteProjectScopeType($Id)
    {
        $query ="DELETE FROM `projectscopetypes` WHERE Id=".$Id;
        $this->db->query($query);
    }
}
