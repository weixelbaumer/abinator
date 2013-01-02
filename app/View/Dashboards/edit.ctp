<div class="dashboards form">
<?php echo $this->Form->create('Dashboard');?>
	<fieldset>
		<legend><?php echo __('Edit Dashboard'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('Segment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Dashboard.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Dashboard.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Dashboards'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Segments'), array('controller' => 'segments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Segment'), array('controller' => 'segments', 'action' => 'add')); ?> </li>
	</ul>
</div>
