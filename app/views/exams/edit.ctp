<div class="exams form">
<?php echo $this->Form->create('Exam');?>
	<fieldset>
		<legend><?php __('Edit Exam Details'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('notes',array('label'=>'<strong>Notes</strong>(Will not be seen when taking exam)'));
		echo $this->Form->input('instructions',array('label'=>'<strong>Exam Instructions</strong>(Will be shown before taking exam)'));
//debug($this->Form->data);
	?>
	</fieldset>
<?php 
	//show questions
	$i=0;
	foreach($this->Form->data['Question'] as $Q) {
		//loop for all questions
		$i++;
		echo "<fieldset><legend>Question $i</legend>";
		echo $Q['text'].'<br>';
		if($Q['type']==0) echo '(essay)<br>';
		else {
			//show multiple choice
			foreach ($Q['Choice'] as $C) {
				//loop for each choice
				if ($Q['answer']==$C['id']) echo "<strong>*{$C['text']}</strong><br>";
				else echo "-{$C['text']}<br>";
			}
		}//end if for type of question
		echo $this->Html->link(__('Edit Question', true), array('controller' => 'questions', 'action' => 'edit', $Q['id'])).'<br>';
		echo $this->Html->link(__('Delete Question', true), array('controller' => 'questions', 'action' => 'delete', $Q['id']), null, sprintf(__('Are you sure you want to delete question # %s?', true), $Q['id']));
		echo '</fieldset>';
	}
?>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Exam.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Exam.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Exams', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Attempts', true), array('controller' => 'attempts', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Attempt', true), array('controller' => 'attempts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question', true), array('controller' => 'questions', 'action' => 'add', $this->Form->value('Exam.id'))); ?> </li>
	</ul>
</div>