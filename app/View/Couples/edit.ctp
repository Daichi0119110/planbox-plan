<h1>Edit Page</h1>
<p>Edit Form.</p>
<?php
  echo $this->Form->create('Couple');
  echo $this->Form->input('profile');
  echo $this->Form->input('start_date');
  echo $this->Form->input('cover_url');
  echo $this->Form->input('anniversary');
  echo $this->Form->end('Submit');
?>