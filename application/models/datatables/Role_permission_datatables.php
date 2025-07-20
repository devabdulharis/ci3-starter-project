<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_permission_datatables extends CI_Model {

    public function get_roles_permissions($role_id) {
        return $this->db->query("SELECT r.id AS role_id, r.name AS role_name, r.display_name AS role_display_name, p.id AS permission_id, p.name AS permission_name, p.display_name AS permission_display_name, CASE WHEN pr.role_id IS NOT NULL THEN 'true' ELSE 'false' END AS permission_status FROM roles r CROSS JOIN permissions p LEFT JOIN permission_roles pr ON r.id = pr.role_id AND p.id = pr.permission_id WHERE r.id = ".$role_id." ORDER BY r.id, p.id")->result();
    }
    
}