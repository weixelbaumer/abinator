<div class="metrics form">
<?php echo $this->Form->create('Metric');?>
	<fieldset>
		<legend><?php echo __('Edit Metric'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('metric');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Metric.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Metric.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Metrics'), array('action' => 'index'));?></li>
	</ul>
</div>
