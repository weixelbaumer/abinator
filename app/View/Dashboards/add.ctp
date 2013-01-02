<div class="dashboards form">
<?php echo $this->Form->create('Dashboard');?>
	<fieldset>
		<legend><?php echo __('Add Dashboard'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('Segment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dashboards'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Segments'), array('controller' => 'segments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Segment'), array('controller' => 'segments', 'action' => 'add')); ?> </li>
	</ul>
</div>
