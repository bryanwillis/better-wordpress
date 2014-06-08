<?php
/*
Plugin Name: Better Publish Submit Metabox & Toolbar Publish
Plugin URI: http://wordpress.org/plugins/
Description: This plugin registers a new sidebar widget to be used on the ADMIN SIDE ONLY. When active it replaces the WP Welcome Panel Dashboard Widget.
Version: 0.2
Author: Bryan Willis
Author Email: businesscandid@gmail.com
License:
*/



//* 
// TOOLBAR SUBMIT
add_action('admin_footer', 'submit_button_js_2014SunJune08_Ver1', 999);
function submit_button_js_2014SunJune08_Ver1() {
global $pagenow;
if ( $pagenow == 'post-new.php' || $pagenow == 'nav-menus.php' || $pagenow == 'post.php' ) :    
ob_start(); ?>
<style type="text/css">
@font-face{font-family:icomoon;src:url(http://beausartstudio.wpengine.com/wp-content/icon/publish/icomoon.eot)}@font-face{font-family:icomoon;src:url(data:application/x-font-ttf;charset=utf-8;base64,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) format('truetype'),url(data:application/font-woff;charset=utf-8;base64,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) format('woff');font-weight:400;font-style:normal}[class*=" icon-"],[class^=icon-]{speak:none;font-style:normal;font-weight:400;font-variant:normal;text-transform:none;line-height:1;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.icon-smiley:before{content:"\e600";font-family:icomoon!important}.icon-sad:before{content:"\e601";font-family:icomoon!important}.icon-neutral:before{content:"\e602";font-family:icomoon!important}.icon-wondering:before{content:"\e603";font-family:icomoon!important}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button>.ab-item .ab-label{color:#B70000;font-weight:700}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button:hover #top-toolbar-submit{background-color:#E0E0E0}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button{float:left;background-color:#E0E0E0}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button:hover{float:left;background-color:#e0e0e0;box-shadow:inset 0 -2px 0 rgba(0,0,0,.135)}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button:hover>.ab-item .ab-label{color:#5A8B45;font-weight:700}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button:hover>.ab-item .ab-icon{background-position:0 -16px;color:#5A8B45}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button .ab-icon:before{content:'\e602';font-family:icomoon!important;color:#B70000}#wpadminbar #wp-admin-bar-funky-toolbar-publish-button:hover .ab-icon:before{content:'\e600';font-family:icomoon!important;color:#5A8B45}
</style>
<script type="text/javascript">
(function(e){e.fn.extend({duplicateButton:function(){if(e(this).length){e("li#wp-admin-bar-my-account").before('<li id="wp-admin-bar-funky-toolbar-publish-button"><a class="ab-item" rel="" href="#" id="top-toolbar-submit" for="'+e(this).attr("id")+'"><span class="ab-icon"></span><span class="ab-label">'+e(this).val()+"</span></a></li>");return true}return false}});e(function(t){var n=e('input[type="submit"].button-primary, input[type="button"].button-primary, input[type="submit"].acf-button');if(n.is(":visible")&&!n.is("#bulk_edit")){if(!n.attr("id"))n.first().attr("id","tpb_publish");n.first().duplicateButton()}e("li#wp-admin-bar-funky-toolbar-publish-button a").click(function(t){t.preventDefault();e("#"+e(this).attr("for")).click()})})})(jQuery)
</script>
<?php
echo ob_get_clean();
endif;
}
// */


//* 
// PUBLISH BOX
function hide_show_post_submitbox_misc_actions_2014SunJune08_Ver1() {
    ?> 
<style type="text/css">
#submitdiv{top:93px;z-index:9999999;position:fixed;position:fixed;right:-295px;min-width:295px}#poststuff #submitdiv.closed .inside{display:block}.slider-arrow{position:absolute;top:0;left:-55px;padding:15px 25px;background-color:#fff}.js #submitdiv.postbox .hndle{cursor:pointer}#submitdiv .handlediv{display:none!important}#minor-publishing-actions{padding:10px 25px 0 10px}.misc-pub-section{padding:6px 25px 8px 10px}#major-publishing-actions{padding:10px 25px 10px 10px}#poststuff #submitdiv .inside{display:block}
</style>
<div class="submit-extruder-wrapper"><a href="javascript:void(0);" class="slider-arrow show">&raquo;</a></div>
<script type="text/javascript">
jQuery(document).ready(function(e){e(".slider-arrow").click(function(){if(e(this).hasClass("show")){e(".slider-arrow, #submitdiv").animate({right:"+=295"},300,function(){});e(this).html("&laquo;").removeClass("show").addClass("hide")}else{e(".slider-arrow, #submitdiv").animate({right:"-=295"},300,function(){});e(this).html("&raquo;").removeClass("hide").addClass("show")}});e("#submitdiv").removeClass("closed");e(".js .meta-box-sortables #submitdiv.postbox .handlediv").off()})
</script>
	<?php
}								   
add_action( 'post_submitbox_misc_actions', 'hide_show_post_submitbox_misc_actions_2014SunJune08_Ver1' );
// */