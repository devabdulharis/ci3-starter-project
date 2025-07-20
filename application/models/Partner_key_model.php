<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_key_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all partners with their keys
     */
    public function get_all_partners_with_keys() {
        $this->db->select('partner.*, `keys`.id as key_id, `keys`.`key`, `keys`.ip_addresses, `keys`.date_created');
        $this->db->from('partner');
        $this->db->join('`keys`', 'partner.user_id = `keys`.user_id', 'left');
        return $this->db->get()->result_array();
    }

    /**
     * Get single partner with key
     */
    public function get_partner_with_key($user_id) {
        $this->db->select('partner.*, `keys`.id as key_id, `keys`.`key`, `keys`.ip_addresses, `keys`.date_created');
        $this->db->from('partner');
        $this->db->join('`keys`', 'partner.user_id = `keys`.user_id', 'left');
        $this->db->where('partner.user_id', $user_id);
        return $this->db->get()->row_array();
    }

    /**
     * Create new partner with key
     */
    public function create_partner_with_key($partner_data, $key_data = null) {
        $this->db->trans_start();

        // Set timestamps
        $now = date('Y-m-d H:i:s');
        $partner_data['created_at'] = $now;
        $partner_data['updated_at'] = $now;

        // Insert partner
        $this->db->insert('partner', $partner_data);
        $user_id = $this->db->insert_id();

        // If key data provided, insert key
        if ($key_data !== null) {
            $key_data['user_id'] = $user_id;
            $key_data['date_created'] = time(); // Current timestamp
            $this->db->insert('`keys`', $key_data);
        }

        $this->db->trans_complete();

        return $this->db->trans_status() ? $user_id : false;
    }

    /**
     * Update partner and key
     */
    public function update_partner_with_key($user_id, $partner_data, $key_data = null) {
        $this->db->trans_start();

        // Update partner
        $partner_data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('user_id', $user_id);
        $this->db->update('partner', $partner_data);

        // Update or insert key
        if ($key_data !== null) {
            // Check if key exists
            $this->db->where('user_id', $user_id);
            $existing_key = $this->db->get('`keys`')->row();

            if ($existing_key) {
                $this->db->where('user_id', $user_id);
                $this->db->update('`keys`', $key_data);
            } else {
                $key_data['user_id'] = $user_id;
                $key_data['date_created'] = time();
                $this->db->insert('`keys`', $key_data);
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * Delete partner and associated key
     */
    public function delete_partner_with_key($user_id) {
        $this->db->trans_start();

        // Delete key first
        $this->db->where('user_id', $user_id);
        $this->db->delete('`keys`');

        // Then delete partner
        $this->db->where('user_id', $user_id);
        $this->db->delete('partner');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * Generate API key
     */
    public function generate_key() {
        do {
            // Generate a random key
            $key = bin2hex(random_bytes(20)); // 40 characters
            
            // Check if key exists
            $this->db->where('key', $key);
            $exists = $this->db->get('`keys`')->num_rows();
        } while ($exists > 0);

        return $key;
    }
}