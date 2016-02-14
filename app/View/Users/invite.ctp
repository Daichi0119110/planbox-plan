<div align="center">
<h1>認証画面</h1>
<?php
  echo $this->Form->create('User');
?>
<hr>
<?php
  echo "パスは".$yourid."です";
?>
  
<?php
  echo $this->Form->input('Inviteid',array(
    'label' => array(
        'text' => 'ID',       
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
  echo $this->Form->end(array('label' => '登録','class' => 'btn btn-default'));
?> 
</div>