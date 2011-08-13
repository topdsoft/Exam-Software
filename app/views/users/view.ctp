<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Role'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['role']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('FName'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['fName']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('LName'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['lName']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attempts', true), array('controller' => 'attempts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attempt', true), array('controller' => 'attempts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Attempts');?></h3>
	<?php if (!empty($user['Attempt'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Test Id'); ?></th>
		<th><?php __('Date Taken'); ?></th>
		<th><?php __('Score'); ?></th>
		<th class="actions"></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Attempt'] as $attempt):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $attempt['id'];?></td>
			<td><?php echo $attempt['exam_id'];?></td>
			<td><?php echo $attempt['date'];?></td>
			<td><?php echo $attempt['score'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'attempts', 'action' => 'view', $attempt['id'])); ?>
				<?php //echo $this->Html->link(__('Edit', true), array('controller' => 'attempts', 'action' => 'edit', $attempt['id'])); ?>
				<?php //echo $this->Html->link(__('Delete', true), array('controller' => 'attempts', 'action' => 'delete', $attempt['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attempt['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attempt', true), array('controller' => 'attempts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
