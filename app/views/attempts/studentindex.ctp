<div class="attempts index">
	<h2><?php __('Tests you can take now');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php //echo $this->Paginator->sort('id');?></th>
			<th><?php //echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('exam_id');?></th>
			<th><?php //echo $this->Paginator->sort('date');?></th>
			<th><?php //echo $this->Paginator->sort('score');?></th>
			<th class="actions"><?php //__('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attempts as $attempt):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if (!$attempt['Attempt']['date']):
	?>
	<tr<?php echo $class;?>>
		<td><?php //echo $attempt['Attempt']['id']; ?>&nbsp;</td>
		<td>
			<?php //echo $this->Html->link($attempt['User']['username'], array('controller' => 'users', 'action' => 'view', $attempt['User']['id'])); ?>
		</td>
		<td>
			<?php echo $attempt['Exam']['name']; ?>
		</td>
		<td><?php //echo $attempt['Attempt']['date']; ?>&nbsp;</td>
		<td><?php //echo $attempt['Attempt']['score']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Take This Test', true), array('action' => 'studenttake', $attempt['Attempt']['id'])); ?>
		</td>
	</tr>
	<?php endif;?>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

	<h2><?php __('Previous Tests');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php //echo $this->Paginator->sort('id');?></th>
			<th><?php //echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('exam_id');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('score');?></th>
			<th class="actions"><?php //__('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attempts as $attempt):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		if ($attempt['Attempt']['date']):
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $attempt['Attempt']['id']; ?>&nbsp;</td>
		<td>
			<?php //echo $this->Html->link($attempt['User']['username'], array('controller' => 'users', 'action' => 'view', $attempt['User']['id'])); ?>
		</td>
		<td>
			<?php echo $attempt['Exam']['name']; ?>
		</td>
		<td><?php echo $attempt['Attempt']['date']; ?>&nbsp;</td>
		<td><?php echo $attempt['Attempt']['score']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $attempt['Attempt']['id'])); ?>
		</td>
	</tr>
	<?php endif;?>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
