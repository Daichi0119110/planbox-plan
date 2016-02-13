<?php
 
class Tag extends AppModel
{
    public $name = 'Tag';
    public $hasAndBelongsToMany = array(
        'Post' =>
            array(
                'className'              => 'Post',
                'joinTable'              => 'posts_tags',
                'foreignKey'             => 'tag_id',
                'associationForeignKey'  => 'post_id',
                'unique'                 => false,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => '',
                'with'                   => 'PostsTag'
            )
    );
    public function getormaketag($name){
        $status=array(
            'conditions'=>
            array('tag'=>$name)
        );
        $result=$this->find('first',$status);
        
        if(empty($result)){
            return $this->maketag($name);
        }
        else{var_dump($result);
            return $result['id'];
        }
    }
    public function maketag($name){
        $data=array();
        $this->create();
        $data['Tag']=array('tag'=>$name);
        $this->save($data);
        return $this->getLastInsertID();
    }
}