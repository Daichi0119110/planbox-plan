<h1>Add Page</h1>
<p> Add Form.</p>
<?php
  echo $this->Form->create('Couple');
  echo $this->Form->input('male_id' , array('type' => 'text'));
  echo $this->Form->input('female_id' , array('type' => 'text'));
  echo $this->Form->input('email' , array('type' => 'text'));
  echo $this->Form->end('Submit');
?>