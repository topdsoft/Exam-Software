<div class="attempts view">
<h2><?php  __('Attempt');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attempt['Attempt']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			if ($role>1) echo $this->Html->link($attempt['User']['username'], array('controller' => 'users', 'action' => 'view', $attempt['User']['id'])); 
			else echo $attempt['User']['username'];
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Exam'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			if ($role>1) echo $this->Html->link($attempt['Exam']['name'], array('controller' => 'exams', 'action' => 'view', $attempt['Exam']['id'])); 
			else echo $attempt['Exam']['name'];
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Taken'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attempt['Attempt']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Score'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attempt['Attempt']['score'].'/'.$attempt['Attempt']['maxscore']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Attempts', true), array('action' => 'index')); ?> </li>
		<li><?php if($role>1)echo $this->Html->link(__('New Attempt', true), array('action' => 'add')); ?> </li>
		<li><?php if($role>1)echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php if($role>1)echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php if($role>1)echo $this->Html->link(__('List Exams', true), array('controller' => 'exams', 'action' => 'index')); ?> </li>
		<li><?php if($role>1)echo $this->Html->link(__('New Exam', true), array('controller' => 'exams', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Answers');?></h3>
	<?php if (!empty($attempt['Answer'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?//php __('Id'); ?></th>
		<th><?php __('Question'); ?></th>
		<th><?php __('Score'); ?></th>
		<th><?php __('Your Answer'); ?></th>
		<th><?php __('Correct Answer/Comment'); ?></th>
	</tr>
	<?php
		$i = 0;//debug($attempt);
		foreach ($attempt['Answer'] as $answer):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?//php echo $answer['id'];?></td>
			<td><?php echo $answer['Question']['text'];?></td>
			<td><?php echo $answer['score'].'/'.$answer['Question']['value'];?></td>
			<td><?php 
				if($answer['Question']['type']) echo $answer['Choice']['text'];
				else echo nl2br($answer['text']);
			?></td>
			<td><?php 
				if ($answer['score']==0) echo'<strong>';
				if($answer['Question']['type']) echo $answers[$answer['Question']['id']];
				else echo nl2br($answer['comments']);
			?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
