<div align="center">
<h1>新規投稿</h1>
<?php
  echo $this->Form->create('Post');
?>
<hr>
  
<?php
  echo $this->Form->input('content',array(
    'label' => array(
        'text' => '内容',       
        'class' => 'control-label' 
    ),
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'width: 30%;'
));
    echo $this->Form->input('tag',array(
    'label' => array(
        'text' => 'タグ',       
        'class' => 'control-label' 
    ),
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'width: 30%;'
));

  echo $this->Form->end(array('label' => '登録','class' => 'btn btn-default'));
?> 
</div>