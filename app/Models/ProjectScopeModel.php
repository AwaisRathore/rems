<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ProjectScopeModel extends Model
{
    protected $table = 'projectscopes';

    public function getAllProjectScopes()
    {
        $query = "SELECT * FROM `projectscopetypes`";
        $ProjectScopes = $this->db->query($query)->getResultArray();
        return $ProjectScopes;
    }
    public function getProjectScopesById($Id)
    {
        $query = "SELECT ps.*,pst.Type_Names FROM `quotations` q  join `projects` p on p.Quotation_Id = q.Id join `projectscopes` ps on ps.Project_Id = p.Id join `projectscopetypes` pst on ps.ProjectScopeType = pst.Id where q.Id = ".$Id."";
        $ProjectScopes = $this->db->query($query)->getResultArray();
        return $ProjectScopes;
    }
    public function getProjectScopesByProjectId($Id)
    {
        $query = "SELECT pst.*,ps.* FROM projectscopetypes pst JOIN projectscopes ps on ps.ProjectScopeType = pst.Id where ps.Project_Id = $Id";
        $ProjectScopes = $this->db->query($query)->getResultArray();
        return $ProjectScopes;
    }
    public function getProjectScopesforproject()
    {
        $query = "SELECT ps.*,pst.Type_Names FROM `quotations` q  join `projects` p on p.Quotation_Id = q.Id join `projectscopes` ps on ps.Project_Id = p.Id join `projectscopetypes` pst on ps.ProjectScopeType = pst.Id";
        $ProjectScopes = $this->db->query($query)->getResultArray();
        return $ProjectScopes;
    }
}
