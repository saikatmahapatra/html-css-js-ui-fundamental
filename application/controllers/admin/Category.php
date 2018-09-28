<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

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
        
        
        $this->load->model('category_model');
        $this->id = $this->common_lib->decode($this->uri->segment(4));
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
        $this->data['category_dropdown'] = $this->category_model->get_category_dropdown();

        //View Page Config
		$this->data['view_dir'] = 'admin/'; // inner view and layout directory name inside application/view		
        $this->data['page_heading'] = $this->router->class.' : '.$this->router->method;        
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Dashboard', '/admin');
		$this->breadcrumbs->push('Product Category', '/admin/category');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
    }

    function index() {
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$this->data['page_heading'] = 'Product Category';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/index', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function render_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->category_model->get_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->category_model->get_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->category_model->get_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $result['category_name'];
            $row[] = $result['category_status'];
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' . $this->common_lib->encode($result['id'])), '<i class="fa fa-edit" aria-hidden="true"></i>', array(
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

    function validate_category_form_data($action = NULL) {
        if ($action == 'add') {
            $this->form_validation->set_rules('category_name', 'category name', 'required');
        } elseif ($action == 'edit') {
            $this->form_validation->set_rules('category_name', 'category name', 'required|callback_is_category_name_exists');
        }
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function is_category_name_exists($str) {
        //echo $str; die();
        $result = $this->category_model->check_category_name($str);
        if ($result == false) {
            $this->form_validation->set_message('is_category_name_exists', $str . ' is already exists !');
            return false;
        }
        return true;
    }

    function add() {
		$this->breadcrumbs->push('Add','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_category_form_data('add') == true) {
                $parent_cat_id = ($this->input->post('category_parent') == '') ? NULL : $this->input->post('category_parent');
                $postdata = array(
                    'category_name' => $this->input->post('category_name'),
                    'category_parent' => $parent_cat_id,
                );
                $insert_id = $this->category_model->insert($postdata);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i>Added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
                    redirect(current_url());
                }
            }
        }
		$this->data['page_heading'] = 'Add Product Category';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/add', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function edit() {
		$this->breadcrumbs->push('Edit','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_category_form_data('edit') == true) {
                $parent_cat_id = ($this->input->post('category_parent') == '') ? NULL : $this->input->post('category_parent');
                $postdata = array(
                    'category_name' => $this->input->post('category_name'),
                    'category_parent' => $parent_cat_id,
                    'category_status' => $this->input->post('category_status'),
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->category_model->update($postdata, $where_array);

                if ($res) {
                    $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i>Updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->category_model->get_rows($this->common_lib->decode($this->uri->segment(4)));
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_heading'] = 'Edit Product Category';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/edit', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function delete() {
        $where_array = array('id' => $this->id);
        $res = $this->category_model->delete($where_array);
        if ($res) {
            $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i> Deleted successfully.');
            $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
            redirect($this->router->directory.$this->router->class.'');
        }
    }

}

?>
