<div align="center">
<h1>ユーザー情報編集</h1>
<?php
  echo $this->Form->create('User');
?>
  
<?php
  echo $this->Form->input('name',array(
    'label' => array(
        'text' => '名前',       
        'class' => 'control-label' 
    ),
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'width: 30%;'
));
?>
<?php
  echo $this->Form->input('password',array(
    'label' => array(
        'text' => 'パスワード',       
        'class' => 'control-label' 
    ),
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'width: 30%;'
));
?>
<?php
  echo $this->Form->input('photo',array(
    'label' => array(
        'text' => '写真',       
        'class' => 'control-label' 
    ),
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'width: 30%;'
));
?>
 <?php
  echo $this->Form->input('birthday',array(
    'label' => array(
        'text' => '誕生日',       
        'class' => 'control-label',
        'style' => 'display: block;'
    ),
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'display: inline-block; width: auto;',
    'type' => 'datetime',
    'interval' => 15
));
?>
<?php
  echo $this->Form->end(array('label' => '保存','class' => 'btn btn-default'));
?> 
</div>