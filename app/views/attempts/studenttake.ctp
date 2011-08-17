<div class="attempts index">
<?php echo $this->Form->create('Attempt');?>
	<h2><?php __($attempt['Exam']['name']);?></h2>
	<strong>Instructions:</strong><br>
	<?php echo nl2br($attempt['Exam']['instructions']);?>
	<fieldset>
		<legend><?php __('Question'); ?></legend>
		<i>Value: <?php echo nl2br($question['Question']['value']); ?> points</i><br>
		<h3><?php echo nl2br($question['Question']['text']); ?></h3>
		<?php
			if($question['Question']['type']) {
				//multiple choice
				$choices=array();
				foreach($question['Choice'] as $c) $choices[$c['id']]=$c['text'];
				echo $this->Form->input('choice_id',array('type'=>'radio','options'=>$choices));
			} else {
				//essay
				echo $this->Form->input('text',array('type'=>'textarea'));
			}//endif
			echo $this->Form->input('attempt_id',array('type'=>'hidden','value'=>$attempt['Attempt']['id']));
//			echo $this->Form->input('type',array('type'=>'hidden','value'=>$question['Question']['type']));
			echo $this->Form->input('question_id',array('type'=>'hidden','value'=>$question['Question']['id']));
		?>
<?php echo $this->Form->end(__('Submit', true));?>
	</fieldset>





<?php //debug($attempt); ?>





</div>
