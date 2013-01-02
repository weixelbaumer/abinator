<div class="segments view">
<h2><?php  echo __('Segment');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($segment['Segment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($segment['Segment']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($segment['Segment']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Segment'); ?></dt>
		<dd>
			<?php echo h($segment['Segment']['segment']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Segment'), array('action' => 'edit', $segment['Segment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Segment'), array('action' => 'delete', $segment['Segment']['id']), null, __('Are you sure you want to delete # %s?', $segment['Segment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Segments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Segment'), array('action' => 'add')); ?> </li>
	</ul>
</div>
