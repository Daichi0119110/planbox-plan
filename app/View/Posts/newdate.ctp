<div align="center">
<h1>デート設定</h1>
<?php
  echo $this->Form->create('Post');
?>
<hr>

<label class="cotrol-label">ONOFF(適当)</label>
<?php
  echo $this->Form->input('check',array(
    'legend'=>false,
    'div' => array(
        'class' => 'form-group'    
    ),
    'class' => 'form-control',
    'style' => 'display: inline-block; width: auto;',
    'type' => 'radio',
    'options' => array('0' => 'OFF', '1' => 'ON')
));
?>
<?php
  echo $this->Form->end(array('label' => '適用','class' => 'btn btn-default'));
?> 
</div>