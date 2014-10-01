<?php
include_once( dirname(__FILE__).ICWP_DS.'icwp_options_helper.php' );
include_once( dirname(__FILE__).ICWP_DS.'widgets'.ICWP_DS.'icwp_widgets.php' );

$sLatestVersionBranch = '2.x.x';
$sOn = _wptb__( 'On' );
$sOff = _wptb__( 'Off' );
?>

<div class="wrap">
	<div class="bootstrap-wpadmin <?php echo isset($icwp_sFeatureSlug) ? $icwp_sFeatureSlug : ''; ?>">
		<div class="row">
			<div class="span12">
				<?php include_once( dirname(__FILE__).'/icwp-wptb-state_summary.php' ); ?>
			</div>
		</div>
<?php echo printOptionsPageHeader( $icwp_sFeatureName );
