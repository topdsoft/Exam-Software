<div class="choices form">
<?php echo $this->Form->create('Choice');?>
	<fieldset>
		<legend><?php __('Edit Choice'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('text');
		echo $this->Form->input('question_id',array('type'=>'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete Choice', true), array('action' => 'delete', $this->Form->value('Choice.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Choice.id'))); ?></li>
	</ul>
</div>