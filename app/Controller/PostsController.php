<?php 
require('TwistOAuth.phar');	
class PostsController extends AppController {
	public $helper = array('HTML', 'form');
	public $uses = array('Date', 'Couple','User','Post');

    // // insta 用にpostを受け取る
    // if($this->request->is('post')){
    //     $this->getInstagram();
    // }
    
    // 登録時の、Instagram側の確認用アクセスを受けて対処
    

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
                    	var_dump($locatename);
                    	//$coordinates=$status->coordinates;
                    //	var_dump($status);
                    //	var_dump($medias);
                    	$this->Post->AddPosts($status->text,$time,$id,$medias,$coordinates,$locatename);
                    	//var_dump($time);
                    	printf(
                        	"@%s: %s\n",
                        	$status->user->screen_name,
                        	htmlspecialchars_decode($status->text, ENT_NOQUOTES)
                    	);
                	    flush(); // Required if running not on Command Line but on Apache
                    }
           		}
            }
        });

	}
    //　planboxというアプリ自体、そしてこの関数のインスタグラム側への登録
    //  二度と実行する必要はないよ
    public function register_instagram(){
    if($this->request->is('post')){

            // 設定
        $client_id = '36a31414781e4cb494cf812d233e31ad' ;       // クライアントID
        $client_secret = '0b239a81a69844dd8b900236cb21bb43' ;       // クライアントシークレット
        // $callback_url = 'http://k0hei.science/PostsController.php' ;        // コールバックURL
        $callback_url = explode( '?' , ( !isset($_SERVER['HTTPS']) || empty($_SERVER['HTTPS']) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] )[0] ;      // このプログラムを設置するURL
        $verify_token = 'techlabpaak' ;     // 合い言葉となるキー
  
        if( $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['hub_verify_token']) && $_GET['hub_verify_token'] == $verify_token && isset($_GET['hub_challenge']) && isset($_GET['hub_mode']) && $_GET['hub_mode'] == 'subscribe' )
        {
            // 確認用のキーを返却する
            echo $_GET[ 'hub_challenge' ] ;
            exit ;
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
        echo $callback_url;

        echo $json;

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
    }
    }

    public function getInstagram(){


        // 読み込み専用のストリームにアクセスし、JSONデータを取得
        $json = @file_get_contents( 'php://input' ) ;

        // JSONデータをオブジェクト形式に変換
        $obj = json_decode( $json ) ;
        $object = $obj->object;// "user"
        $user_id = $obj->object_id; // instaのuserid
         // $timestamp = $obj->time;// unix timestamp形式
        $mediaID = $obj->data->media_id; // 写真のid

        if(strpos($object, "user")!==false){

             $token = getUserToken($user_id);

             // 特定ユーザの投稿データ最新3件を取得する
            $photos_api_url = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent?access_token=' . $token . "&count=3";
            $item = json_decode(@file_get_contents($photos_api_url));
            // タグ情報
            $tags = ( isset($item->tags) && !empty($item->tags) ) ? '#' . implode( '、#' , (array)$contents->tags ) : '' ;

            if(strpos($tags, "planbox")!==false){
                // 日付、整形
                $date = $item->created_time;
                $date = date( 'Y/m/d H:i' , $date ) ;
                // 文章
                $text = $item->caption->text;
                // 場所情報
                $location_id = ( isset($item->location->id) ) ? $item->location->id : '' ;      // 場所ID
                $location_name = ( isset($item->location->name) ) ? $item->location->name : '' ;        // 場所名
                $location_lat = ( isset($item->location->latitude) ) ? $item->location->latitude : '' ;     // 緯度
                $location_long = ( isset($item->location->longitude) ) ? $item->location->longitude : '' ;      // 経度
                // 写真
                $photo = $item->data->images->standard_resolution->url;
                
                // 保存
                $post = array();
                $this->Post->save($data);

            }

        }


    }

}