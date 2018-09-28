<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {

    var $data;
    var $to_email;
    var $bcc_email;
    var $cc_email;

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
        $this->to_email = 'mahapatra.saikat29@gmail.com';
        $this->bcc_email = '';
        $this->cc_email = '';
        $this->load->library('email'); 

		//View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
		$this->data['page_heading'] = $this->router->class.' : '.$this->router->method;		
    }

    function validate_contact_form() {
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone_number', 'mobile number', 'trim|is_natural|numeric|max_length[10]');
        $this->form_validation->set_rules('message', 'message', 'required');
        $this->form_validation->set_rules('captcha', 'captcha verification', 'trim|required|callback_validate_captcha');
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function validate_captcha($str) {
        if ($str != $this->input->post('hdn_captcha_word')) {
            $this->form_validation->set_message('validate_captcha', 'Wrong captcha code, hmm are you the Terminator?');
            return false;
        } else {
            return true;
        }
    }

    function index() {
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');

        if ($this->input->post('form_action') == 'send') {
            if ($this->validate_contact_form() == true) {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $phone_number = $this->input->post('phone_number');
                $message = $this->input->post('message');
                $from_name = $name;
                $from_email = $email;
                $html = '';
                $html.='<table align="center" width="100%" border="0" cellpadding="3" cellspacing="0">';
                $html.='<tr bgcolor="#EBEBEB">';
                $html.='<td valign="top" align="left" width="20%"><b>Name</b></td>';
                $html.='<td valign="top" width="2%" style="font-weight:bold;">:</td>';
                $html.='<td valign="top" width="78%">' . $name . '</td>';
                $html.='</tr>';
                $html.='<tr bgcolor="#F5F5F5">';
                $html.='<td valign="top" align="left"><b>Email</b></td>';
                $html.='<td valign="top" style="font-weight:bold;">:</td>';
                $html.='<td valign="top">' . $email . '</td>';
                $html.='</tr>';
                $html.='<tr bgcolor="#EBEBEB">';
                $html.='<td valign="top" align="left"><b>Phone Number</b></td>';
                $html.='<td valign="top" style="font-weight:bold;">:</td>';
                $html.='<td valign="top">' . $phone_number . '</td>';
                $html.='</tr>';
                $html.='<tr bgcolor="#F5F5F5">';
                $html.='<td valign="top" align="left"><b>Message</b></td>';
                $html.='<td valign="top" style="font-weight:bold;">:</td>';
                $html.='<td valign="top">' . $message . '</td>';
                $html.='</tr>';
                $html.='</table>';

                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->to($this->config->item('app_admin_email'));
                $this->email->from($from_email, $from_name);
                $this->email->subject($this->config->item('app_email_subject_prefix') . ' Contact Us Email');
                $this->email->message($html);
                $eml = $this->email->send();
                //echo $this->email->print_debugger();
                //die($html);
                if ($eml == true) {
                    $this->session->set_flashdata('flash_message', '<i class="icon fa fa-check" aria-hidden="true"></i> Email sent.');
                    $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
                    redirect(current_url());
                } else {
                    $this->session->set_flashdata('flash_message', '<strong>Oops!</strong>Email not sent.');
                    $this->session->set_flashdata('flash_message_css', 'bg-danger text-white');
                    redirect(current_url());
                }
            } else {
                $data['error_message'] = validation_errors();
            }
        }
        //Create Captcha
        $this->load->helper('captcha');
        $data = array(
            'img_path' => './assets/captcha/images/',
            'img_url' => base_url('assets/captcha/images/'),
            'font_path' => './assets/captcha/fonts/arialbd.ttf',
            'img_width' => '160',
            'img_height' => 40,
            'border' => 1,
            'expiration' => 90
        );

        $cap = create_captcha($data);

        $this->data['captcha_word'] = $cap['word'];
        $this->data['captcha_image'] = $cap['image'];
		
		$this->data['page_heading'] = 'Contact Us';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/index', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

}
