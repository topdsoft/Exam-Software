<div class="questions form">
<?php echo $this->Form->create('Question');?>
	<fieldset>
		<legend><?php __('Add Question'); ?></legend>
	<?php
		echo $this->Form->input('text');
		echo $this->Form->input('exam_id',array('type'=>'hidden','value'=>$exam_id));
		echo $this->Form->input('type',array('label'=>'Multiple Choice'));
		//echo $this->Form->input('answer');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Html->link(__('List Questions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Exams', true), array('controller' => 'exams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam', true), array('controller' => 'exams', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Answers', true), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Answer', true), array('controller' => 'answers', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Choices', true), array('controller' => 'choices', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Choice', true), array('controller' => 'choices', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>