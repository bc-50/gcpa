<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
<<<<<<< HEAD
?>
<div class="cart-wrapper">
  <?php
  do_action( 'woocommerce_before_cart' ); ?>
  
  <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>
  
    <section class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
      
        <?php do_action( 'woocommerce_before_cart_contents' );
  
        // $wp_products = new WP_Query(array(
        //   'post_type' => 'product'
        // ));
        // var_dump($wp_products);
        $mem ="";
        ?>
        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
          $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
          $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
              $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
              
              $mem .= '<div class="woocommerce-cart-form__cart-item row ' . esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) . '">
                
                <div class="product-name col" data-title="'. esc_attr( "Product", "woocommerce" ) .'">
                  <div class="cell-wrapper">
                    ';
                    if ( ! $product_permalink ) {
                      $mem .= wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                    } else {
                      $mem .= wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                    }
        
                    $mem .= do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
        
                    // Meta data.
                    $mem .= wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
        
                    // Backorder notification.
                    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                    $mem .=  wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                    }
                    $mem .= '
                  </div>
                </div>
    
                <div class="product-price col" data-title="'.  esc_attr( "Price", "woocommerce" ) .'">
                  <div class="cell-wrapper">
                    '.
                        apply_filters( "woocommerce_cart_item_price", WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) // PHPCS: XSS ok.
                    .'
                  </div>
                </div>
    
                <div class="product-quantity col" data-title="'. esc_attr( 'Quantity', 'woocommerce' ) .'">
                  <div class="cell-wrapper">
                    ';
                    if ( $_product->is_sold_individually() ) {
                      $mem .=  $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                      $mem .=  $product_quantity = woocommerce_quantity_input(
                        array(
                          'input_name'   => "cart[{$cart_item_key}][qty]",
                          'input_value'  => $cart_item['quantity'],
                          'max_value'    => $_product->get_max_purchase_quantity(),
                          'min_value'    => '0',
                          'product_name' => $_product->get_name(),
                        ),
                        $_product,
                        false
                      );
                    }
        
                      apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                    $mem .= '
                    '.
                          apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                          'woocommerce_cart_item_remove_link',
                          sprintf(
                            '<a href="%s" class="remove-item" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="far fa-trash-alt"></i></a>',
                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                            esc_html__( 'Remove this item', 'woocommerce' ),
                            esc_attr( $product_id ),
                            esc_attr( $_product->get_sku() )
                          ),
                          $cart_item_key
                        )
                      .'
                  </div>
                </div>
    
                <div class="product-subtotal col" data-title="'. esc_attr( 'Subtotal', 'woocommerce' ) .'">
                  <div class="cell-wrapper">
                    '.
                      apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) // PHPCS: XSS ok.
                    .'
                  </div>
                </div>
              </div>
              ';
            }
        }
        ?>
  
        <?php do_action( 'woocommerce_cart_contents' ); ?>
  
        
  
  
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
  
          
          <section class="product-tables">
            <div class="container">
              <div class="row">
                <div class="col"><h3>Product</h3></div>
                <div class="col"><h3>Product Price</h3></div>
                <div class="col"><h3>Product Quantity</h3></div>
                <div class="col"><h3>Subtotal</h3></div>
              </div>
                <?php echo $mem ?>
            </div>
          </section>
      </section>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
  </form>
  
  <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
  
  <div class="cart-collaterals">
    <?php
      /**
       * Cart collaterals hook.
       *
       * @hooked woocommerce_cross_sell_display
       * @hooked woocommerce_cart_totals - 10
       */
      do_action( 'woocommerce_cart_collaterals' );
    ?>
  </div>
  
  <?php do_action( 'woocommerce_after_cart' ); ?>
</div>
=======

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<section class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		
			<?php do_action( 'woocommerce_before_cart_contents' );

      // $wp_products = new WP_Query(array(
      //   'post_type' => 'product'
      // ));
      // var_dump($wp_products);
      $mem ="";
      $tic ="";
      ?>
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				if (isset(get_the_terms($product_id, 'product_cat')[0]->slug) && get_the_terms($product_id, 'product_cat')[0]->slug == 'membership') {
          
          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            
            $mem .= '<tr class="woocommerce-cart-form__cart-item ' . esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) . '">
              
              <td class="product-name" data-title="'. esc_attr( "Product", "woocommerce" ) .'">
                
              ';
              if ( ! $product_permalink ) {
                $mem .= wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
              } else {
                $mem .= wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
              }
  
              $mem .= do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
  
              // Meta data.
              $mem .= wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
  
              // Backorder notification.
              if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
              $mem .=  wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
              }
              $mem .= '
              </td>
  
              <td class="product-price" data-title="'.  esc_attr( "Price", "woocommerce" ) .'">
                
                '.
                    apply_filters( "woocommerce_cart_item_price", WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) // PHPCS: XSS ok.
                .'
              </td>
  
              <td class="product-quantity" data-title="'. esc_attr( 'Quantity', 'woocommerce' ) .'">
                
              ';
              if ( $_product->is_sold_individually() ) {
                $mem .=  $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
              } else {
                $mem .=  $product_quantity = woocommerce_quantity_input(
                  array(
                    'input_name'   => "cart[{$cart_item_key}][qty]",
                    'input_value'  => $cart_item['quantity'],
                    'max_value'    => $_product->get_max_purchase_quantity(),
                    'min_value'    => '0',
                    'product_name' => $_product->get_name(),
                  ),
                  $_product,
                  false
                );
              }
  
                apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
              $mem .= '
              </td>
  
              <td class="product-subtotal" data-title="'. esc_attr( 'Subtotal', 'woocommerce' ) .'">
                <p class="sub-titles">Subtotal:</p>
                '.
                  apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) // PHPCS: XSS ok.
                .'
              </td>
              <td class="product-remove">
                '.
                    apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                      '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove Item</a>',
                      esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                      esc_html__( 'Remove this item', 'woocommerce' ),
                      esc_attr( $product_id ),
                      esc_attr( $_product->get_sku() )
                    ),
                    $cart_item_key
                  )
                .'
              </td>
            </tr>
            ';
          }
        }else{
          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            
            $tic .= '<tr class="woocommerce-cart-form__cart-item ' . esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) . '">
              
              <td class="product-name" data-title="'. esc_attr( "Product", "woocommerce" ) .'">
                
              ';
              if ( ! $product_permalink ) {
                $tic .= wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
              } else {
                $tic .= wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
              }
  
              $tic .= do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
  
              // Meta data.
              $tic .= wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
  
              // Backorder notification.
              if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
              $tic .=  wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
              }
              $tic .= '
              </td>
  
              <td class="product-price" data-title="'.  esc_attr( "Price", "woocommerce" ) .'">
                
                '.
                    apply_filters( "woocommerce_cart_item_price", WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) // PHPCS: XSS ok.
                .'
              </td>
  
              <td class="product-quantity" data-title="'. esc_attr( 'Quantity', 'woocommerce' ) .'">
                
              ';
              if ( $_product->is_sold_individually() ) {
                $tic .=  $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
              } else {
                $tic .=  $product_quantity = woocommerce_quantity_input(
                  array(
                    'input_name'   => "cart[{$cart_item_key}][qty]",
                    'input_value'  => $cart_item['quantity'],
                    'max_value'    => $_product->get_max_purchase_quantity(),
                    'min_value'    => '0',
                    'product_name' => $_product->get_name(),
                  ),
                  $_product,
                  false
                );
              }
  
                apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
              $tic .= '
              </td>
  
              <td class="product-subtotal" data-title="'. esc_attr( 'Subtotal', 'woocommerce' ) .'">
                '.
                  apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) // PHPCS: XSS ok.
                .'
              </td>
              <td class="product-remove">
                '.
                    apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                      '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove Item</a>',
                      esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                      esc_html__( 'Remove this item', 'woocommerce' ),
                      esc_attr( $product_id ),
                      esc_attr( $_product->get_sku() )
                    ),
                    $cart_item_key
                  )
                .'
              </td>
            </tr>
            ';
          }
        }
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			


      <?php do_action( 'woocommerce_after_cart_contents' ); ?>

        
        <section class="product-tables">
          <div class="container-fluid">
            <div class="row memberships">
              <div class="col-10">
                <div class="title-wrapper">
                  <h2>Membership</h2>
                </div>
                <table>
                  <thead>
                    <th>Product</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Subtotal</th>
                    <th>&nbsp;</th>
                  </thead>
                  <tbody>
                    <?php echo $mem ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row tickets">
              <div class="col-10">
                <div class="title-wrapper">
                  <h2>Tickets</h2>
                </div>
                <table>
                  <thead>
                    <th>Product</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Subtotal</th>
                    <th>&nbsp;</th>
                  </thead>
                  <tbody>
                    <?php echo $tic ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
    </section>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
>>>>>>> 3a08c6ab2a7ed7c520fb90b6d68f8fbe2ee42373
