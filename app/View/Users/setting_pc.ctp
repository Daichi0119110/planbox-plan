<h1>写真アップロード</h1>
<?php 
echo $this->Form->create('User', array('type'=>'file', 'enctype' => 'multipart/form-data'));
echo $this->Form->input('image', array('label' => false, 'type' => 'file', 'multiple'));
echo $this->Form->submit('登録する', array('name' => 'submit'));
echo $this->Form->end();
?>