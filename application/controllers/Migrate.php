<?php
/**
 * Created by PhpStorm.
 * User: YMS
 * Date: 8/3/2017
 * Time: 9:54 AM
 */

class migrate extends CI_Controller {
  public function index()
  {
    // load migration library
    $this->load->library('migration');
    echo  $this->migration->current();
    if ( ! $this->migration->current())
    {
      echo 'Error' . $this->migration->error_string();
    } else {
      echo 'Migrations ran successfully!';
        }
  }
}