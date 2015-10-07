<h1>Search Page</h1>
<p>Search Form.</p>
<?php
  	echo $this->Form->create();
	echo $this->Form->input('keyword', array(

        'div' => false,

    )

);
	echo $this->Form->submit(__('Search'), array(

        'div' => false

    )

);
	var_dump($results);// $results;
  	echo $this->Form->end();
?>