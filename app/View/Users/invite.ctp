<h1>Add User</h1>
<p>MySampleData Add Form.</p>
<?php
  echo $this->Form->create('User');
  echo $this->Form->input('mail');
  echo $this->Form->end('Submit');
?>
 