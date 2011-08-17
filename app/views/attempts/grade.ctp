<div class="attempts view">
<?php echo $this->Form->create('Attempt');?>
<h2><?php  __('Attempt');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attempt['Attempt']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($attempt['User']['username'], array('controller' => 'users', 'action' => 'view', $attempt['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Exam'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($attempt['Exam']['name'], array('controller' => 'exams', 'action' => 'view', $attempt['Exam']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Taken'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attempt['Attempt']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Score'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attempt['Attempt']['score']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Attempts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attempt', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exams', true), array('controller' => 'exams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam', true), array('controller' => 'exams', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Essay Answers');?></h3>
	<?php if (!empty($attempt['Answer'])):?>
	<?php
		$i = 0;
		foreach ($attempt['Answer'] as $answer):
			if($answer['Question']['type']==0) {
				//ignore multiple choice questions
				echo '<h4>'.$answer['Question']['text'].'</h4>';
				echo '<strong>Student\'s answer:</strong><br>';
				echo nl2br($answer['text']);
				echo $this->Form->input('answer.'.$answer['id'].'.score',array('label'=>'Score (<i>'.$answer['Question']['value'].' max</i>)'));
				echo $this->Form->input('answer.'.$answer['id'].'.comments',array('label'=>'Instructor Comments','type'=>'textarea'));
				//debug($answer);
			}//endif
		?>
	<?php endforeach; ?>
	<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$attempt['Attempt']['id']));?>
<?php endif; ?>
<?php echo $this->Form->end(__('Submit', true));?>

</div>
