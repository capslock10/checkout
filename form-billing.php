<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">

<style>
	.billing_title
	{
		color: #CC0000;
	}
	
	hr
	{
		width: 100%;
	}
</style>
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3 class='billing_title'><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>
		<hr>

	<?php else : ?>

		<h3><?php _e( 'Billing Details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php 
	
		$new_checkout_fields = array();
		$column = 0;
		$row = 0;
		echo '<h3 class="shipping_detail_label">Shipping detail</h3>';
		echo '<hr>';
		echo '<table class="main_table">';
		
		foreach ( $checkout->checkout_fields['billing'] as $key => $field ) 
		{
			
			switch($key)
			{
				case 'address_list':
					$column = 0;
					break;
					
				case 'billing_first_name':
					$column = 1;
					break;
					
				case 'billing_last_name':
					$column = 2;
					break;
					
				case 'billing_country':
					$column = 3;
					break;
					
				case 'billing_email':
					$column = 4;
					break;
			
			}
			
			$new_checkout_fields[$column][$row] = $key;
			$row++;
			$new_checkout_fields[$column][$row] = $field;
			$row = 0;
			
			
			
		}
			
		
		for($i = 0; $i < count($new_checkout_fields); $i++)
		{
			if($i == 0)
				echo '<td class="main_table_row">'
						.'<table class=\'shipping_table\' border="0" cellpadding="0" cellspacing="0">' 
							. '<td>';
			
			if($i == 1)
				echo '<td class="main_table_row">'
						. '<table class=\'billing_table\' border="0" cellpadding="0" cellspacing="0">'
							.'<tr>'
								.'<td>';
	?>
		
		<?php woocommerce_form_field( $new_checkout_fields[$i][0],  $new_checkout_fields[$i][1], $checkout->get_value( $key ) ); ?>

	<?php 
			
			if($i == 0)
			{
			
				echo '</td>'.
				'</table>';
				echo '<p class="address_title">Address:</p>';
					echo '<p>' . '<script>' . 'var e = document.getElementById("address_list");
										  	   var strUser = e.options[e.selectedIndex].text; 
 										       document.write(strUser);' . '</script>';
				
				echo '</td>';
			}
				
			
				
			
			if($i == count($new_checkout_fields) - 1)
				echo '</td>'.
					'</tr>'.
				'</table>'.
				'</td>';
			
						
			
		} 
		
		echo '</table>';
	?>
	<style>
		.shipping_table {
		    width: 100%;
		}
	
		.billing_table
		{
			width: 100%;
		}
		
		.tbody
		{
			border-collapse: collapse;
			width: 100%;
		}

		.main_table
		{
		    border-collapse: collapse;
		    table-layout: fixed;   
		}

		.main_table_row 
		{
		    order-collapse: collapse;
		  	vertical-align: top;
		}
		
		
		.shipping_detail_label
		{
			color: #CC0000;
		}
		
		.address_title
		{
			color: #CC0000;
		}
		
		.entry-content .woocommerce
		{ 
			border-bottom: none;
		}
		
		
		
	
	</style>
	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<p class="form-row form-row-wide create-account">
				<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<div class="create-account">

				<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

				<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>
</div>
