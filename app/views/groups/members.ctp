<div class="groups form">
<?php echo $this->Form->create('Group');?>
	<fieldset>
		<legend><?php __('Edit Group Members'); ?></legend>
	<?php
		echo "<strong>{$group['Group']['name']}</strong>";//debug($group);
	?>
	<?php if (!empty($group['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('FName'); ?></th>
		<th><?php __('LName'); ?></th>
		<th><?php __('Username'); ?></th>
		<th class="actions"></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['fName'];?></td>
			<td><?php echo $user['lName'];?></td>
			<td><?php echo $user['username'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Remove', true), array('action' => 'removeMember', $group['Group']['id'], $user['id'])); ?>
				<?php //echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<?php
		if ($users) {
			//show option to add member
			echo $this->Form->input('user_id',array('label'=>'Add User'));
			echo $this->Form->input('group_id',array('type'=>'hidden','value'=>$group['Group']['id']));
			echo $this->Form->end(__('ADD', true));
		}//endif
	?>
	</fieldset>
<?php ?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Edit Group', true), array('action' => 'edit', $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Delete Group', true), array('action' => 'delete', $this->Form->value('Group.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Groups', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>