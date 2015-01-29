<!-- nav-b -->
<div class="container">
	<ul class="nav nav-tabs nav-justified" role="tablist">
		<li><a href="<?php echo URL.$this->control."/".$this->section."/".date('Y-m-d', strtotime("-1 day", strtotime($this->today))); ?>">-1</a></li>
		<li><a href="<?php echo URL.$this->control."/".$this->section ?>">Today</a></li>
		<li><a href="<?php echo URL.$this->control."/".$this->section."/".date('Y-m-d', strtotime("+1 day", strtotime($this->today)));  ?>">+1</a></li>
	</ul>
</div>
<!-- / nav-b -->
