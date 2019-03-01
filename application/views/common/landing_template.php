<?php
  if (isUserLoggedIn()) {
    $this->load->view('common/authenticated_header');
    $this->load->view('common/sidebar');
  } 
  else {
    $this->load->view('common/header');
    $this->load->view('common/navbar');
  }
  
  foreach ($contents as $content) {
    $this->load->view($content);
  }
  $this->load->view('common/footer');
?>
  