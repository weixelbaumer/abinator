<div class="metrics form">
<?php echo $this->Form->create('Metric');?>
	<fieldset>
		<legend><?php echo __('Add Metric'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Metrics'), array('action' => 'index'));?></li>
	</ul>
</div>
