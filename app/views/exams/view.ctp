<div class="exams view">
<h2><?php  __('Exam');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $exam['Exam']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Instructions'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo nl2br($exam['Exam']['instructions']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes (Hidden)'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo nl2br($exam['Exam']['notes']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Exam', true), array('action' => 'edit', $exam['Exam']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Exam', true), array('action' => 'delete', $exam['Exam']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $exam['Exam']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Exams', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attempts', true), array('controller' => 'attempts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attempt', true), array('controller' => 'attempts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions', true), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question', true), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Attempts');?></h3>
	<?php if (!empty($exam['Attempt'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Exam Id'); ?></th>
		<th><?php __('Date'); ?></th>
		<th><?php __('Score'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($exam['Attempt'] as $attempt):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $attempt['id'];?></td>
			<td><?php echo $attempt['user_id'];?></td>
			<td><?php echo $attempt['exam_id'];?></td>
			<td><?php echo $attempt['date'];?></td>
			<td><?php echo $attempt['score'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'attempts', 'action' => 'view', $attempt['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'attempts', 'action' => 'edit', $attempt['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'attempts', 'action' => 'delete', $attempt['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attempt['id'])); ?>
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
<div class="related">
	<h3><?php __('Exam Questions');?></h3>
	<?php if (!empty($exam['Question'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php //__('Id'); ?></th>
		<th><?php __('Text'); ?></th>
		<th><?php //__('Exam Id'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php //__('Answer'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($questions as $q):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			$question=$q['Question'];
		?>
		<tr<?php echo $class;?>>
			<td><?php //echo $question['id'];?></td>
			<td><?php echo $question['text'];?></td>
			<td><?php //echo $question['exam_id'];?></td>
			<td><?php 
				if ($question['type']) echo 'MC';
				else echo 'Essay';
			?></td>
			<td><?php //echo $question['answer'];?></td>
			<td class="actions">
				<?php if ($i>1) echo $this->Html->link(__('Move Up', true), array('controller' => 'questions', 'action' => 'moveUp', $question['id'])); ?>
				<?php if ($i<count($questions)) echo $this->Html->link(__('Move Down', true), array('controller' => 'questions', 'action' => 'moveDown', $question['id'])); ?>
				<?php //echo $this->Html->link(__('View', true), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $question['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question', true), array('controller' => 'questions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
