<?php
//application/controllers/Pics.php
class Pics extends CI_Controller {

        public function __construct()
        {
			parent::__construct();
            $this->load->model('pics_model');
            $this->load->helper('url_helper'); //this ay ot be visible, might be a built in helper
            $this->config->set_item('banner', 'Pics Section');
            /*
			
			$this->load->helper('url_helper');
            $this->config->set_item('banner', 'News Section'); 
            */
        }

        //List page - show all the news article
        public function index()
		{  
            $data['tags'] = 'Picture Categories';
            $this->config->set_item('tags', 'Pics');
            $this->load->view('pics/index', $data); 
        }//end of index

            

    
       //View Page - display the selected article 
       public function view($tags = NULL)
		{
           $data['pics'] = $this->pics_model->get_pics($tags);
            $data['title'] = 'Picture Categories';

            $this->config->set_item('title', 'Pics');
            $this->load->view('pics/view', $data);   

       }//end of view

    
}//end Pic class