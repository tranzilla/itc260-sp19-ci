<?php
    //application/views/news/index.php
$this->load->view($this->config->item('theme') . 'header'); //slug comes from custom_config file
echo '<h2>Picture Categories</h2>';
echo '<h3><a href=' . site_url('pics/' . 'Husky') . '>' . 'Husky' . '</a></h3>';
echo '<h3><a href=' . site_url('pics/' . 'Roses') . '>' . 'Roses </a></h3>';
echo '<h3><a href=' . site_url('pics/' . 'Cats') . '>' . 'Cats </a></h3>';
/*
foreach ($pics as $pic)
{
    echo '<h3>';
    echo $pic['tags'];
    echo '</h3>';
    echo '<p><a href=' . site_url('pics/' . $pic['tags']) . 'View pictures</a></p>';
}
*/
$this->load->view($this->config->item('theme') . 'footer'); 
?>