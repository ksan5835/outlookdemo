<h1><?php _e('Right Click Disable OR Ban Settings', RCB_TXT_DM); ?></h1>
	<?php 
	// load settings
	$settings = get_option('awl_save_rcb_settings');
	?>
	<form name="rcb-settings" id="rcb-settings">
	<p class="input-text-wrap">
		<label><?php _e('Disable Right Click For Visitors', RCB_TXT_DM); ?></label><br>
		<?php if(isset($settings['rcb_user_status'])) $rcb_user_status = $settings['rcb_user_status']; else $rcb_user_status = 0; ?>
		<input type="radio" name="rcb_user_status" id="rcb_user_status" value="1" <?php if($rcb_user_status == 1) echo "checked=checked"; ?>>&nbsp;<?php _e('Enable', RCB_TXT_DM); ?><br>
		<input type="radio" name="rcb_user_status" id="rcb_user_status" value="0" <?php if($rcb_user_status == 0) echo "checked=checked"; ?>>&nbsp;<?php _e('Disable', RCB_TXT_DM); ?><br>
		<?php _e('You can enable or disable right click for visitors, users of your site.', RCB_TXT_DM); ?>
	</p>
	
	<p class="input-text-wrap">
		<label><?php _e('Disable Right Click For Admin', RCB_TXT_DM); ?></label><br>
		<?php if(isset($settings['rcb_admin_status'])) $rcb_admin_status = $settings['rcb_admin_status']; else $rcb_admin_status = 0; ?>
		<input type="radio" name="rcb_admin_status" id="rcb_admin_status" value="1" <?php if($rcb_admin_status == 1) echo "checked=checked"; ?>>&nbsp;<?php _e('Enable', RCB_TXT_DM); ?><br>
		<input type="radio" name="rcb_admin_status" id="rcb_admin_status" value="0" <?php if($rcb_admin_status == 0) echo "checked=checked"; ?>>&nbsp;<?php _e('Disable', RCB_TXT_DM); ?><br>
		<?php _e('You can enable or disable right click for admin on site.', RCB_TXT_DM); ?>
	</p>

	<p class="input-text-wrap">
		<label><?php _e('Right Click Disable Message Text', RCB_TXT_DM); ?></label><br>
		<?php if(isset($settings['rcb_msg'])) $rcb_msg = $settings['rcb_msg']; else $rcb_msg = 'Right click is disabled.'; ?>
		<textarea type="text" name="rcb_msg" id="rcb_msg" rows="4" cols="50"><?php echo $rcb_msg; ?></textarea><br>
		<?php _e('Set a message text to display on right click button pressed.', RCB_TXT_DM); ?>
	</p>
	
	<!--
	<p class="input-text-wrap">
		<label><?php _e('Show Right Click Disable Message', RCB_TXT_DM); ?></label><br>
		<label><?php _e('Show Right Click Disable Message', RCB_TXT_DM); ?></label><br>
		<label><?php _e('Show Right Click Disable Message', RCB_TXT_DM); ?></label><br>
		<?php if(isset($settings['rcb_msg_status'])) $rcb_msg_status = $settings['rcb_msg_status']; else $rcb_msg_status = 0; ?>
		<input type="radio" name="rcb_msg_status" id="rcb_msg_status" value="1" <?php if($rcb_msg_status == 1) echo "checked=checked"; ?>>&nbsp;<?php _e('Enable', RCB_TXT_DM); ?><br>
		<input type="radio" name="rcb_msg_status" id="rcb_msg_status" value="0" <?php if($rcb_msg_status == 0) echo "checked=checked"; ?>>&nbsp;<?php _e('Disable', RCB_TXT_DM); ?><br>
		<?php _e('Set ban massge display option.', RCB_TXT_DM); ?>
	</p>
	-->

	<p class="input-text-wrap">
		<input type="button" name="save-rcb-settings" id="save-rcb-settings" value="<?php _e('Save Settings', RCB_TXT_DM); ?>" onclick="return SaveMe();" class="button button-primary button-hero load-customize hide-if-no-customize" >
		<img id="saving-msg" src="<?php echo RCB_PLUGIN_URL."/images/saving.gif"; ?>" style="display: none !important;"/>
	</p>
	</form>
<style>
/* Settings CSS */
.input-text-wrap {
	margin-top: 30px;
	margin-bottom: 10px;
	margin-left: 15px;
}
.input-text-wrap input[type=text] {
	width: 50%;
	border: 1px solid #3366FF;
	border-left: 6px solid #3366FF;
}
.input-text-wrap input[type=radio] {
	border: 1px solid #3366FF;
	margin-bottom: 6px;
}
.input-text-wrap label {
	font-size: 14px;
	font-weight: bolder;
}
.acberror {
    color: red;
	font-weight: bolder;
}
</style>
<script>
function SaveMe() {
	jQuery('.acberror').hide();
	var rcb_user_status = jQuery('input[name="rcb_user_status"]:checked').val();
	var rcb_msg_status = jQuery('input[name="rcb_msg_status"]:checked').val();
	var rcb_admin_status = jQuery('input[name="rcb_admin_status"]:checked').val();
	var rcb_msg = jQuery('#rcb_msg').val();
	if(!rcb_user_status) {
		rcb_user_status = 0;
	}
	if(!rcb_msg_status) {
		rcb_msg_status = 1;
	}
	if(!rcb_admin_status) {
		rcb_admin_status = 1;
	}
	if(rcb_msg == '') {
		rcb_msg = '<?php echo $rcb_msg; ?>';
	}
	jQuery('#save-rcb-settings').hide();
	jQuery('#saving-msg').show();
	
	jQuery.ajax({
		url: location.href,
		type: "post",
		data: { action: '_save_rcb_settings', rcb_user_status: rcb_user_status, rcb_admin_status: rcb_admin_status, rcb_msg: rcb_msg, rcb_msg_status: rcb_msg_status,  },
		success: function(){ 
			jQuery('#saving-msg').hide();
			jQuery('#save-rcb-settings').show();
		}
	});
}
</script>
<?php
//save settings
if ( isset( $_POST['action'] ) == '_save_rcb_settings' ) {
	update_option('awl_save_rcb_settings', $_POST);
}
?>