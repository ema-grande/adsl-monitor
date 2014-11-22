<!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
<script>
	var url = "<?php echo URL; ?>";
</script>

<!-- our JavaScript -->
<!-- <script src="<?php echo URL; ?>js/application.js"></script> -->

<script src="<?php echo URL; ?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo URL; ?>js/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>js/list-1.1.1.min.js"></script>
<script>
	// Init list
	var contactList = new List('tab', options);
</script>
</body>
</html>
