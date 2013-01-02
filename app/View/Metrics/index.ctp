<div class="metrics index">
	<h2><?php echo __('Metrics');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('metric');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($metrics as $metric): ?>
	<tr>
		<td><?php echo h($metric['Metric']['id']); ?>&nbsp;</td>
		<td><?php echo h($metric['Metric']['name']); ?>&nbsp;</td>
		<td><?php echo h($metric['Metric']['description']); ?>&nbsp;</td>
		<td><?php echo h($metric['Metric']['metric']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $metric['Metric']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $metric['Metric']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $metric['Metric']['id']), null, __('Are you sure you want to delete # %s?', $metric['Metric']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Metric'), array('action' => 'add')); ?></li>
	</ul>
</div>
