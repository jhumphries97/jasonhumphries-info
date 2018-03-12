<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package lens
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( lens_load_sidebar() ) : ?>
<div id="secondary" class="widget-area <?php do_action('lens_secondary-width') ?>" role="complementary">
    <form id="respond" METHOD="LINK" ACTION="http://jasonhumphries.info/estherhumphries/wp-content/uploads/2015/08/esther_miller_violin.pdf">
        <p class="form-submit"><input id="submit" class="submit" TYPE="submit" VALUE="Esther's R&eacute;sum&eacute;"/></p>
    </form>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
