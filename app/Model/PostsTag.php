<?php
 
class PostsTag extends AppModel
{
    public $name = 'PostsTag';
 
    public $belongsTo = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'post_id',
        ),
        'Tag' => array(
            'className' => 'Tag',
            'foreignKey' => 'tag_id',
        ),
    );
    function test() {
    return $this->find('all');
  }

//////////////////途中!
  function getTagid($tags){
    $ids=array();
    App::import('Model','Tag');
    $T=new Tag;
    foreach ($tags as $tag) {
        $ids[]=$T->getormaketag($tag);
    }
    return $ids;
  }
}