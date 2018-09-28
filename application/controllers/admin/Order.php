<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

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
        
        
        $this->load->model('order_model');
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
        $this->id = $this->common_lib->decode($this->uri->segment(4));

        //View Page Config
		$this->data['view_dir'] = 'admin/'; // inner view and layout directory name inside application/view
        $this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
		
		// load Breadcrumbs
		$this->load->library('breadcrumbs');
		// add breadcrumbs. push() - Append crumb to stack
		$this->breadcrumbs->push('Dashboard', '/admin');
		$this->breadcrumbs->push('Orders', '/admin/order');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
    }

    function index() {
        // Check user permission by permission name mapped to db
        // $is_granted = $this->common_lib->check_user_role_permission('payment-list-view');
		$this->breadcrumbs->push('View','/');				
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		$this->data['page_heading'] = 'Online Orders';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/index', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function render_datatable() {
        //Total rows - Refer to model method definition
        $result_array = $this->order_model->get_rows();
        $total_rows = $result_array['num_rows'];

        // Total filtered rows - check without limit query. Refer to model method definition
        $result_array = $this->order_model->get_rows(NULL, NULL, NULL, TRUE, FALSE);
        $total_filtered = $result_array['num_rows'];

        // Data Rows - Refer to model method definition
        $result_array = $this->order_model->get_rows(NULL, NULL, NULL, TRUE);
        $data_rows = $result_array['data_rows'];
        $data = array();
        $no = $_REQUEST['start'];
        foreach ($data_rows as $result) {
            $no++;
            $row = array();
            $row[] = isset($result['order_no']) ? $result['order_no'] : '';
            $row[] = $this->common_lib->display_date($result['order_datetime'],true);
			$amt_wrapper = ($result['order_payment_debit_credit']=='C') ? '' : '';
            $row[] = isset($result['order_total_amt']) ? '<span class="'.$amt_wrapper.'"> &#8377;'.$result['order_total_amt'].'</span>' : '';
            $row[] = isset($result['order_payment_status']) ? $result['order_payment_status'] : '';
            //$row[] = isset($result['order_payment_trans_id']) ? $result['order_payment_trans_id'] : '';
            //$row[] = isset($result['order_status']) ? $result['order_status'] : '';

            $html_user_details = '';
            $html_user_details.= isset($result['user_firstname']) ? '<div class="">' . $result['user_firstname'] . '&nbsp;' . $result['user_lastname'] . '</div>' : '';
            $html_user_details.= isset($result['user_email']) ? '<div class="">' . $result['user_email'] . '</div>' : '';
            $html_user_details.= isset($result['user_phone1']) ? '<div class="">' . $result['user_phone1'] . '</div>' : '';
            $row[] = $html_user_details;

            //add html for action
            $action_html = '';
            $action_html.= anchor(base_url($this->router->directory.$this->router->class.'/edit/' . $this->common_lib->encode($result['id'])), '<i class="fa fa-edit" aria-hidden="true"></i>', array(
                'class' => 'text-dark mr-1',
                'data-toggle' => 'tooltip',
                'data-original-title' => 'Edit',
                'title' => 'Edit',
            ));
            $action_html.='&nbsp;';			

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
	
	function edit() {
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
		
		$this->breadcrumbs->push('Edit', '/');		
		$this->data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->data['arr_order_item_status'] = array(
		'processing'=>'Processing',
		'dispatched'=>'Dispatched',
		'out_for_del'=>'Out for Delivery',
		'delivered'=>'Delivered',
		'return_init'=>'Return Initiated',
		'return_approved'=>'Return Approved',
		'refund_init'=>'Refund Initiated',
		'refund_done'=>'Refunded Amount',
		'cancelled'=>'Cancelled',
		'rejected'=>'Rejected',
		'dismissed'=>'Dismissed'
		);		
		
		
        if ($this->input->post('form_action') == 'update') {
            //if ($this->validate_form_data('edit') == true) {
				//print_r($_POST);die();
                $postdata = array();				
				if(isset($_POST['order_detail_status'])){
					$i = 0;
					foreach($_POST['order_detail_status'] as $key => $val){					
						$postdata[$i]['id'] = $key;
						$postdata[$i]['order_detail_status'] = $val;					
						$i++;					
					}
					//print_r($postdata);die();										
					$res = $this->order_model->update_batch($postdata, 'id', NULL);
					if ($res) {
						$this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i>Order updated successfully.');
						$this->session->set_flashdata('flash_message_css', 'bg-success text-white');
						redirect($this->router->directory.$this->router->class.'/edit/'.$this->id);
					}
				}
            //}
        }
        $result_array = $this->order_model->get_rows($this->id);
        $order_details_result_array = $this->order_model->get_order_details($this->id); // order product details
		//print_r($order_details_result_array);
		//die();
		 
        $this->data['rows'] = $result_array['data_rows'];
        $this->data['odetails'] = $order_details_result_array['data_rows'];
		
		$this->data['page_heading'] = 'Manage Order';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/edit', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }
}

?>
