<?php 
require('TwistOAuth.phar');	
class PostsController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Couple','User','Post','PostsTag');
    public $components=array('Auth');
   /* public function beforeFilter(){
        parent::beforeFilter();
    }*/
    public function newpost(){
       /* if(!$this->Session->check('user_id')){
            $this->redirect('/users/signup');
        }
        $user_id = $this->Session->read('user_id');*/
        $user_id=$this->Auth->user('id');
        $couple_id=$this->User->getcoupleid($user_id);
        $couple=$this->Couple->getcouple($couple_id);

       // $d=$this->PostsTag->test();var_dump($d);

        if($this->request->is('post')){
            $this->request->data['Post']['date_id']=$couple['0']['Couple']['isdate'];
            $this->request->data['Post']['user_id']=$user_id;
            $this->request->data['Tag']=$this->PostsTag->getTagid(explode(",", $this->request->data['Post']['tag']));
            //explode(",", $this->request->data['Post']['tag']);
            var_dump($this->request->data);
           // var_dump($couple['0']['Couple']['isdate']);
           $this->Post->saveAll($this->request->data);
        }
    }

    public function newdate(){
        $user_id=$this->Auth->user('id');
        $couple_id=$this->User->getcoupleid($user_id);
        if($this->request->is('post')){
            $data=$this->Couple->getcouple($couple_id);
           // $this->create();

           // $data['0']['Couple']=array('id'=>$couple_id);
           //var_dump($data['0']);
           // var_dump($this->request->data);
            if($this->request->data['Post']['check']==0){$data['0']['Couple']['isdate']=$data['0']['Couple']['defdate'];}
            else{$data['0']['Couple']['isdate']=$this->Date->makenewDate($couple_id);}
            $this->Couple->save($data['0']);
        }
    }

/*	public function getTweet()//とりあえずここに記述。ユーザはアクセスしない。
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

    function search_in_array($str, $array){
        $pattern = '/' . preg_quote($str, '/') . '/i';
        foreach($array as $val){
            if(preg_match($pattern, $val)){
              return TRUE;
          }
      }
      return FALSE;
    }

    //　planboxというアプリ自体、そしてこの関数のインスタグラム側への登録
    //  サーバー変えたりしたら else コメントアウトして~/posts/callback_instagram を１度叩くが、二度と実行する必要はない
    public function callback_instagram(){

            // 設定
        $client_id = '5e3fb1c655b14c6f9b47b89bfe59c71c' ;       // クライアントID 
        $client_secret = '65d605ca29ea4d02aac10fb8ffcb1e1f' ;       // クライアントシークレット
        // test code
        $callback_url = 'http://k0hei.science/planbox-plan/posts/callback_instagram' ;        // コールバックURL
        // $callback_url = explode( '?' , ( !isset($_SERVER['HTTPS']) || empty($_SERVER['HTTPS']) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] )[0] ;      // このプログラムを設置するURL
        $verify_token = 'techlabpaak' ;     // 合い言葉となるキー

        if (isset ($_GET['hub_challenge']))
        {
            // 確認用のキーを返却する
            echo $_GET[ 'hub_challenge' ] ;
            exit ;
        }
        else if($this->request->is('post')){
        // else{
            $myString = @file_get_contents('php://input');
            $obj = json_decode($myString);
            $object = $obj[0]->object;// "user"
            $user_id = $obj[0]->object_id; // instaのuserid

            $user = $this->User->find('first',array(
                'conditions' => array('User.insta_id' => $user_id))
            );
            $acc_token = $user['User']['insta_token'];
            $id = $user['User']['id'];

            $photos_api_url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent/?access_token=' . $acc_token. '&count=1';
            // アイテムデータをJSON形式で取得する (CURLを使用)
            $curl = curl_init() ;

            // オプションのセット
            curl_setopt( $curl , CURLOPT_URL , $photos_api_url ) ;
            curl_setopt( $curl , CURLOPT_HEADER, 1 ) ; 
            curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER , false ) ;                             // 証明書の検証を行わない
            curl_setopt( $curl , CURLOPT_RETURNTRANSFER , true ) ;                              // curl_execの結果を文字列で返す
            curl_setopt( $curl , CURLOPT_TIMEOUT , 5 ) ;                                        // タイムアウトの秒数

            // 実行
            $res1 = curl_exec( $curl ) ;
            $res2 = curl_getinfo( $curl ) ;

            // 終了
            curl_close( $curl ) ;

            // 取得したデータ
            $json = substr( $res1, $res2['header_size'] ) ;                                     // 取得したデータ(JSONなど)
            $header = substr( $res1, 0, $res2['header_size'] ) ;                                // レスポンスヘッダー (検証に利用したい場合にどうぞ)

            // JSONデータをオブジェクト形式に変換する
            $photo_data = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json),true) ;
            $tmpdata = json_encode($photo_data["data"]);
            $dataTouse = json_decode($tmpdata);

            // $this->log( 'url='. $photos_api_url.'items='. $tmpdata . 'fin', LOG_FOR_YOU);
            $nosharp = 'planbox';
            
            foreach ($dataTouse as $item) {
                $tags = ( isset($item->tags) && !empty($item->tags) ) ? $tags = $item->tags : '' ;
                $tagres = $this->search_in_array($nosharp, $tags);
                if($tagres==1){

                    $time = date( 'Y-m-d h:i:s' , time() ) ;
                                // 文章
                    // $text = $item->caption->text;
                    $text = ( isset($item->caption->text) ) ? $item->caption->text : '' ;      // 場所ID
                                // 場所情報
                    $location_id = ( isset($item->location->id) ) ? $item->location->id : '' ;      // 場所ID
                    $location_name = ( isset($item->location->name) ) ? $item->location->name : '' ;        // 場所名
                    $location_lat = ( isset($item->location->latitude) ) ? $item->location->latitude : '' ;     // 緯度
                    $location_long = ( isset($item->location->longitude) ) ? $item->location->longitude : '' ;      // 経度
                            // 写真
                    $photo = $item->images->standard_resolution->url;

                    $test = 'time='. $text.' time='. $time.' location='. $location_name.' id='. $id.' photo='. $photo. 'fin';
                    $file = new File(WWW_ROOT.'insta_log.txt',true);
                    $file->write($test."\n",'a');
                    $file->close();
                    $city = 'FromInstagram';
                    
                    $newpost=$this->Post->AddPostsDemo($text,$time,$id,$photo,$location_lat,$location_long,$city,$location_name);
                }
            }
        }

        // パラメータを連想配列形式で指定(サンプルはGeographyの場合)
        $params = array(
            'client_id' => $client_id ,
            'client_secret' => $client_secret ,
            'object' => 'user' ,
            'aspect' => 'media' ,
            'verify_token' => $verify_token ,
            'callback_url' => $callback_url ,
            ) ;

        // POSTリクエストを送信し、返ってきたJSONデータをオブジェクト形式に変換
        // JSONデータが返ってくる前に待たされて、8〜13行目が行なわれる
        $json = @file_get_contents(
            'https://api.instagram.com/v1/subscriptions/' ,
            false,stream_context_create( array( 'http' => array(
                'method' => 'POST' ,
                'content' => http_build_query( $params ) ,
                )))
            ) ;
        // 取得したJSONをオブジェクトに変換
        $obj = json_decode( $json ) ;

        // 各データの整理
        $id = $obj->data->id ;      // 通知ID
        $url = 'https://api.instagram.com/v1/subscriptions?client_id=' . $params['client_id'] . '&client_secret=' . $params['client_secret'] ;      // 登録状況の確認用URL

        // HTML用
        $html = '' ;

        // 取得したデータ
        $html .= '<h2>取得したデータ</h2>' ;
        $html .= '<p>リアルタイム通知を登録しました。通知IDは<mark>' . $id . '</mark>です。</p>' ;
        $html .=    '<h3>JSON</h3>' ;
        $html .=    '<p><textarea rows="8">' . $json . '</textarea></p>' ;
        $html .=    '<h3>登録状況の確認</h3>' ;
        $html .=    '<p><a href="' . $url . '" target="_blank">' . $url . '</a></p>' ;
        echo $html;
    }

    public function findpost()
    {
        if($this->request->is('post')){
           
        }
        $data=$this->Post->findByTags("pl",array("sss","NAME"));
        var_dump($data);
    }*/

}