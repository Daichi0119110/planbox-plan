<?php 
require('TwistOAuth.phar');	
class PostsController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Couple','User','Post');
	public function getTweet()//とりあえずここに記述。ユーザはアクセスしない。
	{	
		$this->autoRender = false;
		$this->autoLayout = false;
$to = new TwistOAuth('uwx5NeGNswaHvnPQbBKu5GArv','n6yqYpDkWucaMYc2VOVDY2LQbzKPwHsdjziPFRk2HGmd74Mg1m','2935870814-7RvpUpTMy1W7qyfGZAAwiN80xLa4f4knmp5HHfc','yKBrPFxngGnqe2k0w5ttZXKLlJoNQ0ERwjSKfRaCmdtQQ');
//$to=new TwistOAuth('9ELmNVrSHQih0oFF8Dlr19L7D', '1NjLEN4bjL5WqYwgsh4G1LQKc0SSgjucoeNeETOQ7p6juxduFq', '2720934722-wa7bZMpCBKUtKoRatXGIsUWKt60WZ0f2evJi7TG', 'YACgr4Vh3RjzzSCQ8b3EEGKzPqgJ9umtFKmaP4wFlKLgj');

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
        //	var_dump($locatename);
        	//$coordinates=$status->coordinates;
        //	var_dump($status);
        //	var_dump($medias);
            $text= str_replace($Hash, '', $status->text);
            $text= str_replace('\n', '', $text);
            //var_dump($text);
           // $text2 = substr($text, 0, strcspn($text,':'));
            //var_dump($text2);
        	$this->Post->AddPosts($text,$time,$id,$medias,$coordinates,$locatename);
        	//var_dump($time);
        /*	printf(
            	"@%s: %s\n",
            	$status->user->screen_name,
            	htmlspecialchars_decode($status->text, ENT_NOQUOTES)
        	);*/
    	    flush(); // Required if running not on Command Line but on Apache
    	}
   		}
   }
});
	}
}