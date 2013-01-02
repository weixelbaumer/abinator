<?php //debug($segmentMetrics); ?>
<div class="dashboards view">
	<h2><?php echo $dashboard['Dashboard']['name']; ?></h2>
	<table cellpadding="0" cellspacing="0" class="comparison">
    <?php $first = true; ?>
	<?php foreach ($segmentMetrics as $segmentMetric): ?>
    <?php if($segmentMetric['Segment']['baseline_id'] == null) continue; ?>
    <?php $baseline = $segmentMetric['Baseline']; ?>
    <?php if ($first) { ?>
	<tr>
		<th></th>
        <th>Size</th>
		<?php foreach($segmentMetric['Metric'] as $metric): ?>
		<th><?php echo $metric['name']; ?></th>
		<?php endforeach; ?>
	</tr>
    <?php } else { ?>
	<tr>
		<th>&nbsp;</th>
        <th>&nbsp;</th>
		<?php foreach($segmentMetric['Metric'] as $metric): ?>
		<th>&nbsp;</th>
		<?php endforeach; ?>
	</tr>
    
    <?php } $first = false;?> 
	<tr>
		<th class="baseline">Baseline: <?php echo h($baseline['Segment']['name']); ?></th>
		<th class="baseline"><?php echo h($baseline['Segment']['count']); ?></th>
		<?php foreach($baseline['Metric'] as $k => $metric): ?>
		<th><?php echo round($metric['avg'],3); ?></th>
		<?php endforeach; ?>
	</tr>
	<tr>
		<td><?php echo $segmentMetric['Segment']['name']; ?></td>
		<td><?php echo $segmentMetric['Segment']['count']; ?></td>
 		<?php 
			foreach($segmentMetric['Metric'] as $k => $metric){
				if($metric['pvalue'] === false){
					$delta = 'NA';
					$sign = '';
					$opacity = 0.2;
				}else{
					$delta = (round($metric['avg']/$baseline['Metric'][$k]['avg']*100 ,0)-100).'%';
					$sign = $delta > 0 ? 'positive' : 'negative';
					$opacity = 1-pow($metric['pvalue'],1/3);
				}
				
				echo "<td class='dashboard $sign'><p style='opacity: $opacity' title = '".round($metric['pvalue'],3)."'>".round($metric['avg'],2)."<br /><span style='white-space: nowrap;'>$delta</span></p></td>";
			}
		?>
	</tr>
	<?php endforeach; ?>
	</table>
</div>
