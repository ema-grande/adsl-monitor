<!-- footer -->
<footer class="footer">
	<div class="container">
		<p class="text-center">All right reserved &copy; <?php echo date("Y", time()); ?></p>
	</div>
</footer>
<!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
<script>
	var url = "<?php echo URL; ?>";
</script>
<script src="<?php echo URL; ?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo URL; ?>js/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>js/list-1.1.1.min.js"></script>
<script src="<?php echo URL; ?>js/list.pagination-0.1.1.min.js"></script>
<?php if (isset($this->list) and count($this->list) >= 200){ ?>
<script>
	// Init list
	//options.page = 200;		// default
	var paginationTopOpt = {
		name: 'paginationTop',
		paginationClass: 'paginationTop',
		innerWindow: 3,
		outerWindow: 2
	};
	var paginationBotOpt = {
		name: 'paginationBot',
		paginationClass: 'paginationBot',
		innerWindow: 3,
		outerWindow: 2
	};

	options.plugins = [
		ListPagination(paginationTopOpt),
		ListPagination(paginationBotOpt)
	];
	
</script>
<?php } ?>
<script>
	var contactList = new List('tab', options);
</script>
<!-- / footer -->
</body>
</html>
