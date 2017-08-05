<?php

/**
 * Check is user logged in or not
 * @return int
 */
 function user_is_logged_in(){
  return intval($_SESSION['user_id']);
}
