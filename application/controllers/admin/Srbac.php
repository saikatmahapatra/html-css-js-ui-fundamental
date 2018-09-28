<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Srbac extends CI_Controller {

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
        
        
        $this->load->model('srbac_model');
        $this->id = $this->common_lib->decode($this->uri->segment(4));
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
        $this->data['arr_role'] = $this->srbac_model->get_role_dropdown();
        $this->data['arr_permission'] = $this->srbac_model->get_permission_dropdown();

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
		$this->data['page_heading'] = 'Angular Service';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/index', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }
	
	function roles_index() {
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');		
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/roles_index', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function render_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->srbac_model->get_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->srbac_model->get_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->srbac_model->get_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $result['role_name'];
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
	
	
	function render_datatable_roles() {
        //Total rows - Refer to model method definition
        $result_array = $this->srbac_model->get_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->srbac_model->get_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->srbac_model->get_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = $result['role_name'];
            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit_role/' . $this->common_lib->encode($result['id'])), '<i class="fa fa-edit" aria-hidden="true"></i> Edit', array(
                'class' => 'text-dark mr-1',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/delete/' . $this->common_lib->encode($result['id'])), '<i class="fa fa-trash" aria-hidden="true"></i> Delete', array(
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

    function validate_role_form_data($action = NULL) {
		if($action == 'add'){
			$this->form_validation->set_rules('role_name', 'role name', 'required|is_unique[roles.role_name]');
		}else{
			$this->form_validation->set_rules('role_name', 'role name', 'required|callback_is_role_name_exists');
		}
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function is_role_name_exists($str) {
        //echo $str; die();
        $result = $this->srbac_model->check_role_name($str);
        if ($result == false) {
            $this->form_validation->set_message('is_role_name_exists', $str . ' is already exists !');
            return false;
        }
        return true;
    }

    function add_role() {
		$this->breadcrumbs->push('Add','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'insert') {
            if ($this->validate_role_form_data('add') == true) {                
                $postdata = array(
                    'role_name' => $this->input->post('role_name')
                );
                $insert_id = $this->srbac_model->insert($postdata);
                if ($insert_id) {
                    $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i> Added successfully.');
                    $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
                    redirect(current_url());
                }
            }
        }
		$this->data['page_heading'] = 'Add';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/add_role', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function edit_role() {
		$this->breadcrumbs->push('Edit','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        if ($this->input->post('form_action') == 'update') {
            if ($this->validate_role_form_data('edit') == true) {
                $parent_cat_id = ($this->input->post('category_parent') == '') ? NULL : $this->input->post('category_parent');
                $postdata = array(
                    'role_name' => $this->input->post('role_name')
                );
                $where_array = array('id' => $this->input->post('id'));
                $res = $this->srbac_model->update($postdata, $where_array);

                if ($res) {
                    $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i>Updated successfully.');
                    $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
                    redirect(current_url());
                }
            }
        }
        $result_array = $this->srbac_model->get_rows($this->common_lib->decode($this->uri->segment(4)));
        $this->data['rows'] = $result_array['data_rows'];
		$this->data['page_heading'] = 'Edit';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/edit_role', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function delete() {
        $where_array = array('id' => $this->id);
        $res = $this->srbac_model->delete($where_array);
        if ($res) {
            $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i> Deleted successfully.');
            $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
            redirect($this->router->directory.$this->router->class.'');
        }
    }

}

?>
