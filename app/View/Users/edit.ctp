<h1>Edit User</h1>
<p>Edit BootstrapForm.</p>
<?php
  echo $this->Form->create('User');
  echo $this->BootstrapForm->input('gender');
  echo $this->BootstrapForm->input('name');
  echo $this->BootstrapForm->input('password');
  echo $this->BootstrapForm->input('photo');
  echo $this->BootstrapForm->input('birthday');
  echo $this->BootstrapForm->input('age');
  echo $this->Form->end('Submit');
?>
 