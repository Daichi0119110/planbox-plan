<h1>Edit User</h1>
<p>Edit Form.</p>
<?php
  echo $this->Form->create('User');
  echo $this->Form->input('gender');
  echo $this->Form->input('name');
  echo $this->Form->input('password');
  echo $this->Form->input('photo');
  echo $this->Form->input('birthday');
  echo $this->Form->input('age');
  echo $this->Form->end('Submit');
?>
 