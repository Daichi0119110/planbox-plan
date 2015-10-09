<div align="center">
<h1>ユーザー登録</h1>
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
    'style' => 'width: 30%;'
));
?>

<label class="cotrol-label">性別</label>
<?php
  echo $this->Form->input('gender',array(
    'legend'=>false,
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'display: inline-block; width: auto;',
    'type' => 'radio',
    'options' => array('0' => '男性', '1' => '女性')
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
  echo $this->Form->end(array('label' => '登録','class' => 'btn btn-default'));
?> 
</div>