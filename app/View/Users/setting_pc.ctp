<?php 
// echo $this->Form->create('User', array('type'=>'file', 'enctype' => 'multipart/form-data'));
// echo $this->Form->input('image', array('label' => false, 'type' => 'file', 'multiple'));
// echo $this->Form->submit('登録する', array('name' => 'submit'));
// echo $this->Form->end();
?>

<div class="row">
<div class="col-sm-offset-3 col-sm-6">
	<h2>設定</h2>

<form>
        <div class="form-group has-error">
          <label class="control-label" for="email">twitterアカウント</label>
          <input type="text" id="email" class="form-control" placeholder="例:@planbox.date">
          <span class="help-block">Error!</span>
        </div>
        <div class="form-group">
          <input type="submit" value="submit" class="btn btn-primary">
        </div>
</form>

</div>
</div>

