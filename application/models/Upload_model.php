<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($postdata, $table = NULL) {
        if ($table == NULL) {
            $this->db->insert('uploads', $postdata);
        } else {
            $this->db->insert($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update($postdata, $where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->update('uploads', $postdata);
        } else {
            $result = $this->db->update($table, $postdata);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function delete($where_array = NULL, $table = NULL) {
        $this->db->where($where_array);
        if ($table == NULL) {
            $result = $this->db->delete('uploads');
        } else {
            $result = $this->db->delete($table);
        }
        //echo $this->db->last_query(); die();
        return $result;
    }

    function get_rows($id = NULL, $limit = NULL, $offset = NULL) {
        $result = array();
        $this->db->select('t1.*,t2.user_email');
        $this->db->join('users as t2', 't2.id = t1.pagecontent_user_id', 'left');
        if ($id) {
            $this->db->where('t1.id', $id);
        }
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get('uploads as t1');
        #print_r($this->db->last_query());
        $num_rows = $query->num_rows();
        $result = $query->result_array();
        //$this->create_tree_array($result);
        return array('num_rows' => $num_rows, 'data_rows' => $result);
    }

    function get_pagecontent_type() {
        $data = array(
            '' => 'Select',
            'page' => 'Page',
            'post' => 'Post',
            'review' => 'Review',
            'comment' => 'Comments'
        );
        return $data;
    }

    public function insert_file($filename, $title) {
        $data = array(
            'filename' => $filename,
            'title' => $title
        );
        $this->db->insert('files', $data);
        return $this->db->insert_id();
    }

    public function get_files() {
        return $this->db->select()
                        ->from('files')
                        ->get()
                        ->result();
    }

}
