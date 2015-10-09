<div align="center">
<h1>ログイン</h1>
<?php
  echo $this->Form->create('User');
?>
<hr>
  
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
    'style' => 'width: 50%;'
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
    'style' => 'width: 50%;'
));
?>
<?php
  echo $this->Form->submit('ログイン', array('class' => 'btn btn-default'));
?> 
</div>