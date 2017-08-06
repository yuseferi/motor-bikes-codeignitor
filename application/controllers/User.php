<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * user class.
 *
 * @extends CI_Controller
 */
class user extends CI_Controller {

  /**
   * __construct function.
   *
   * @access public
   * @return void
   */
  public function __construct() {

    parent::__construct();
    $this->load->library(['session']);
    $this->load->helper(['url']);
    $this->load->helper('site');
    $this->load->model('user_model');
    $this->load->library('unit_test');

  }


  public function index() {
    redirect('/login');
  }

  /**
   * register function.
   *
   * @access public
   * @return void
   */
  public function register() {

    // redirect user to products page when logged in
    if(user_is_logged_in()){
      redirect('/products');
    }

    // create the data object
    $data = new stdClass();
    $data->title = "Register User";
    // load form helper and validation library
    $this->load->helper('form');
    $this->load->library('form_validation');

    // set validation rules
    $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', ['is_unique' => 'This username already exists. Please choose another one.']);
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');

    if ($this->form_validation->run() === FALSE) {

      // validation not ok, send validation errors to the view
      $this->load->view('templates/header', $data);
      $this->load->view('user/register/register', $data);
      $this->load->view('templates/footer');

    }
    else {

      // set variables from the form
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      if ($this->user_model->create_user($username, $email, $password)) {

        // user creation ok
        $this->load->view('templates/header', $data);
        $this->load->view('user/register/register_success', $data);
        $this->load->view('templates/footer');

      }
      else {

        // user creation failed, this should never happen
        $data->error = 'There was a problem creating your new account. Please try again.';

        // send error to the view
        $this->load->view('templates/header', $data);
        $this->load->view('user/register/register', $data);
        $this->load->view('templates/footer');

      }

    }

  }

  /**
   * login function.
   *
   * @access public
   * @return void
   */
  public function login() {

    // redirect user to products page when logged in
    if(user_is_logged_in()){
      redirect('/products');
    }

    // create the data object
    $data = new stdClass();
    $data->title = "Login User";

    // load form helper and validation library
    $this->load->helper('form');
    $this->load->library('form_validation');

    // set validation rules
    $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {

      // validation not ok, send validation errors to the view
      $this->load->view('templates/header', $data);
      $this->load->view('user/login/login');
      $this->load->view('templates/footer');

    }
    else {

      // set variables from the form
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      if ($this->user_model->resolve_user_login($username, $password)) {

        $user_id = $this->user_model->get_user_id_from_username($username);
        $user = $this->user_model->get_user($user_id);

        // set session user datas
        $_SESSION['user_id'] = (int) $user->id;
        $_SESSION['username'] = (string) $user->username;
        $_SESSION['logged_in'] = (bool) TRUE;

        // user login ok
//        $this->load->view('templates/header', $data);
//        $this->load->view('user/login/login_success', $data);
//        $this->load->view('templates/footer');
        redirect('/products');

      }
      else {

        // login failed
        $data->error = 'Wrong username or password.';

        // send error to the view
        $this->load->view('templates/header', $data);
        $this->load->view('user/login/login', $data);
        $this->load->view('templates/footer');

      }

    }

  }

  /**
   * logout function.
   *
   * @access public
   * @return void
   */
  public function logout() {

    // create the data object
    $data = new stdClass();
    $data->title = "Logout User";

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE) {

      // remove session datas
      foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
      }

      // user logout ok
      $this->load->view('templates/header', $data);
      $this->load->view('user/logout/logout_success', $data);
      $this->load->view('templates/footer');

    }
    else {

      // there user was not logged in, we cannot logged him out,
      // redirect him to site root
      redirect('/');

    }

  }
}
