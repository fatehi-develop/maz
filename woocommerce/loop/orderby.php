<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<form class="woocommerce-ordering row" method="get">
	<div class="col-8 col-sm-6 col-lg-4 mb-3 mb-lg-0">
		<div class="orderby-wrap">
			<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
				<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
					<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	
	<div class="col-4 col-sm-6 col-lg-4 mb-3 mb-lg-0">
		<label class="btn-switch">
			<?php
			$stock = ( isset($_GET['stock']) )? $_GET['stock'] : '';
			?>
			<input type="checkbox" name="stock" class="switch-input" id="shp-checkbox" <?php if($stock == 'true')echo'checked';?> value="true" onchange="this.form.submit()" />
			<span class="btn-slider"></span>
			<p>کالاهای موجود</p>
		</label>
		<input type="hidden" name="paged" value="1" />
		<?php wc_query_string_form_fields( null, array( 'orderby', 'submit','stock', 'paged', 'product-page' ) ); ?>
	</div>
</form>

