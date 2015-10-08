<?php 
require('TwistOAuth.phar');	
class PostsController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Couple','User','Post');
	public function getTweet()//とりあえずここに記述。ユーザはアクセスしない。
	{	
		$this->autoRender = false;
		$this->autoLayout = false;
        $to = new TwistOAuth('dummy','dummy','dummy','dummy');
        set_time_limit(0);
        while (ob_get_level()) {
            ob_end_clean();
        }

        $to->streaming('user', function ($status) {
            $Hash='#Planbox';
    	//var_dump($status);
    	//$scname=$status->user->screen_name;
    	//$UserID=$this->User->isexistname($scname);

        // Treat only tweets.
            if (isset($status->text)) {
        	//var_dump($status);
                if(strpos($status->text, $Hash)!==false)
                {
                    $scname=$status->user->screen_name;
                    $id=intval($this->User->isexistname($scname));
        	//   var_dump($status);
                    if($id>0)
                    {
                        $time=new DateTime($status->created_at);
                        $time->setTimezone(new DateTimeZone('Asia/Tokyo'));
                        $time->format('Y-m-d h:i:s');
                        $medias=$status->entities->media;
                        $locatename=$status->place->full_name;
                        $text= str_replace($Hash, '', $status->text);
                        $text= str_replace('\n', '', $text);
                        $locatenames=explode(" ", $locatename);
                        $newpost=$this->Post->AddPosts($text,$time,$id,$medias,$coordinates->coordinates['0'],$coordinates->coordinates['1'],$locatenames['0'],$locatenames['1']);
    	               flush(); // Required if running not on Command Line but on Apache
                   }
               }
           }
       });
    }
}