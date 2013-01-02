<div class="segments view">
<h2><?php  echo __('Segment 1');?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($segment1['Segment']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Segment'); ?></dt>
		<dd>
			<?php echo h($segment1['Segment']['segment']); ?>
			&nbsp;
		</dd>
	</dl>

<h2><?php  echo __('Segment 2');?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($segment2['Segment']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Segment'); ?></dt>
		<dd>
			<?php echo h($segment2['Segment']['segment']); ?>
			&nbsp;
		</dd>
	</dl>

<h2>Metrics</h2>
<table>
<tr>
	<th>Metric</th>
	<th><?php echo $segment1['Segment']['name'] ?><small> (# in segment)</small></th>
	<th><?php echo $segment2['Segment']['name'] ?><small> (# in segment)</small></th>
	<th>p value</th>
</tr>
<?php foreach($ex['Experiment']['Metrics'] as $m): ?>
	<tr>
		<td><?php echo $m['name']; ?></td>
		<td><?php echo ($m['cov'] > $m['exv'] && $m['pv']<0.05? '<strong>'.$m['cov'].'</strong>' : $m['cov']); ?> <small>(<?php echo $m['coc']; ?>)</small></td>
		<td><?php echo ($m['exv'] > $m['cov'] && $m['pv']<0.05 ? '<strong>'.$m['exv'].'</strong>' : $m['exv']); ?>  <small>(<?php echo $m['exc']; ?>)</small></td>
		<td><?php echo $m['pv']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
</div>