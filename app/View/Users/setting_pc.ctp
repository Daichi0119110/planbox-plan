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
			<div class="form-group">

				<label class="control-label" for="email">twitterアカウント</label>
				<input type="text" id="email" class="form-control" value=<?php echo $user["0"]["User"]["name"]?> style="margin-bottom:10px;">

				<label class="control-label" for="email">ユーザー名</label>
				<input type="text" id="email" class="form-control" value="荻原大地" style="margin-bottom:10px;">

				<?php
				echo $this->Form->input('birthday',array(
					'label' => array(
						'text' => '生年月日',       
						'class' => 'control-label',
						'style' => 'display: block;'
						),
					'div' => array(
						'class' => 'form-group'    
						),
					'class' => 'form-control',
					'style' => 'display: inline-block; width: auto;',
					'type' => 'datetime',
					'dateFormat' => 'YMD',
					'minYear' => 1950, 
					'maxYear' => date('Y'),
					'monthNames' => false,
					'timeFormat' => false,
					'separator' => '/',
					'interval' => 15
					));
					?>

				<div class="checkbox">
  <label><input type="checkbox" value="">匿名機能を使う</label>
  <p style="font-size:9px;color:gray;">＊匿名機能をONにすると、ユーザー名やユーザーの写真などのユーザー情報が隠され、デートプランの内容のみを公開することができます。</p>
</div>

				</div>
				<div class="form-group">
					<input type="submit" value="変更を更新する" class="btn btn-primary" style="float:right;">
				</div>
			</form>

		</div>
	</div>

