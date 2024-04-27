</div>


<script>
	const base_url = "<?= base_url() ?>";
</script>


<script src="<?= base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/chart.js/chart.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>assets/js/atlantis.min.js"></script>
<script src="<?= base_url() ?>assets/js/setting-demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="<?= base_url("assets/js/main/global.js") ?>"></script>
<?php if (file_exists("assets/js/main/" . $type_user . ".js")) : ?>
<script src=<?= base_url("assets/js/main/" . $type_user . ".js") ?>></script>
<script src='<?=base_url()?>assets/js/fullcalendar.min.js'></script>
<script src='<?=base_url()?>assets/js/sweetalert.min.js'></script>
<?php
else :
// if (!file_exists("assets/js/$type_user/". $uri[2] .".js")) {
// write_file("assets/js/$type_user/". $uri[2] .".js", "");
// }
endif; ?>
<?php
if (isset($uri[2])) :
	if (file_exists("assets/js/main/" .strtolower($type_user). "/" . $uri[2] . ".js")) : ?>
		<script src="<?= base_url("assets/js/main/" .strtolower($type_user). "/" . $uri[2] . ".js") ?>"></script>
<?php endif;
endif; ?>
<?php

if (isset($uri[3])) :
	// if (!file_exists("assets/js/$type_user/". $uri[2] ."_". $uri[3] .".js")) {
	// 	write_file("assets/js/$type_user/". $uri[2] ."_". $uri[3] .".js", "");
	// }
	if (file_exists("assets/js/main/" .strtolower($uri[2]). "/" . $uri[3] . ".js")) : ?>

		<script src="<?= base_url("assets/js/main/" .strtolower($uri[2]). "/" . $uri[3] . ".js") ?>"></script>

	<?php endif; ?>
	<script type="text/javascript">
		setTimeout(function() {
			//console.clear();
		}, 200);
	</script>
<?php

endif;
?>


</body>
</body>

</html>