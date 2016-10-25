<?php

$Data = $this->get_data( 'admin_bar_menu' );
$AllDefaultNodes = $this->admin_bar_filter_load();
$Place_types = $this->admin_bar_places();

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-draggable' , 'jquery-ui-droppable' , 'jquery-ui-sortable' , 'thickbox' );
wp_enqueue_script( $this->PageSlug ,  $this->Url . $this->PluginSlug . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style('thickbox');
wp_enqueue_style( $this->PageSlug , $this->Url . $this->PluginSlug . '.css', array() , $this->Ver );

?>

<div class="wrap">

	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Admin bar' , 'wp-admin-ui-customize' ); ?></h2>
	<p><?php _e( 'Drag menu items to edit and reorder menus.' , 'wp-admin-ui-customize' ); ?></p>
	<p><strong><?php _e( 'Note: Using the same menu item multiple times could cause unexpected behavior.' , 'wp-admin-ui-customize' ); ?></strong></p>
	<p class="description"><?php _e( 'You can use multiple custom menus.' , 'wp-admin-ui-customize' ); ?></p>

	<h3 id="wauc-apply-user-roles"><?php echo $this->get_apply_roles(); ?></h3>

	<p><a href="#TB_inline?height=300&width=600&inlineId=list_variables&modal=false" title="<?php _e( 'Shortcodes' , 'wp-admin-ui-customize' ); ?>" class="thickbox"><?php _e( 'Available Shortcodes' , 'wp-admin-ui-customize' ); ?></a></p>

	<form id="wauc_setting_admin_bar_menu" class="wauc_form" method="post" action="<?php echo esc_url( remove_query_arg( 'wauc_msg' , add_query_arg( array( 'page' => $this->PageSlug ) ) ) ); ?>">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field( $this->Nonces["value"] , $this->Nonces["field"] ); ?>
		<input type="hidden" name="record_field" value="admin_bar_menu" />

		<p></p>
		<p><?php _e( 'Sub menus can be a maximum of four levels deep.' , 'wp-admin-ui-customize' ); ?></p>
		<p><a href="<?php $this->get_document_link( 'admin_bar' ); ?>" target="_blank" class="button-secondary"><?php _e( 'Additional documentation' , 'wp-admin-ui-customize' ); ?></a></p>

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-2">

				<?php foreach( $Place_types as $place => $place_label ) : ?>
					<?php if( $place != 'front' ) : ?>

						<?php if( $place == 'left' ) : $box_id = 2; else: $box_id = 1; endif; ?>
						<div id="postbox-container-<?php echo $box_id; ?>" class="postbox-container">
							<div id="<?php echo $place; ?>_menus">
								<div class="postbox">
									<div class="handlediv" title="Click to toggle"><br></div>
									<h3 class="hndle"><span><?php echo $place_label; ?><?php _e( 'Menus' ); ?></span></h3>
									<div class="inside widgets-holder-wrap">

										<?php if( empty( $Data ) ) : ?>
											<?php $Nodes = $AllDefaultNodes; ?>
										<?php else: ?>
											<?php $Nodes = $Data; ?>
										<?php endif; ?>

										<?php if( !empty( $Nodes[$place]["main"] ) ) : ?>
											<?php foreach( $Nodes[$place]["main"] as $main_node ) : ?>

												<?php if ( is_object( $main_node ) ) $main_node = (array) $main_node; ?>
												<?php if ( !isset( $main_node["group"] ) ) $main_node["group"] = ""; ?>
												<?php $menu_widget = array( 'id' => $main_node["id"] , 'title' => stripslashes( $main_node["title"] ) , 'parent' => '' , 'href' => $main_node["href"] , 'group' => $main_node["group"] , 'meta' => $main_node["meta"] , 'new' => false ); ?>
												<?php $this->admin_bar_menu_widget( $Nodes[$place] , $menu_widget , 'main' ); ?>

											<?php endforeach; ?>
										<?php endif; ?>

									</div>
								</div>
							</div>
						</div>

					<?php endif; ?>
				<?php endforeach; ?>

				<br class="clear">

			</div>

		</div>

		<p class="submit">
			<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
		</p>

		<p class="submit reset">
			<span class="description"><?php printf( __( 'Reset the %s?' , 'wp-admin-ui-customize' ) , __( 'Admin bar' , 'wp-admin-ui-customize' ) . __( 'Settings' ) ); ?></span>
			<input type="submit" class="button-secondary" name="reset" value="<?php _e( 'Reset settings' , 'wp-admin-ui-customize' ); ?>" />
		</p>

	</form>

	<h3><?php _e ( 'Available menu items' , 'wp-admin-ui-customize' ); ?></h3>

	<div id="can_menus" class="metabox-holder columns-1">

		<div class="postbox">
			<div class="inside">

				<div class="postbox">
					<div class="handlediv" title="Click to toggle"><br></div>
					<h3 class="hndle"><span><?php _e( 'Custom' , 'wp-admin-ui-customize' ); ?> <?php _e( 'Menus' ); ?></span></h3>
					<div class="inside">

						<?php $menu_widget = array( 'id' => "custom_node" , 'title' => "" , 'parent' => '' , 'href' => "" , 'group' => "" , 'meta' => array() , 'new' => true ); ?>
						<?php $this->admin_bar_menu_widget( $AllDefaultNodes["front"] , $menu_widget , 'custom' ); ?>
						<?php $menu_widget = array( 'id' => "custom_node" , 'title' => "" , 'parent' => '' , 'href' => "" , 'group' => 1 , 'meta' => array() , 'new' => true ); ?>
						<?php $this->admin_bar_menu_widget( $AllDefaultNodes["front"] , $menu_widget , 'custom' ); ?>
						<div class="clear"></div>

					</div>
				</div>

				<?php foreach( $Place_types as $place => $place_label ) : ?>

					<div class="postbox">
						<div class="handlediv" title="Click to toggle"><br></div>
						<h3 class="hndle"><span><?php echo $place_label; ?> <?php _e( 'Menus' ); ?></span></h3>
						<div class="inside">

							<?php if( !empty( $AllDefaultNodes[$place] ) ) : ?>
								<?php foreach( $AllDefaultNodes[$place]["main"] as $main_node_id => $main_node ) : ?>
		
									<p class="description"><?php echo $main_node_id; ?></p>
									<?php $menu_widget = array( 'id' => $main_node_id , 'title' => stripslashes( $main_node->title ) , 'parent' => '' , 'href' => $main_node->href , 'group' => $main_node->group , 'meta' => $main_node->meta , 'new' => true ); ?>
									<?php $this->admin_bar_menu_widget( $AllDefaultNodes[$place] , $menu_widget , 'main' ); ?>
		
									<?php foreach( $AllDefaultNodes[$place]["sub"] as $sub_node_id => $sub_node ) : ?>
										<?php if( $sub_node->parent == $main_node_id ) : ?>
		
											<?php $menu_widget = array( 'id' => $sub_node_id , 'title' => stripslashes( $sub_node->title ) , 'parent' => '' , 'href' => $sub_node->href , 'group' => $sub_node->group , 'meta' => $sub_node->meta , 'new' => true ); ?>
											<?php $this->admin_bar_menu_widget( $AllDefaultNodes[$place] , $menu_widget , 'sub' ); ?>
		
											<?php if( !empty( $AllDefaultNodes[$place]["sub2"] ) ) : ?>
												<?php foreach( $AllDefaultNodes[$place]["sub2"] as $sub_node_id2 => $sub_node2 ) : ?>
													<?php if( $sub_node2->parent == $sub_node_id ) : ?>
		
														<?php $menu_widget = array( 'id' => $sub_node_id2 , 'title' => stripslashes( $sub_node2->title ) , 'parent' => '' , 'href' => $sub_node2->href , 'group' => $sub_node2->group , 'meta' => $sub_node2->meta , 'new' => true ); ?>
														<?php $this->admin_bar_menu_widget( $AllDefaultNodes[$place] , $menu_widget , 'sub2' ); ?>
		
														<?php if( !empty( $AllDefaultNodes[$place]["sub3"] ) ) : ?>
															<?php foreach( $AllDefaultNodes[$place]["sub3"] as $sub_node_id3 => $sub_node3 ) : ?>
																<?php if( $sub_node3->parent == $sub_node_id2 ) : ?>
								
																	<?php $menu_widget = array( 'id' => $sub_node_id3 , 'title' => stripslashes( $sub_node3->title ) , 'parent' => '' , 'href' => $sub_node3->href , 'group' => $sub_node3->group , 'meta' => $sub_node3->meta , 'new' => true ); ?>
																	<?php $this->admin_bar_menu_widget( $AllDefaultNodes[$place] , $menu_widget , 'sub3' ); ?>
				
																	<?php if( !empty( $AllDefaultNodes[$place]["sub4"] ) ) : ?>
																		<?php foreach( $AllDefaultNodes[$place]["sub4"] as $sub_node_id4 => $sub_node4 ) : ?>
																			<?php if( $sub_node4->parent == $sub_node_id3 ) : ?>
		
																				<?php $menu_widget = array( 'id' => $sub_node_id4 , 'title' => stripslashes( $sub_node4->title ) , 'parent' => '' , 'href' => $sub_node4->href , 'group' => $sub_node4->group , 'meta' => $sub_node4->meta , 'new' => true ); ?>
																				<?php $this->admin_bar_menu_widget( $AllDefaultNodes[$place] , $menu_widget , 'sub4' ); ?>
		
																			<?php endif; ?>
																		<?php endforeach; ?>
																	<?php endif; ?>
		
																<?php endif; ?>
															<?php endforeach; ?>
														<?php endif; ?>
		
													<?php endif; ?>
												<?php endforeach; ?>
											<?php endif; ?>
		
										<?php endif; ?>
									<?php endforeach; ?>
	
									<div class="clear"></div>
		
								<?php endforeach; ?>
							<?php endif; ?>

						</div>
					</div>
				<?php endforeach; ?>

			</div>
		</div>

	</div>

</div>

<?php require_once( dirname( __FILE__ ) . '/list_variables.php' ); ?>

<style>
body.wp-admin-ui-customize_page_wp_admin_ui_customize_admin_bar .postbox .inside .widget.wp-logo .widget-top .widget-title h4 .ab-icon,
body.wp-admin-ui-customize_page_wp_admin_ui_customize_admin_bar .postbox .inside .widget.updates .widget-top .widget-title h4 .ab-icon,
body.wp-admin-ui-customize_page_wp_admin_ui_customize_admin_bar .postbox .inside .widget.comments .widget-top .widget-title h4 .ab-icon,
body.wp-admin-ui-customize_page_wp_admin_ui_customize_admin_bar .postbox .inside .widget.new-content .widget-top .widget-title h4 .ab-icon
{ background-image: url(../wp-includes/images/admin-bar-sprite.png); }
.widget h4 {
    padding: 10px 15px;
}
.widget-top a.widget-action {
    cursor: pointer;
}
.widget.ui-draggable-dragging {
    min-width: 170px;
}
</style>

<script type="text/javascript">

var wauc_widget_each, wauc_menu_sortable;

jQuery(document).ready(function($) {

	var $Form = $("#wauc_setting_admin_bar_menu");
	var $AddInside = $('#can_menus .postbox .inside');
	var $SettingInside = $('#poststuff #post-body .postbox-container .postbox .inside', $Form);

	$AddInside.children('.widget').draggable({
		connectToSortable: '#poststuff #post-body .postbox-container .postbox .inside',
		handle: '> .widget-top > .widget-title',
		distance: 2,
		helper: 'clone',
		zIndex: 5,
		stop: function(e,ui) {
			wauc_widget_each();
			wauc_menu_sortable();
		}
	});

	$('#can_menus').droppable({
		tolerance: 'pointer',
		accept: function(o){
			return $(o).parent().parent().parent().parent().parent().parent().parent().attr('class') != 'columns-1';
		},
		drop: function(e,ui) {
			ui.draggable.addClass('deleting');
		},
		over: function(e,ui) {
			ui.draggable.addClass('deleting');
			$('div.widget-placeholder').hide();
		},
		out: function(e,ui) {
			ui.draggable.removeClass('deleting');
			$('div.widget-placeholder').show();
		}
	});

	$(document).on('click', '.widget .widget-top .widget-title-action', function() {
		
		$(this).parent().parent().children('.widget-inside').slideToggle( 300 );
		return false;

	});

	$(document).on('click', '.widget .widget-inside .widget-control-actions .alignleft a[href="#remove"]', function() {
		
		$(this).parent().parent().parent().parent().slideUp('normal', function() { $(this).remove(); } );
		return false;

	});

	wauc_menu_sortable = function menu_sortable() {

		$('#wauc_setting_admin_bar_menu #poststuff #post-body .postbox-container .postbox .inside, #wauc_setting_admin_bar_menu #poststuff #post-body .postbox-container .postbox .inside .widget .widget-inside .submenu').sortable({
			placeholder: "widget-placeholder",
			items: '> .widget',
			connectWith: "#wauc_setting_admin_bar_menu #poststuff #post-body .postbox-container .postbox .inside, #wauc_setting_admin_bar_menu #poststuff #post-body .postbox-container .postbox .inside .widget .widget-inside .submenu",
			handle: '> .widget-top > .widget-title',
			cursor: 'move',
			distance: 2,
			change: function(e,ui) {
				var $height = ui.helper.height();
				$('#wauc_setting_admin_bar_menu #poststuff #post-body .postbox-container .postbox .inside .widget-placeholder').height($height);
			},
			stop: function(e,ui) {
				if ( ui.item.hasClass('deleting') ) {
					ui.item.remove();
				}
				ui.item.attr( 'style', '' ).removeClass('ui-draggable');
				wauc_widget_each();
			},
		});

	}
	wauc_menu_sortable();

	wauc_widget_each = function widget_each() {
		var $Count = 0;
		$('.widget', '#wauc_setting_admin_bar_menu #poststuff').each(function() {
			var $InputId = $(this).children(".widget-inside").children(".settings").children(".field-url").children(".idtext");
			var $InputLink = $(this).children(".widget-inside").children(".settings").children(".field-url").children(".linktext");
			var $InputTitle = $(this).children(".widget-inside").children(".settings").children(".field-title").children("label").children(".titletext");
			var $InputGourp = $(this).children(".widget-inside").children(".settings").children(".group");
			var $InputMetaClass = $(this).children(".widget-inside").children(".settings").children(".field-meta").children(".meta_class");
			var $InputMetaTarget = $(this).children(".widget-inside").children(".settings").children(".field-meta").children("label").children(".meta_target");
			var $InputParentName = $(this).children(".widget-inside").children(".settings").children(".parent");
			var $InputNodeType = $(this).children(".widget-inside").children(".settings").children(".node_type");

			var $BoxName = "";
			var $NodeType = "";
			if( $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().hasClass("submenu") ) {
				$BoxName = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr("id");
				$NodeType = "sub4";
			} else if( $(this).parent().parent().parent().parent().parent().parent().parent().hasClass("submenu") ) {
				$BoxName = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().attr("id");
				$NodeType = "sub3";
			} else if( $(this).parent().parent().parent().parent().hasClass("submenu") ) {
				$BoxName = $(this).parent().parent().parent().parent().parent().parent().parent().parent().parent().attr("id");
				$NodeType = "sub2";
			} else if( $(this).parent().hasClass("submenu") ) {
				$BoxName = $(this).parent().parent().parent().parent().parent().parent().attr("id");
				$NodeType = "sub";
			} else {
				$BoxName = $(this).parent().parent().parent().attr("id");
				$NodeType = "main";
			}
			
			if( $BoxName ) {
				var $BarType = $BoxName.replace( '_menus' , '');
			}

			if( $(this).hasClass("custom_node") ) {
				var $CustomVal = $InputId.val();
				$InputId.val( $CustomVal + Math.ceil( Math.random() * 1000 ) );
			} else if( $(this).hasClass("newcustom_node") ) {
				var $CustomVal = $InputId.val();
				var $CustomClassName = $CustomVal + Math.ceil( Math.random() * 1000 );
				$InputId.val( $CustomClassName );
				$(this).removeClass("newcustom_node");
				$(this).addClass( $CustomClassName );
			}

			var $Name = 'data' + '[' + $BarType + ']['+$Count+']';
			$InputId.attr("name", $Name+'[id]');
			$InputLink.attr("name", $Name+'[href]');
			$InputTitle.attr("name", $Name+'[title]');
			$InputGourp.attr("name", $Name+'[group]');
			$InputMetaClass.attr("name", $Name+'[meta][class]');
			$InputMetaTarget.attr("name", $Name+'[meta][target]');
			$InputParentName.attr("name", $Name+'[parent]');
			$InputNodeType.attr("name", $Name+'[node_type]');
			$InputNodeType.val( $NodeType );

			if ( $(this).parent().hasClass("submenu") ) {
				var $ParentId = $(this).parent().parent().children(".settings").children(".description").children(".idtext").val();
				$InputParentName.val($ParentId);
			} else {
				$InputParentName.val('');
			}

			$Count++;
		});
	}
	wauc_widget_each();
		
});
</script>