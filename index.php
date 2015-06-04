<?php
/**
* @version          SEBLOD 3.x Core ~ $Id: index.php alexandrelapoux $
* @package          SEBLOD (App Builder & CCK) // SEBLOD nano (Form Builder)
* @url              http://www.seblod.com
* @editor           Octopoos - www.octopoos.com
* @copyright        Copyright (C) 2013 SEBLOD. All Rights Reserved.
* @license          GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

// -- Initialize
require_once dirname(__FILE__).'/config.php';
$cck    =   CCK_Rendering::getInstance( $this->template );
if ( $cck->initialize() === false ) { return; }

// -- Prepare
$class         			=   trim( $cck->getStyleParam( 'class', '' ) );
$class          		=   $class ? ' class="'.$class.'"' : '';
$display_mode   		=   (int)$cck->getStyleParam( 'list_display', '0' );
$mainid    				= $cck->getStyleParam( 'text_mainid', 'owl-example' );
$removecss   			= $cck->getStyleParam( 'owl_cssjs', '0' );
$owl_pagination 		= $cck->getStyleParam( 'owl_pagination', 'true' );
$owl_paginationnumber 	= $cck->getStyleParam( 'owl_paginationnumber', 'false' );
$owl_scrollPage 		= $cck->getStyleParam( 'owl_scrollpage', 'true' );
$owl_stoponhover  		= $cck->getStyleParam( 'owl_stophover', 'true' );
$owl_autoplay 			= $cck->getStyleParam( 'owl_autoplay', 'true' );
$owl_itemsscaleup 		= $cck->getStyleParam( 'owl_itemsscaleup', 'true' );
$owl_items  			= $cck->getStyleParam( 'owl_items', 'true' );
$owl_navigation 		= $cck->getStyleParam( 'owl_navigation', 'true' );
$owl_responsive 		= $cck->getStyleParam( 'owl_responsive', 'true' );
$slidespeed  			=   (int)$cck->getStyleParam( 'slidespeed', '200' );
$paginationspeed  		=   (int)$cck->getStyleParam( 'paginationspeed', '800' );
$rewindspeed 			=   (int)$cck->getStyleParam( 'rewindspeed', '1000' );
$nav_prev   			= $cck->getStyleParam( 'nav_prev', '«' );
$nav_next  				= $cck->getStyleParam( 'nav_next', '»' );
$corners 				= $cck->getStyleParam( 'corners', '1' );
$text_title   			=   $cck->getStyleParam( 'text_title', '' );
$titlecolor     		=   $cck->getStyleParam( 'titlecolor', '#000000' );
$cornercolor   			=   $cck->getStyleParam( 'cornercolor', '#000000' );
$lazyload   			=   $cck->getStyleParam( 'lazyload', 'false' );
$html          			=   '';
$items          		=   $cck->getItems();
$fieldnames     		=   $cck->getFields( 'element', '', false );
$multiple      			=   ( count( $fieldnames ) > 1 ) ? true : false;
$count         			=   count( $items );
$auto_clean     		=   ( $count == 1 ) ? $cck->getStyleParam( 'auto_clean', 0 ) : 0;
$cck->addStyleDeclaration( $css );

// -- Render
?>

<!-- if item is 1, set the single item value to true - it´s a shortcut for     
		// items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
  -->
<?php
if ($owl_items == 1) {
  $owl_singleitem = "true"; 
} else {
 $owl_singleitem = "false";
}
?>


<!-- If set to remove the main .css and .js is not loaded twice -->

<?php if ($removecss != 1) : ?>
<link rel="stylesheet" href="templates/seb_rotator/css/owl.carousel.css">
<link rel="stylesheet" href="templates/seb_rotator/css/owl.theme.css">
<script src="templates/seb_rotator/js/owl.carousel.js"></script>
<?php endif; ?>



<!-- Hides corners if not selected -->

<?php if ($corners != 0) : ?>

    <style type="text/css">

div.corners_r {
  position: relative;
  padding: 25px;
}

div.topcorner_r, div.bottomcorner_r {
  position: absolute;
  width: 25px;
  height: 25px;
}

div.topcorner_r  {
  top: 0;
  border-top: 5px solid;
}

div.bottomcorner_r  {
  bottom: 0;
  border-bottom: 5px solid;
}

div.leftcorner_r  {
  left: 0;
  border-left: 5px solid;
}

div.rightcorner_r  {
  right: 0;
  border-right: 5px solid;
}
</style>
<?php endif; ?>
<!-- end corners -->

<div style="margin-bottom:15px;">

<!-- Hides corners if not selected -->
<?php if ($corners != 0) : ?>

<div class="corners_r">
<div class="topcorner_r leftcorner_r" style="border-color:<?=$cornercolor?>"> </div>
<div class="topcorner_r rightcorner_r" style="border-color:<?=$cornercolor?>"> </div>
<div class="bottomcorner_r rightcorner_r" style="border-color:<?=$cornercolor?>"> </div>
<div class="bottomcorner_r leftcorner_r" style="border-color:<?=$cornercolor?>"> </div>

<?php endif;?>
<!-- end corners -->


<!-- Rotator Headline inside the corners -->

<?php if (!empty($text_title)) : ?>
<h3 class="title_r" style="color:<?=$titlecolor?>;"><?php echo $text_title; ?></h3>
<?php endif; ?>

<!-- mainid is needed urgently if multiple slides on one page -->

<div id="<?php echo $mainid; ?>" class="owl-carousel">
    <?php 
        $i = 0;
        foreach ( $items as $pk => $item ) { ?>
        
        <div>
    <?php echo $item->renderPosition( 'element' ); ?>
</div>

        <?php $i++; ?>
        <?php } ?>

</div>

</div>

<!-- owl carousel settings -->

<script>
$.noConflict();

<?php if ($lazyload=="true"): ?>

jQuery(function($) {
  $('img').each(function(){
    $(this).attr('data-src', $(this).attr('src'));
    $(this).addClass('lazyOwl');
	$(this).removeAttr('src')

  })
});

<?php endif; ?>

jQuery(document).ready(function($){
$("#<?php echo $mainid; ?>").owlCarousel({
 
  items: <?php echo $owl_items; ?>,
     singleItem: <?php echo $owl_singleitem; ?>,
      pagination : <?php echo $owl_pagination; ?>,
      paginationNumbers: <?php echo $owl_paginationnumber; ?>,
      scrollPerPage: <?php echo $owl_scrollPage; ?>,
      stopOnHover: <?php echo $owl_stoponhover; ?>,
      navigation : <?php echo $owl_navigation; ?>, 
      slideSpeed : <?php echo $slidespeed; ?>,
      paginationSpeed : <?php echo $paginationspeed; ?>,
      rewindSpeed : <?php echo $rewindspeed; ?>,
      autoPlay: <?php echo $owl_autoplay; ?>,
      itemsScaleUp: <?php echo $owl_itemsscaleup; ?>,
      responsive: <?php echo $owl_responsive; ?>,
  responsiveRefreshRate:300,
  lazyLoad: <?php echo $lazyload; ?>,
  navigationText: ["<?php echo $nav_prev; ?>","<?php echo $nav_next; ?>"]
      
  });


});

</script>




<?php
// -- Finalize
$cck->finalize();
?>
