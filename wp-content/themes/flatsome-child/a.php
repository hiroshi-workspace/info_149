<?php

final class PZF {

	protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init_hooks' ) );
	}

	public function init_hooks() {
		add_action( 'wp_footer', array( $this, 'pzf_frontend' ) ); // add frontend to footer	
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) ); //add style to frontend	
		add_action( 'admin_enqueue_scripts', array( $this, 'mw_enqueue_color_picker' ) ); // add scripts to frontend
	}

	//add style to frontend
	public function enqueue_scripts() {
		wp_enqueue_style( 'pzf-style', PZF_URL . 'css/style.css', array() );
	}
	// public function enqueue_scripts() {
	// }

	// add scripts to frontend
	function mw_enqueue_color_picker() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle', PZF_URL . 'js/script.js', array( 'wp-color-picker' ), false, true );
	}

	// add frontend to footer theme
	public function pzf_frontend() { ?>
		<!-- if gom all in one show -->
		<?php if(get_option('pzf_hide_default_all_in_one')){
			$class_active_allinone = '';
		}elseif (!get_option('pzf_enable_all_in_one')) {
			$class_active_allinone = '';
		}
		else{
			$class_active_allinone = 'active';
		}?>
		<div id="button-contact-vr" class="<?php echo $class_active_allinone;?>">
			<div id="gom-all-in-one"><!-- v3 -->
				<!-- contact -->
				<?php
				if(get_option('pzf_contact_link')){
				?>
				<div id="contact-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<a href="<?php echo get_option('pzf_contact_link'); ?>">				
								<img src="<?php echo PZF_URL.'img/contact.png'; ?>" />
							</a>
						</div>
					</div>
					</div>
				<?php }; ?>
				<!-- end contact -->

				<!-- viber -->
				<?php
				if(get_option('pzf_viber')){
				?>
				<div id="viber-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<a target="_blank" href="viber://add?number=<?php echo preg_replace( '/\D/', '',get_option('pzf_viber')); ?>">				
								<img src="https://demo.k-tech-services.com/wp-maybom/wp-content/uploads/2024/10/12312312.png" />
								
								
								
							</a>
						</div>
					</div>
					</div>
				<?php }; ?>
				<!-- end viber -->

				<!-- zalo -->
				<?php
				if(get_option('pzf_zalo')){
				?>
				<div id="zalo-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<a target="_blank" href="https://zalo.me/<?php echo preg_replace( '/\D/', '',get_option('pzf_zalo')); ?>">				
<!-- 								<img src="<?php echo PZF_URL.'img/zalo.png'; ?>" /> -->
								<img src="https://demo.k-tech-services.com/wp-maybom/wp-content/uploads/2024/10/tai_xuong-removebg-preview.png" />
							</a>
						</div>
					</div>
					</div>
				<?php }; ?>
				<!-- end zalo -->

				<!-- Phone -->
				<?php
				if(get_option('pzf_phone')){
				?>
				<div id="phone-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">
							<a href="tel:<?php echo preg_replace( '/\D/', '',get_option('pzf_phone')); ?>">				
<!-- 								<img src="<?php echo PZF_URL.'img/phone.png'; ?>" /> -->
								<img src="https://demo.k-tech-services.com/wp-maybom/wp-content/uploads/2024/10/image-removebg-preview.png" />
								
							</a>
						</div>
					</div>
					</div>
					<?php 
						if(get_option('pzf_phone_bar') == '1'){ ?>
						<div class="phone-bar phone-bar-n">
							<a href="tel:<?php echo preg_replace( '/\D/', '',get_option('pzf_phone')); ?>">
								<span class="text-phone"><?php echo get_option('pzf_phone'); ?></span>
							</a>
						</div>
					<?php };?>

				<?php }; ?>
				<!-- end phone -->
			</div><!-- end v3 class gom-all-in-one -->

			<?php
			if(get_option('pzf_enable_all_in_one')){ ?>
				<div id="all-in-one-vr" class="button-contact">
					<div class="phone-vr">
						<div class="phone-vr-circle-fill"></div>
						<div class="phone-vr-img-circle">			
							<img src="<?php echo PZF_URL.'img/icon'.get_option('pzf_icon_all_in_one').'.png'; ?>" />
						</div>
					</div>					
					<?php 
						if(get_option('pzf_note_bar_all_in_one') == '1'){ ?>
					<div class="phone-bar" style="background-color: <?php echo get_option('pzf_color_all_in_one'); ?>;">
						<span class="text-phone"><?php echo get_option('pzf_note_all_in_one'); ?></span>
					</div>
					<?php };?>
				</div>				
				<style type="text/css">.phone-bar-n{display: none;}</style>
					
<script type="text/javascript">
	jQuery(document).ready(function($){
	    $('#all-in-one-vr').click(function(){
		    $('#button-contact-vr').toggleClass('active');
		})
	});
</script>
			<?php };?>

		</div>
			<!-- Facebook Messenger -->
			<?php
			if(get_option('pzf_id_fanpage')){
			?>
				<!-- Load Facebook SDK for JavaScript -->
				<div id="fb-root"></div>
				<script>
				  window.fbAsyncInit = function() {
				    FB.init({
				      xfbml            : true,
				      version          : 'v3.3'
				    });
				  };

				  (function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>

		<!-- Your customer chat code -->
		<div class="fb-customerchat"
		  attribution=setup_tool
		  page_id="<?php echo get_option('pzf_id_fanpage'); ?>"
		  theme_color="<?php echo get_option('pzf_color_fb') ? get_option("pzf_color_fb") : '#0084ff' ?>"
		  logged_in_greeting="<?php echo get_option('logged_in_greeting') ? get_option("logged_in_greeting") : 'Xin chào! Chúng tôi có thể giúp gì cho bạn?' ?>"
		  logged_out_greeting="<?php echo get_option('logged_in_greeting') ? get_option("logged_in_greeting") : 'Xin chào! Chúng tôi có thể giúp gì cho bạn?' ?>">
		</div>
			<?php }; ?>

			<!-- color phone -->
			<?php if(get_option('pzf_color_phone')){ ?>
				<style>
					.phone-bar a,#phone-vr .phone-vr-circle-fill,#phone-vr .phone-vr-img-circle,#phone-vr .phone-bar a {
					    background-color: <?php echo get_option('pzf_color_phone'); ?>;
					}
					#phone-vr .phone-vr-circle-fill {
					    opacity: 0.7;box-shadow: 0 0 0 0 <?php echo get_option('pzf_color_phone'); ?>;
					}
				</style>
			<?php }; ?>
		<!-- color contact -->
		<?php if(get_option('pzf_color_contact')){ ?>
		<style>
			#contact-vr .phone-vr-circle-fill,#contact-vr .phone-vr-img-circle {
			    background-color: <?php echo get_option('pzf_color_contact'); ?>;
			}
			#contact-vr .phone-vr-circle-fill {
			    opacity: 0.7;box-shadow: 0 0 0 0 <?php echo get_option('pzf_color_contact'); ?>;
			}
		</style>
			<?php };?>
		<!-- color all in one -->
		<?php if(get_option('pzf_color_all_in_one')){ ?>
		<style>
			#all-in-one-vr .phone-vr-circle-fill,#all-in-one-vr .phone-vr-img-circle {
			    background-color: <?php echo get_option('pzf_color_all_in_one'); ?>;
			}
			#all-in-one-vr .phone-vr-circle-fill {
			    opacity: 0.7;box-shadow: 0 0 0 0 <?php echo get_option('pzf_color_all_in_one'); ?>;
			}
		</style>
			<?php };?>

		<!-- size scale -->
		<?php if(get_option('setting_size')){?>
		<style>
			#button-contact-vr {transform: scale(<?php echo get_option('setting_size'); ?>);}
		</style>
		<?php 
			if(get_option('setting_size') < 0.9){ ?>
			<style>
				#button-contact-vr {margin: -10px;}
			</style>
			<?php 
			}elseif (get_option('setting_size') > 1.3) {?>
			<style>
				#button-contact-vr {margin: 10px;}
			</style>
			<?php };
		};?>

		<!-- location left right -->
		<?php if(get_option('pzf_location') == 'right'){ ?>
		<style>
			#button-contact-vr {right:0;}
			.phone-bar a {left: auto;right: 30px;padding: 8px 55px 7px 15px;}
			#button-contact-vr.active #gom-all-in-one .button-contact {margin-left: 100%;}
		</style>
			<?php };?>

		<!-- location bottom -->
		<?php if(get_option('pzf_location_bottom')){ ?>
		<style>
			#button-contact-vr {bottom: <?php echo get_option('pzf_location_bottom'); ?>%;}
		</style>
			<?php };?>

		<!-- hide mobile -->
		<?php if(get_option('pzf_hide_mobile')){ ?>
		<style>
			@media(max-width: 736px){
				#button-contact-vr {display: none;}
			}
		</style>
			<?php };?>

		<!-- hide desktop -->
		<?php if(get_option('pzf_hide_desktop')){ ?>
		<style>
			@media(min-width: 736px){
				#button-contact-vr {display: none;}
			}
		</style>
			<?php };

	}// add frontend to footer theme
}
?>