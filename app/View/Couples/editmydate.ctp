<h1>Add Page</h1>
<p> Add Form.</p>
<?php
  echo $this->Form->create('Date');	
  echo $this->Form->input('id');
  echo $this->Form->input('name' , array('type' => 'text'));
  echo $this->Form->input('description' , array('type' => 'text'));
  echo $this->Form->input('budget' , array('type' => 'text'));
  echo $this->Form->end('Submit');
?>