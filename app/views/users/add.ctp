<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('role',array('type'=>'hidden','value'=>1));
		echo $this->Form->input('fName');
		echo $this->Form->input('lName');
		echo $this->Form->input('group_id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Attempts', true), array('controller' => 'attempts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attempt', true), array('controller' => 'attempts', 'action' => 'add')); ?> </li>
	</ul>
</div>