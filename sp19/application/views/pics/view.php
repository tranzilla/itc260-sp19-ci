<?php
//application/views/pics/view.php

$this->load->view($this->config->item('theme') . 'header');

echo '<br />';
echo "<div.box style='float: left; '>";
echo "<div.box style='width: 24%; '>";
foreach ($pics as $pic) 
{
    echo "<div>";
    $size = 'm';
    $photo_url = 'http://farm'. $pic->farm . '.staticflickr.com/' . $pic->server . '/' . $pic->id . '_' . $pic->secret . '_' . $size . '.jpg';
    //echo  '</br>';
    echo "<img title='" . $pic->title . "' src='" . $photo_url . "' />";
    echo '</div>';
    echo '<div>';
    echo $pic->title;
    echo '</div>';
}
echo '</div>';    


$this->load->view($this->config->item('theme') . 'footer');

?>