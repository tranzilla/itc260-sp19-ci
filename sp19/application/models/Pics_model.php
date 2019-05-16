<?php
//application/models/Pics_model.php
class Pics_model extends CI_Model {

        public function __construct()
        {
			$this->load->database();
        }
	
		public function get_pics($tags = FALSE)
		{//get tags from db
            if ($tags === FALSE)
            {
                $query = $this->db->get('ci_tags');
                return $query->result_array();
            }
        
            $query = $this->db->get_where('ci_tags', array('tags' => $tags));
            $api_key = '95095a29cba80be237fb014245662a15';
            
            //$api_key = $this->config->item('flickrKey');
            
            //should be passed in via querystrings controller 
            //$tags = 'tulips';

            $perPage = 25;
            $url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
            $url.= '&api_key=' . $api_key;
            $url.= '&tags=' . $tags;
            $url.= '&per_page=' . $perPage;
            $url.= '&format=json';
            $url.= '&nojsoncallback=1';

            $response = json_decode(file_get_contents($url));
            $pics = $response->photos->photo;
            
            return $pics;
		}//end get_pics()
    
        public function set_pics()
        {
            $this->load->helper('url');
            //$this->input->post('title') is the same as $_POST(title)
            $tags = url_title($this->input->post('title'), 'dash', TRUE);
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $tags,
                'text' => $this->input->post('text')
            );
            //return $this->db->insert('sm17_news', $data);

            if($this->db->insert('ci_tags', $data))
            {//data entered, show it
                //this is what we do to pass the id number to the view page
                //$this->db->inser_id();

                //the slug is used by the view page to load the current news item
                return $tags; 
            }else{//problem!
                return false;
            }
            
        }//end of set_pics()
    
}//end Pics_model		

		