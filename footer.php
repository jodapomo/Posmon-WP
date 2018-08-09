<footer>
		<div class="contenedor-footer">
			<div class="contenedor-datos">
				<div class="datos w3-row">
					<div class="logo w3-half">
						<img src="<?php echo cmb2_get_option( 'posmon_admin_main_options', 'logo' ); ?>" alt="">
					</div>
					<div class="divider w3-col"></div>
					<div class="textos w3-rest">
						<div class="textos-inner">
							<strong>Uniformes Posmon</strong>
							<p><i class="fa fa-envelope-o"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'email' );  ?></p>
                            <p><i class="fa fa-phone"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'telefono' );  ?></p>
                            <p><i class="fa fa-whatsapp"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'celular' );  ?></p>
                            <p><i class="fa fa-map-marker"></i> <?php echo cmb2_get_option( 'posmon_admin_main_options', 'ciudad_pais' );  ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>


	
	<!-- <script src="/js/bootstrap.min.js"></script> -->
	<?php wp_footer(); ?>
</body>
</html>