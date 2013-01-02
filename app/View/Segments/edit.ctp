<div class="segments form">
<?php echo $this->Form->create('Segment');?>
	<fieldset>
		<legend><?php echo $this->data['Segment']['baseline_id'] == null ? __('Edit Baseline') : __('Edit Segment'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Segment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Segment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Segments'), array('action' => 'index'));?></li>
	</ul>
</div>
