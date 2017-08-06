<?php

/**
 * Check is user logged in or not
 * @return int
 */
 function user_is_logged_in(){

   if(isset($_SESSION['user_id'])){
     return TRUE;
   }
  return FALSE;
}
