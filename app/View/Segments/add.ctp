<div class="segments form">
<?php echo $this->Form->create('Segment');?>
	<fieldset>
		<legend><?php echo __('Add Segment'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('segment');
		echo $this->Form->input('baseline_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Segments'), array('action' => 'index'));?></li>
	</ul>
</div>
