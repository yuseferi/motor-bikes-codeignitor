<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
  <div class="row">
    <?php if (validation_errors()) : ?>
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= validation_errors() ?>
        </div>
      </div>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="col-md-12">
      <div class="page-header">
        <h1>Create Motor Bike Product</h1>
      </div>
      <?= form_open_multipart() ?>
      <div class="form-group">
        <label for="model">Bike Model</label>
        <input type="text" class="form-control" id="model" name="model" placeholder="Motor Bike Model" value="<?=set_value('model');?>">
      </div>
      <div class="form-group">
        <label for="cc">Engine Volume</label>
        <input type="text" class="form-control" id="cc" name="cc" placeholder="CC" value="<?=set_value('cc');?>">
      </div>
      <div class="form-group">
        <label for="color">Color</label>
          <?= form_dropdown('color', $colors, 'RED');?>
      </div>
        <div class="form-group">
            <label for="cc">Weight</label>
            <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight" value="<?=set_value('weight');?>">
        </div>
      <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="<?=set_value('price');?>">
      </div>
      <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" name="image" />
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-default" value="Create">
      </div>
      </form>
      <?php form_close(); ?>
    </div>
  </div><!-- .row -->
</div><!-- .container -->