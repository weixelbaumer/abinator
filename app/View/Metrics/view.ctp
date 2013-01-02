<div class="metrics view">
<h2><?php  echo __('Metric');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($metric['Metric']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($metric['Metric']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($metric['Metric']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Metric'); ?></dt>
		<dd>
			<?php echo h($metric['Metric']['metric']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Metric'), array('action' => 'edit', $metric['Metric']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Metric'), array('action' => 'delete', $metric['Metric']['id']), null, __('Are you sure you want to delete # %s?', $metric['Metric']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Metrics'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Metric'), array('action' => 'add')); ?> </li>
	</ul>
</div>
