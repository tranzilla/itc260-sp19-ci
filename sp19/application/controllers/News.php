<?php
//application/controllers/News.php
class News extends CI_Controller {

        public function __construct()
        {
			parent::__construct();
			$this->load->model('news_model');
			$this->load->helper('url_helper');
            $this->config->set_item('banner', 'News Section');
        }

        //List page - show all the news article
        public function index()
		{
            //this changes item in custom_config file (key, data)
			$this->config->set_item('title', 'Seattle Sport News');
            
            //this changes item
            $nav1 = $this->config->item('nav1');
            
            $data['news'] = $this->news_model->get_news();
			$data['title'] = 'News archive';
			
			//$this->load->view('templates/header', $data);
			$this->load->view('news/index', $data);
			//$this->load->view('templates/footer', $data);
			
		}
    
       //View Page - display the selected article 
       public function view($slug = NULL)
		{
               
            /*
            slug without dashes: 
                $dashless_slug = str_replace("-", " ", $slug);
                
            slug with Title Case (only First letter of each word capitalize)
                $foo = ucwords($foo);  
            */
           
            //slug without dashes:
            $dashless_slug = str_replace("-", " ", $slug);
           
            //slug with title case:
            $dashless_slug = ucwords($dashless_slug);  
           
            //use dashless_slug for title tag with News Flash - at the beginning
            $this->config->set_item('title', 'News Flash - ' . $dashless_slug);

            $data['news_item'] = $this->news_model->get_news($slug);

            if (empty($data['news_item']))
            {
                show_404();
            }

            $data['title'] = $data['news_item']['title'];

            //$this->load->view('templates/header', $data);
            $this->load->view('news/view', $data);
            //$this->load->view('templates/footer', $data);
		}
	
		public function create()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['title'] = 'Create a news item';

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('text', 'Text', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				//$this->load->view('templates/header', $data);
				$this->load->view('news/create', $data);
				//$this->load->view('templates/footer', $data);

			}
			else
			{
				//$this->news_model->set_news();
				//$this->load->view('templates/header', $data);
				//$this->load->view('news/success');
				//$this->load->view('templates/footer', $data);
				
				//if we have data, send it over
				$slug = $this->news_model->set_news();
				if($slug !== false)
				{//slug redirect to 
					feedback('Data entered sucessfully!', 'info');
					redirect('news/view/' . $slug);
					
				}else{//error - no data - redirect back to the form
					feedback('Data Not entered!', 'error');
					redirect('news/create');
					
				}
			}
		}
}