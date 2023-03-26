<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class CommentsModel extends Model
{
    protected $table = 'comments';
    protected $allowedFields = ['comment','user_id','project_id','RFI','parentComment_id'];


    public function getCommentsbyId($id)
    {
        $query = "SELECT c.id, c.comment,c.user_id, c.parentComment_id, c.RFI, c.project_id, c.created_at, u.username, u.profile_image
        FROM comments c
        JOIN users u ON u.id = c.user_id
          WHERE project_id = $id
          ORDER BY created_at DESC;
          ";
        $comments = $this->db->query($query)->getResultArray();
        return $comments;
    }
    public function getascCommentsbyId($id)
    {
        $query = "SELECT c.id, c.comment,c.user_id, c.parentComment_id, c.RFI, c.project_id, c.created_at, u.username, u.profile_image
        FROM comments c
        JOIN users u ON u.id = c.user_id
        WHERE project_id = $id
        ORDER BY created_at asc;";
        $comments = $this->db->query($query)->getResultArray();
        return $comments;
    }


     
}
