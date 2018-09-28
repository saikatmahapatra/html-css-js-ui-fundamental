<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

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
        
        $this->load->library('cart');        
        $this->load->model('user_model');
        $this->load->model('product_model');
        $this->load->model('order_model');
        $this->cart->product_name_rules = '[:print:]'; // allow any characters in product name rule
        $this->data['alert_message'] = NULL;
        $this->data['alert_message_css'] = NULL;        
		$this->data['payment_method'] = array('cod'=>'Cash On Delivery','debit_card' => 'Debit Card', 'credit_card' => 'Credit Card', 'net_banking' => 'Net Banking');
		
		//View Page Config
		$this->data['view_dir'] = 'site/'; // inner view and layout directory name inside application/view
		$this->data['page_heading'] = $this->router->class.' : '.$this->router->method;
		
    }

    function index(){
        $this->my_cart();
    }
	
	function get_cart_data(){
		$result = array();
		$cartrows = array();
		$result['cartrows'] = '';
		$result['cart_total'] = $this->cart->total(); // Returns:	Total amount;
		$result['total_items'] = $this->cart->total_items(); //Returns:	Total amount of items in the cart;
		
        foreach ($this->cart->contents() as $item) {
            $product_options = $this->cart->product_options($item['rowid']);
            $cartrows[] = array(
                'rowid' => $item['rowid'],
                'id' => $item['id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'name' => $item['name'],
                'line_total' => $item['subtotal'],
                'category_name' => $product_options['category_name']
            );
        }
		$result['cartrows'] = $cartrows;
        return $result;
	}

    function my_cart() {
        $this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        
        $cart_data = $this->get_cart_data();		
		$this->data['cartrows'] = $cart_data['cartrows'];
        $this->data['cart_total'] = $cart_data['cart_total']; // Returns:	Total amount
        $this->data['total_items'] = $cart_data['total_items']; //Returns:	Total amount of items in the cart
		
		//Update quantity
		if($this->input->post('form_action')=='update_cart'){
			$this->update_cart();
		}
		
		$this->data['page_heading'] = 'My Cart';
        $this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/my_cart', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }

    function find_item($product_id) { //return rowid against a product id, if already added to the cart
        foreach ($this->cart->contents() as $item) {
            if ($item['id'] == $product_id) {
                return array('rowid' => $item['rowid'], 'qty' => $item['qty']);
            }
        }
        return false;
    }

    function add_to_cart() {
        $product_id = $this->input->get_post('product_id') ? $this->input->get_post('product_id') : $this->common_lib->decode($this->uri->segment(3));
        $result = $this->find_item($product_id);
        $qty = ($this->input->get_post('quantity') > 0) ? $this->input->get_post('quantity') : '1';

        if ($result == false) {
            $result_array = $this->product_model->get_rows($product_id);
            $row = $result_array['data_rows'];
            //$product_img = $this->product_model->get_product_images($product_id);
            //$img = $product_img[0]->product_image_file ? $product_img[0]->product_image_file : '';
            $data = array(
                'id' => $row[0]['id'],
                'qty' => $qty,
                'price' => $row[0]['product_price'],
                'name' => $row[0]['product_name'],
                'options' => array(
                    'category_name' => isset($row[0]['category_name']) ? $row[0]['category_name'] : 'none',
                    'product_image' => 'prod.png'
                )
            );
			//print_r($data); die();
            $result = $this->cart->insert($data);
        } else {
            $data = array(
                'rowid' => $result['rowid'],
                'qty' => $result['qty'] + $qty
            );

            $result = $this->cart->update($data);
        }
        if ($result) {
            if ($this->input->get_post('via_ajax')) {
                echo 'add_success'; // For Ajax response text
                die();
            }
            $this->session->set_flashdata('flash_message', 'Item has been added to your cart');
            $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
            redirect('order/my_cart');
        }
    }

    function update_cart() {
        for ($i = 1; $i <= $this->cart->total_items(); $i++) {
            $data = array(
                'rowid' => $this->input->post('rowid_' . $i),
                'qty' => $this->input->post('quantity_' . $i)
            );

            $result = $this->cart->update($data);
        }
        $this->session->set_flashdata('flash_message', 'You cart has been updated successfully.');
        $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
        redirect('order/my_cart');
    }

    function remove_cart($rowid = NULL) {
        $rowid = $this->uri->segment(3);
        $data = array(
            'rowid' => $rowid,
            'qty' => 0
        );
        $result = $this->cart->update($data);
        $this->session->set_flashdata('flash_message', 'Item has been removed from your cart');
        $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
        redirect('order/my_cart');
    }

    function remove_all() {
        $result = $this->cart->destroy();
        $this->session->set_flashdata('flash_message', 'Item has been removed from your cart');
        $this->session->set_flashdata('flash_message_css', 'bg-success text-white');
        redirect('order/my_cart');
    }
	
	function init_payment(){
        $is_logged_in = $this->common_lib->is_logged_in();
        
        if ($is_logged_in == FALSE) {   
            $this->session->set_userdata('sess_post_login_redirect_url', current_url());
            redirect('user/login');
        }
		$this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        
		$cart_data = $this->get_cart_data();
		$this->data['cartrows'] = $cart_data['cartrows'];
        $this->data['cart_total'] = $cart_data['cart_total']; // Returns:	Total amount
        $this->data['total_items'] = $cart_data['total_items']; //Returns:	Total amount of items in the cart
        
        //Shipping address
        $this->data['shipping_address'] = $this->get_user_shipping_address(NULL, $this->sess_user_id, 'S'); //Returns:	Total amount of items in the cart
		
		//Place Order
		if ($this->input->post('form_action') == 'place_order') {
            if ($this->validate_order_payment_form_data() == true) {
				$this->place_order();
			}
		}
		
		$this->data['page_heading'] = 'Checkout';		
		$this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/init_payment', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
	}

    function get_user_shipping_address($address_id = NULL, $user_id, $address_type_char){
        $result = array();
        $shipping_address = $this->user_model->get_user_address($address_id, $user_id, $address_type_char); //S -Shipping
        if(isset($shipping_address)){
            $result = $shipping_address;
        }
        return $result;
    }

    function place_order() {        
		$cart_data = $this->get_cart_data();
		//echo '<pre>';print_r($cart_data);die();
		/*
		Array
		(
			[cartrows] => Array
				(
					[0] => Array
						(
							[rowid] => ae9501535ac7c5595d4dc625d283838d
							[id] => 4
							[qty] => 2
							[price] => 90
							[name] => Moto G5 Back Cover
							[line_total] => 180
							[category_name] => Accessories
						)

					[1] => Array
						(
							[rowid] => b4c547233243f2317d8ad8343d699f5c
							[id] => 5
							[qty] => 2
							[price] => 1500
							[name] => Men's Nike Running Shoe
							[line_total] => 3000
							[category_name] => Shoes
						)

				)

			[cart_total] => 3180
			[total_items] => 4
		)
		*/
		$cartrows = $cart_data['cartrows'];		
        $cart_total = $cart_data['cart_total']; // Returns:	Total amount
        $total_items = $cart_data['total_items']; //Returns:	Total number of added items of a cart
		$shipping_address_id = $this->input->post('shipping_address');
		$shipping_address = $this->get_user_shipping_address($shipping_address_id, $this->sess_user_id, 'S');
        $order_number = $this->generate_order_number();
		$postdata = array(
			'order_user_id' => $this->sess_user_id,
			'order_no' => $order_number,
			'order_tax_amt' => $this->input->post('order_tax_amount'),
			'order_coupon_code' => $this->input->post('order_coupon_code'),
			'order_discount_amt' => $this->input->post('order_discount_amount'),
			'order_total_amt' => $cart_total,
			'order_payment_method' => $this->input->post('payment_method'),
			'order_payment_trans_id' => time(),
			'order_shipping_name' => $shipping_address[0]['name'],
			'order_shipping_phone1' => $shipping_address[0]['phone1'],
			'order_shipping_locality' => $shipping_address[0]['locality'],
			'order_shipping_zip' => $shipping_address[0]['zip'],
			'order_shipping_address' => $shipping_address[0]['address'],
			'order_shipping_city' => $shipping_address[0]['city'],
			'order_shipping_state' => $shipping_address[0]['state'],
			'order_shipping_landmark' => $shipping_address[0]['landmark'],
			'order_shipping_phone2' => $shipping_address[0]['phone2'],
		);
		//echo '<pre>';
		//print_r($postdata);
		//die();
		$insert_id_order_id = $this->order_model->insert($postdata);
		
		if ($insert_id_order_id) {
			$order_details_post_data = array();
			foreach($cartrows as $key => $cart_row){				
				$order_details_post_data[$key] = array(
					'order_id' => $insert_id_order_id,
					'product_id' => $cart_row['id'],
					//'order_detail_unit_price' => $cart_row['price'],
					'order_detail_price' => $cart_row['price'],
					'order_detail_quantity' => $cart_row['qty'],
					//'order_detail_discount_coupon' => $cart_row['coupon'],
					//'order_detail_discount_amt' => $cart_row['coupon'],
					//'order_detail_delivery_amt' => $cart_row['delivery'],
					'order_detail_total_amt' => $cart_row['line_total'] // this col aded for future implementation on calculation on gst, discount, delivey charges
				);

				
			}
			//echo '<pre>';
			//print_r($order_details_post_data); die();
			$this->order_model->insert_batch($order_details_post_data, 'order_details');
			
			$this->session->set_flashdata('flash_message', 'Thank you! We have received your order. Your Order Number '.$order_number.' Payment Done (Test)');
			$this->session->set_flashdata('flash_message_css', 'bg-success text-white');
			redirect('order/transaction_response');
		}
    }

    
    function generate_order_number() {
        $order_no = date('mdY') . time();
        return $order_no;
    }

    function validate_order_payment_form_data() {
        $this->form_validation->set_rules('shipping_address', 'Shipping address selection', 'required');        
        $this->form_validation->set_rules('payment_method', 'payment method selection', 'required');        
        $this->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');
        if ($this->form_validation->run() == true) {
            return true;
        } else {
            return false;
        }
    }

    function transaction_response() {
		$this->cart->destroy(); // remove cart items
		$this->data['alert_message'] = $this->session->flashdata('flash_message');
        $this->data['alert_message_css'] = $this->session->flashdata('flash_message_css');
        //Update table with payment response
		//$this->data = array();
		$this->data['order_no'] = '8278783799829080';
		$this->data['page_heading'] = 'Your Online Transaction Summary';
		$this->data['maincontent'] = $this->load->view($this->data['view_dir'].$this->router->class.'/transaction_response', $this->data, true);
        $this->load->view($this->data['view_dir'].'_layouts/layout_default', $this->data);
    }
}

?>