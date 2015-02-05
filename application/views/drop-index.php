<!-- drop -->
<div class="container starter-template">
	<h2 class="page-header">ADSL Disconnetions</h2>
	<!-- <button type="button" class="btn btn-default">Mostra</button> -->
	<h3>Disconnetion table<?php printf(" for %s %s", $this->section, $this->today) ?></h3>
<?php
	$listCount = count($this->list);
	if ( $listCount != 0 ) {
?>
	<div id="tab">
	<?php if ($listCount >= 200){ ?><ul class="pagination paginationTop"></ul><?php } ?>
	<table class="table">
	<thead>
		<tr>
			<th class="sort" data-sort="id">#</th>
			<th class="sort" data-sort="time">Time</th>
			<th class="sort" data-sort="durata">Duration</th>
		</tr>
	</thead>
	<tbody class="list">
<?php
	$i = 1;
	$secs = 0;
	foreach ($this->list as $item) {
?>
		<tr>
			<td class="id"><?php printf("%d", $i) ?></td>
			<td class="time"><?php if (isset($item->time)) printf("%s", htmlspecialchars(date("Y-m-d H:i", $item->time), ENT_QUOTES, 'UTF-8')); ?></td>
			<td class="durata"><?php if (isset($item->durata)) printf("%s", htmlspecialchars(gmdate("z \d H \h i \m\i\\n s \s\\e\c", $item->durata), ENT_QUOTES, 'UTF-8')); ?></td>
		</tr>
<?php
		$i++;
		$secs = $secs + $item->durata;
	}
?>
	</tbody>
	<tr>
		<td>Totale durata</td>
		<td>#################</td>
		<td><?php printf("%s", gmdate("z \d H \h i \m\i\\n s \s\\e\c", $secs)); ?>*</td>
	</tr>
	</table>
	<?php if ($listCount >= 200){ ?><ul class="pagination paginationBot"></ul><?php } ?>
	</div>
	<p class="text-right"><small>* days hours:minutes:seconds</small></p>
<?php } else { ?>
	<div class="alert alert-warning" role="alert">
		<span class="glyphicon glyphicon-alert"></span>
		<span class="sr-only">Warning:</span>
		Nothing to show here!
	</div>
<?php } ?>
</div>
<script>
	var options = {
		valueNames: [ 'id', 'time', 'durata' ]
	};
</script>
<!-- / drop -->
