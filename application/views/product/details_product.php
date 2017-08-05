<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <h2> "<?=$product->model;?>"</h2>
  <div class="row">
  <div class="col-md-5 col-lg-5">
      <div class="field-image">
        <a href="<?=site_url('product/details/'.$product->id)?>" class="active">
          <img class="img-circle img-responsive" typeof="foaf:Image" src="<?=base_url('uploads/'.$product->image)?>" height="500" width="500">
        </a>
      </div>
  </div>
  <div class="col-md-7 col-lg-7">
    <h1 class="title"><?=$product->model ." ".$product->cc ." ".$product->weight; ?></h1>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>Property</th>
          <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Engine Volume</td>
          <td><?=$product->cc;?></td>
        </tr>
        <tr>
          <td>Color</td>
          <td><?=$product->color;?></td>
        </tr>
        <tr>
          <td>Price</td>
          <td><?=$product->price;?></td>
        </tr>
        <tr>
          <td>Weight</td>
          <td><?=$product->weight;?></td>
        </tr>
        </tbody>
      </table>
  </div>
  </div>
</div>
