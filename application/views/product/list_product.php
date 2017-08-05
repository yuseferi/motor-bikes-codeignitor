<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <h2>Product List <?= ($sort == "desc") ? "asc" : "desc"; ?></h2>

    <div class="row text-left  alert-info">
        <h3> Filter Results by Color </h3>
        <form class="form-inline" method="get">
            <select class="form-control" name="color">
                <option selected="selected" disabled="disabled" value="">Filter
                    By
                </option>
                <option selected="selected" value="">ALL</option>
              <?php foreach (unserialize(BIKE_COLORS) as $color): ?>
                <?php var_dump($filter == $color); ?>
                  <option value="<?= $color; ?>" <?= ($filter && $filter == $color) ? "selected=\"selected\"" : "" ?>"><?= $color; ?></option>
              <?php endforeach; ?>

            </select>
            <input class="btn btn-default" type="submit" name="filter"
                   value="Apply">
        </form>
    </div>
    <p>show list of bikes</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Model</th>

            <th>
                <a href="?order=date&sort=<?= ($sort == "desc") ? "asc" : "desc"; ?><?= ($filter) ? "&color=$filter" : ""; ?>"><i
                            class="fa fa-sort-<?= ($sort == "desc") ? "asc" : "desc"; ?>"
                            aria-hidden="true"></i>Created In</a></th>
            <th>Engine Volume</th>
            <th>
                <a href="?order=price&sort=<?= ($sort == "desc") ? "asc" : "desc"; ?><?= ($filter) ? "&color=$filter" : ""; ?>"><i
                            class="fa fa-sort-<?= ($sort == "desc") ? "asc" : "desc"; ?>"
                            aria-hidden="true"></i>Price</a></th>
            <th>Color</th>
            <th>Owner</th>
            <th>Image</th>
            <th>Operations</th>

        </tr>
        </thead>
        <tbody>
        <?php if (!empty($products)) : ?>
          <?php foreach ($products as $i => $product) : ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td>
                        <a href="<?= site_url('product/details/' . $product->id); ?>"><?= $product->model ?></a>
                    </td>
                    <td><?= $product->created_at ?></td>
                    <td><?= $product->cc ?></td>
                    <td><?= $product->price ?></td>
                    <td><?= $product->color ?></td>
                    <td><?= $product->username ?></td>
                    <td><img height="200" width="200"
                             class="img-responsive img-thumbnail"
                             alt="<?= $product->model; ?>"
                             title="<?= $product->model; ?>"
                             src="<?= base_url("/uploads/" . $product->image); ?>"/>
                    </td>
                    <td><a href="#not_wanted_in_test">Delete </a> | <a
                                href="#not_wanted_in_test">Edit </a></td>
                </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
  <?php if ($max_offset > 1) : ?>
      <div class="text-center">
          <ul class="pagination pagination-lg">
            <?php for ($i = 1; $i <= $max_offset; $i++): ?>
              <?php
              $query_str = "?page=$i";
              if ($order || $sort) {
                $query_str .= "sort=$sort&order=$order&page";
              }
              if ($filter) {
                $query_str .= "&color=$filter";
              }
              ?>
                <li class="<?= ($current_page == $i) ? "active" : ""; ?>"><a
                            href="<?= "$query_str"; ?>"><?= $i; ?></a></li>
            <?php endfor ?>
          </ul>
      </div>
  <?php endif; ?>
</div>

