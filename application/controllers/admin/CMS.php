<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {

    var $data;
    var $id;
    var $sess_user_id;

    function __construct() {
        parent::__construct();

        //Check if any user logged in else redirect to login
        $is_logged_in = $this->common_lib->is_logged_in();
        if ($is_logged_in == FALSE) {
			$this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect($this->router->directory.'user/login');
        }

        //Has logged in user permission to access this page or method?        
        $this->common_lib->check_user_role_permission(array(
            'default-super-admin-access',
            'default-admin-access'
        ));

        // Get logged  in user id
        $this->sess_user_id = $this->common_lib->get_sess_user('id');

        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements('admin');

        //add required js files for this controller
        $app_js_src = array(
            'assets/dist/js/'.$this->router->class.'.js', //create js file name same as controller name
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($app_js_src);

        
        $this->load->model('cms_model');
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
        $this->id = $this->common_lib->decode($this->uri->segment(4));
        $this->data['arr_content_type'] = $this->cms_model->get_pagecontent_type();

        //View Page Config
		$this->data['view_dir'] = 'admin/'; // inner view and layout directory name inside application/view		
        $this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Dashboard', '/admin');
		$this->breadcrumbs->push('CMS', '/admin/cms');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
		//Pagination
		 $this->load->library('pagination');
		
    }

    function index() {
        // Check user permission by permission name mapped to db
        // $is_granted = $this->common_lib->check_user_role_permission('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		
		$this->data['page_heading'] = 'Website CMS - Contents';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/index', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }
	
	function index_ci_pagination() {
        // Check user permission by permission name mapped to db
        // $is_granted = $this->common_lib->check_user_role_permission('cms-list-view');
			
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        // Display using CI Pagination: Total filtered rows - check without limit query. Refer to model method definition		
		$result_array = $this->cms_model->get_rows(NULL, NULL, NULL, FALSE, FALSE);
		$total_num_rows = $result_array['num_rows'];
		
		//pagination config
		$additional_segment = $this->router->directory.$this->router->class.'/index_ci_pagination';
		$per_page = 10;
		$config['uri_segment'] = 5;
		$config['num_links'] = 1;
		$config['use_page_numbers'] = TRUE;
		//$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(5)) ? ($this->uri->segment(5)-1) : 0;
		$offset = ($page*$per_page);
		$this->data['pagination_link'] = $this->common_lib->render_pagination($total_num_rows, $per_page, $additional_segment);
		//end of pagination config
        

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_rows(NULL, $per_page, $offset, FALSE, TRUE);
        $this->data['data_rows'] = $result_array['data_rows'];
		
		$this->data['page_heading'] = 'Website Contents (CI Pagination Version)';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/index_ci_pagination', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function render_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->cms_model->get_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->cms_model->get_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->cms_model->get_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $result['pagecontent_title'];
            $row[] = $result['pagecontent_type'];
            $row[] = word_limiter($result['pagecontent_text'], 20);
            $row[] = (strtolower($result['pagecontent_status']) == 'y') ? 'Published' : 'Unpublished';
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/'.$this->common_lib->encode($result['id'])), '<i class="fa fa-edit" aria-hidden="true"></i>', array(
                'class' => 'text-dark mr-1',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $this->common_lib->encode($result['id'])), '<i class="fa fa-trash" aria-hidden="true"></i>', array(
                'class' => 'text-danger btn-delete ml-1',
				'data-confirmation'=>true,
				'data-confirmation-message'=>'Are you sure, you want to delete this?',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Delete',
                'title' => 'Delete',
            ));

            $row[] = $action_html;
            $data[] = $row;
        }

        /* jQuery Data Table JSON format */
        $output = array(
            'draw' => isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '',
            'recordsTotal' => $total_rows,
            'recordsFiltered' => $total_filtered,
            'data' => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add() {
        //Check user permission by permission name mapped to db
        //$is_granted = $this->common_lib->check_user_role_permission('cms-add');        
		$this->breadcrumbs->push('Add','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_form_data('add') == true) {
                $postdata = array(
                    'pagecontent_type' => $this->input->post('pagecontent_type'),
                    'pagecontent_title' => $this->input->post('pagecontent_title'),
                    'pagecontent_text' => $this->input->post('pagecontent_text'),
                    'pagecontent_meta_keywords' => $this->input->post('pagecontent_meta_keywords'),
                    'pagecontent_meta_description' => $this->input->post('pagecontent_meta_description'),
                    'pagecontent_meta_author' => $this->input->post('pagecontent_meta_author'),
                );
                $insert_id = $this->cms_model->insert($postdata);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i>Added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
                    redirect($this->router->directory.$this->router->class.'/add');
                }
            }
        }
		$this->data['page_heading'] = 'Add Contents';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/add', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function edit() {
        //Check user permission by permission name mapped to db
        //$is_granted = $this->common_lib->check_user_role_permission('cms-edit');		
		$this->breadcrumbs->push('Edit','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_form_data('edit') == true) {
                $postdata = array(
                    'pagecontent_type' => $this->input->post('pagecontent_type'),
                    'pagecontent_title' => $this->input->post('pagecontent_title'),
                    'pagecontent_text' => $this->input->post('pagecontent_text'),
                    'pagecontent_meta_keywords' => $this->input->post('pagecontent_meta_keywords'),
                    'pagecontent_meta_description' => $this->input->post('pagecontent_meta_description'),
                    'pagecontent_meta_author' => $this->input->post('pagecontent_meta_author'),
                    'pagecontent_status' => $this->input->post('pagecontent_status'),
                    'pagecontent_archived' => $this->input->post('pagecontent_archived'),
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->cms_model->update($postdata, $where_array);
                if ($res) {
                    $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i>Updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->cms_model->get_rows($this->id);
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_heading'] = 'Edit Contents';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/edit', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function delete() {
        //Check user permission by permission name mapped to db
        //$is_granted = $this->common_lib->check_user_role_permission('cms-delete');

        $where_array = array('id' => $this->id);
        $res = $this->cms_model->delete($where_array);
        if ($res) {
            $this->session->set_flashdata('flash_message', '<strong>Deleted </strong> successfully.');
            $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
            redirect($this->router->directory.$this->router->class);
        }
    }

    function validate_form_data($action = NULL) {
        $this->form_validation->set_rules('pagecontent_type', 'page content type', 'required');
        $this->form_validation->set_rules('pagecontent_title', 'page content title', 'required');
        $this->form_validation->set_rules('pagecontent_text', 'page content text', 'required');

        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

}

?>
