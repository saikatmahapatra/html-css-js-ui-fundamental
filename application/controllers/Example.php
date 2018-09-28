<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Example extends CI_Controller {

    var $data;

    function __construct() {
        parent::__construct();
        //Loggedin user details
        $this->sess_user_id = $this->common_lib->get_sess_user('id');        
        
        //Render header, footer, navbar, sidebar etc common elements of templates
        $this->common_lib->init_template_elements();
        
        //add required js files for this controller
        $app_js_src = array();         
        $this->data['app_js'] = $this->common_lib->add_javascript($app_js_src);
        
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;
		
		//View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
		$this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
        
    }

    function index() {
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/index', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function form_helper() {
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        $this->data['job_role_arr'] = array(
            '' => '-Select-',
            '1' => 'Software Enginner',
            '2' => 'Consultant',
        );

        $this->data['domain_arr'] = array(
            '' => '-Select-',
            'IT Software' => array('1' => 'Software Engineering',
                '2' => 'Software Development',
                '3' => 'Web,UI,UX Development',
                '4' => 'Product Quality Analysis',
                '5' => 'Operation Management',
                '6' => 'SDLC/Process Management',
            ),
            'IT Telecom Networking' => array('1' => 'Telecom Architect',
                '2' => 'Telecom Infrastructure Support',
                '3' => 'Core Telecom',
                '4' => 'Pack Core',
                '5' => 'Network Engineering',
            ),
            'ITES/BPO' => array('1' => 'BPO',
                '2' => 'Out Sourcing',
                '3' => 'Tele Calling',
            ),
        );

        if ($this->input->post('form_action') == 'add') {
            if ($this->validate_form() == TRUE) {
                $this->session->set_flashdata('flash_message', '<strong>Ok! </strong>Validated and Ready to Insert Data.');
                $this->session->set_flashdata('flash_message_css', 'alert-info');
                redirect(current_url());
            }
        }
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/form_helper', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function validate_form() {
        $this->form_validation->set_rules('user_email', 'email', 'trim|required|valid_email');        
        $this->form_validation->set_rules('user_password', 'password', 'required|trim|min_length[6]|max_length[16]');
        $this->form_validation->set_rules('user_password_confirm', 'confirm password', 'required|matches[user_password]');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('job_role', 'job role selection', 'required');
        $this->form_validation->set_rules('functional_domain', 'functional domain', 'required');        
        $this->form_validation->set_rules('userfile', 'resume upload', 'trim|required');
        $this->form_validation->set_rules('terms', 'terms & condition acceptance', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_max_function_domain($functional_domain, $size) {
        //echo $size;die();
        //$this->form_validation->set_message('validate_max_function_domain', 'You can choose maximum 3 options');
        //return false;
    }
    
    function download_as_pdf(){
       $this->load->view($this->data['view_dir'].$this->router->class.'/dom_pdf_gen_pdf'); 
    }
            
    function dom_pdf_gen_pdf() {
        // Load all views as normal
        $this->load->view($this->data['view_dir'].$this->router->class.'/dom_pdf_gen_pdf');
        // Get output html
        $html = $this->output->get_output();
        // Load library
        $this->load->library('dompdf_gen');
        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("mypdf_" . time() . ".pdf");
    }

    function date_helper() {
        $this->load->helper('date');

        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/date_helper', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function directory_helper() {
        $this->load->helper('directory');
        $map = directory_map('./assets', FALSE, TRUE);
        $this->data['read_dir'] = $map;

        $map = directory_map('./assets', 1);
        $this->data['sub_folders'] = $map;

        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/directory_helper', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }
	
	function calendar_lib() {
		//add required js files for this controller
        $app_js_src = array(
            'assets/dist/js/timesheet.js',
        );
        $this->data['app_js'] = $this->common_lib->add_javascript($app_js_src);
		
		$prefs = array (
               'start_day'    => 'monday',
               'month_type'   => 'short',
               'day_type'     => 'short',
			   'show_next_prev'=>TRUE,
			   'template'	  =>  '
			   {table_open}<table class="ci-calendar table-sm" border="0" cellpadding="" cellspacing="">{/table_open}

				{heading_row_start}<tr>{/heading_row_start}

				{heading_previous_cell}<th class="prevcell"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
				{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
				{heading_next_cell}<th class="nextcell"><a href="{next_url}" >&gt;&gt;</a></th>{/heading_next_cell}

				{heading_row_end}</tr>{/heading_row_end}

				{week_row_start}<tr class="wk_nm">{/week_row_start}
				{week_day_cell}<td>{week_day}</td>{/week_day_cell}
				{week_row_end}</tr>{/week_row_end}

				{cal_row_start}<tr>{/cal_row_start}
				{cal_cell_start}<td class="day">{/cal_cell_start}

				{cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
				{cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

				{cal_cell_no_content}{day}{/cal_cell_no_content}
				{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

				{cal_cell_blank}&nbsp;{/cal_cell_blank}

				{cal_cell_end}</td>{/cal_cell_end}
				{cal_row_end}</tr>{/cal_row_end}

				{table_close}</table>{/table_close}
			   '
             );
		$this->load->library('calendar',$prefs);
		
		$year = $this->uri->segment(3) ? $this->uri->segment(3) : date('Y');
		$month = $this->uri->segment(4) ? $this->uri->segment(4) : date('m');
		$day = date('d');
		
		$this->data['entry_for'] = date('Y/m/d');
		
		
		
		$data = array();
		$this->data['cal'] = $this->calendar->generate($year,$month,$data);
		$this->data['page_heading'] = 'Calendar';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/calendar_lib', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

}

?>
