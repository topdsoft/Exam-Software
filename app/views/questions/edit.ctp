<div class="questions form">
<?php echo $this->Form->create('Question');?>
	<fieldset>
		<legend><?php __('Edit Question'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('text');
		echo $this->Form->input('value');
		echo $this->Form->input('exam_id',array('type'=>'hidden'));
		echo $this->Form->input('type',array('type'=>'hidden'));
		if ($this->data['Question']['type']==1) {
//debug($this->data);
//		echo $this->Form->input('answer');
			//show choices
			$i=0;
			$ary=array();
			echo '<strong>Choices:</strong>(Will be in random order on test)<br>';
			foreach($this->data['Choice'] as $choice) {
				//loop for all choices
				$i++;
				echo $i.' '.$choice['text'];
				echo ' '.$this->Html->link(__('Edit', true), array('controller' => 'choices', 'action' => 'edit',$choice['id']));
				echo ' '.$this->Html->link(__('Delete', true), array('controller' => 'choices', 'action' => 'delete', $choice['id']), null, sprintf(__('Are you sure you want to delete this choice?', true)));
				echo '<br>';
				$ary[$choice['id']]=$choice['text'];
			}
//			echo '<br><br><strong>Correct Answer:</strong>';
			echo $this->Form->input('answer',array('label' => '<strong>Correct Answer:</strong>','type'=>'select','options'=>$ary));
//			if (!$this->data['Question']['answer']) echo '(not set)';
//debug ($ary);
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete Question', true), array('action' => 'delete', $this->Form->value('Question.id')), null, sprintf(__('Are you sure you want to delete this question?', true))); ?></li>
		<li><?php echo $this->Html->link(__('List Exams', true), array('controller' => 'exams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exam', true), array('controller' => 'exams', 'action' => 'add')); ?> </li>
		<li><?php if ($this->data['Question']['type']==1)echo $this->Html->link(__('New Choice', true), array('controller' => 'choices', 'action' => 'add',$this->data['Question']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Images', true), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image', true), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>