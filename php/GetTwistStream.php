<?php
require('TwistOAuth.phar');
require_once('../config.php');
require_once('../function.php');
$code = 200;

// Set your timezone.
date_default_timezone_set('Asia/Tokyo');


try {
    // Generate your TwistOAuth object.
    $to = new TwistOAuth('uwx5NeGNswaHvnPQbBKu5GArv','n6yqYpDkWucaMYc2VOVDY2LQbzKPwHsdjziPFRk2HGmd74Mg1m','2935870814-7RvpUpTMy1W7qyfGZAAwiN80xLa4f4knmp5HHfc','yKBrPFxngGnqe2k0w5ttZXKLlJoNQ0ERwjSKfRaCmdtQQ');

} catch (TwistException $e) {

    // Set error message.
    $error = $e->getMessage();

    // Overwrite HTTP status code.
    // The exception code will be zero when it thrown before accessing Twitter, we need to change it into 500.
    $code = $e->getCode() ?: 500;

}
// Disable timeout.
set_time_limit(0);

// Finish all buffering.
while (ob_get_level()) {
    ob_end_clean();
}

// Start streaming.
$to->streaming('user', function ($status) {
    // Treat only tweets.
   
    if (isset($status->text)) {
    $Hash = '#PlanBox';
     $pos = strpos($status->text, $Hash);
    if($pos!==false)
     {
    $time=strtotime($status->created_at);
//渡すもの$status->text(コメント),$status->created_at(時間),$status->user->screenname(ユーザ名),$status->entities->media[0]->media_url(画像のurl),&status->coordinates(緯度経度(配列))

      echo $status->entities->media[0]->media_url;
      setPost($status->user->screen_name, $status->text, $status->created_at, $status->entities->media[0]->media_url);
        flush(); // Required if running not on Command Line but on Apache
    }
    }
});
?>