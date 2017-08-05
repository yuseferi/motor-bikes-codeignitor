<?php
/**
 * Created by PhpStorm.
 * user: YMS
 * Date: 8/3/2017
 * Time: 1:49 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class Product_model extends CI_Model {

  /**
   * __construct function.
   *
   * @access public
   * @return void
   */
  public function __construct() {

    parent::__construct();
    $this->load->database();

  }

  /**
   * @param $model
   * @param $cc
   * @param $color
   * @param $price
   * @param $image
   *
   * @return mixed
   */
  public function create_product($model, $cc, $color, $weight, $owner, $price, $image) {

    $data = [
      'model' => $model,
      'cc' => $cc,
      'color' => $color,
      'weight' => $weight,
      'owner' => $owner,
      'price' => $price,
      'image' => $image,
      'created_at' => date('Y-m-j H:i:s'),
    ];

    return $this->db->insert('products', $data);

  }


  public function get_list($offset, $elements_per_page, $order, $sort, $filter) {
    $this->db->select('p.id, p.model,p.cc,p.price,p.weight,p.image,p.created_at,p.owner,p.color,users.username');
    $this->db->from('products as p');
    if($order && $sort) {
      $this->db->order_by('p.' . $order, $sort);
    }
    if ($filter) {
      $this->db->where('color', $filter);
    }
    $this->db->join('users', 'p.owner = users.id', 'left');
    $this->db->limit($elements_per_page, $offset);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    }
    else {
      return [];
    }

  }

  public function count_products($filter = NULL) {
    $this->db->select("*");
    $this->db->from("products");
    $filter = $this->input->get('color');
    if ($filter) {
      $this->db->where("color", $filter);
    }
    $query = $this->db->get();
    return count($query->result());
  }


  /**
   * @param $pid
   *
   * @return mixed
   */
  public function get_product($pid) {

    $this->db->from('products');
    $this->db->where('id', $pid);
    return $this->db->get()->row();

  }


  /**
   * @param $pid
   *
   * @return mixed
   */
  private function delete_product($pid) {

    $this->db->from('products');
    $this->db->where('id', $pid);
    $this->db->delete();
    if ($this->db->affected_rows() != 1) {
      return FALSE;
    }
    else {
      return TRUE;
    }

  }

}
