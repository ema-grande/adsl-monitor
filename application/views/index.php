<br/>
<div class="container starter-template">
	<div class="panel panel-default">
		<div class="panel-heading">Ultimo test speed</div>
		<div class="panel-body">
			L'ultimo speed test del <strong><?php echo $listSpeed[0]->time ?></strong>, 
			download speed <strong><?php echo $listSpeed[0]->dl ?></strong>, 
			uplaod speed <strong><?php echo $listSpeed[0]->up ?></strong>,
			con un ping di <strong><?php echo $listSpeed[0]->ping ?></strong>
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">Ultima disconnessione</div>
		<div class="panel-body">
			L'ultima volta disconnesso risulta il <strong><?php echo $listDrop[0]->time ?></strong>, 
			duarato <strong><?php echo gmdate('H:i:s', $listDrop[0]->durata); ?></strong>, 
		</div>
	</div>
	
	<div class="panel panel-default">
		<div class="panel-heading">Ultimo ping</div>
		<div class="panel-body">
			L'ultima ping alto registrato risulta il <strong><?php echo $listPing[0]->time ?></strong>, 
			di <strong><?php echo $listPing[0]->ping; ?></strong>, 
		</div>
	</div>
</div>
