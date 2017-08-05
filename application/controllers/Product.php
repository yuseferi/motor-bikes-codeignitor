<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * user class.
 *
 * @extends CI_Controller
 */
class product extends CI_Controller {

  /**
   * __construct function.
   *
   * @access public
   * @return void
   */
  public function __construct() {

    parent::__construct();
    $this->load->model('product_model');
    $this->load->library(array('session'));
    $this->load->helper(array('url'));
    $this->load->helper(array('site'));

  }


  public function index() {

  }

  /**
   * register function.
   *
   * @access public
   * @return void
   */
  public function add_product() {


    if(!user_is_logged_in()){
        redirect('login');
    }
    // create the data object
    $data = new stdClass();
    // this is not optimum solution,color table is right solution  but seems ok for now
    $data->colors = unserialize(BIKE_COLORS);

    // load form helper and validation library
    $this->load->helper('form');
    $this->load->library('form_validation');

    // set image config
    $config['upload_path']   =   "uploads/";
    $config['allowed_types'] =   "gif|jpg|jpeg|png";
    $config['max_size']      =   "20000";
    $config['max_width']     =   "6000";
    $config['max_height']    =   "4000";
    //$config['encrypt_name'] = TRUE;
    $this->load->library('upload',$config);

    // set validation rules
    $this->form_validation->set_rules('model', 'Motor Bike Model', 'trim|required|min_length[2]');
    $this->form_validation->set_rules('cc', 'Engine Volume', 'trim|required');
    $this->form_validation->set_rules('color', 'Color', 'trim|required|min_length[3]');
    $this->form_validation->set_rules('weight', 'Weight', 'trim');
    $this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
    $this->form_validation->set_rules('image', 'Image');

    if ($this->form_validation->run() === false ) {

      // validation not ok, send validation errors to the view
      $this->load->view('templates/header',$data);
      $this->load->view('product/create_product', $data);
      $this->load->view('templates/footer');

    } else {

      if(!$this->upload->do_upload('image')) {

        // validation not ok, send validation errors to the view
        $data->error = $this->upload->display_errors();
        $this->load->view('templates/header',$data);
        $this->load->view('product/create_product', $data);
        $this->load->view('templates/footer');

      }
      // set variables from the form
      $model = $this->input->post('model');
      $cc    = $this->input->post('cc');
      $color = $this->input->post('color');
      $weight = $this->input->post('weight');
      $price = $this->input->post('price');
      $owner = $_SESSION['user_id'];
//      $raw_image  = $_FILES['image'];
      $up_data = $this->upload->data();
      $image_name = $up_data['file_name'];

      if ($this->product_model->create_product($model, $cc, $color, $weight ,$owner, $price,$image_name)) {

        // create product have been done
        $this->load->view('templates/header',$data);
        $this->load->view('product/list_product', $data);
        $this->load->view('templates/footer');

      } else {

        // product creation failed, this should never happen
        $data->error = 'There was a problem creating new Product. Please try again.';

        // send error to the view
        $this->load->view('templates/header',$data);
        $this->load->view('product/create_product', $data);
        $this->load->view('templates/footer');

      }

    }

  }


  public function show_product($id){

    $data = new stdClass();
    $data->id = $id;
    $this->load->model('product_model');
    $data->product= $this->product_model->get_product($id);
    $this->load->view('templates/header',$data);
    $this->load->view('product/details_product', $data);
    $this->load->view('templates/footer');
  }


  /**
   *  return list of products
   */


  public function list_product(){

    $max_offset = 0;
    $offset= 0;
    $data = new stdClass();
    $filter = NULL;
    $page   = $this->input->get( 'page' );
    if(!$page){
      $page = 1;
    }
    $elements_per_page  = ITEM_PER_PAGE -2  ;
    $this->load->model('product_model');
    $total      = $this->product_model->count_products();
    $offset = ($page-1) * $elements_per_page;
    $max_offset = ceil($total / $elements_per_page);

    $order    = $this->input->get('order');
    $order    = in_array($order, array( 'date', 'price'))  ? $order : NULL;
    $order = ($order== 'date')?'created_at':$order;

    $sort    = $this->input->get('sort');
    $sort    = in_array($sort, array( 'asc', 'desc'))  ? $sort : NULL;

    $filter    = $this->input->get('color');

    // And now, you can show a list of the elements you want to show from the page:
    $data->products = $this->product_model->get_list( $offset, $elements_per_page, $order, $sort,$filter );
    $data->sort = $sort;
    $data->order = $order;
    $data->current_page = $page ;
    $data->filter = $filter;
    $data->max_offset = $max_offset;

    $this->load->view('templates/header',$data);
    $this->load->view('product/list_product', $data);
    $this->load->view('templates/footer');
  }


}
