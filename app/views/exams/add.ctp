<div class="exams form">
<?php echo $this->Form->create('Exam');?>
	<fieldset>
		<legend><?php __('Add Exam'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('notes',array('label'=>'<strong>Notes</strong>(Will not be seen when taking exam)'));
		echo $this->Form->input('instructions',array('label'=>'<strong>Exam Instructions</strong>(Will be shown before taking exam)'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Exams', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Attempts', true), array('controller' => 'attempts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attempt', true), array('controller' => 'attempts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions', true), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question', true), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>