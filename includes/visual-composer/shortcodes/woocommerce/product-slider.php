<?php
	
	// Shortcode: nm_product_slider
	function nm_shortcode_product_slider( $atts, $content = NULL ) {
		if ( function_exists( 'nm_add_page_include' ) ) {
            nm_add_page_include( 'product-slider' );
        }
		
		extract( shortcode_atts( array(
			'shortcode'  	    => 'recent_products',
            'category'          => '',
			'per_page'          => '12',
			'columns'	        => '4',
            'columns_mobile'    => '1',
			'orderby'	        => 'date',
			'order'		        => 'DESC',
            'arrows'            => ''
		), $atts ) );
		
        $columns_escaped = intval( $columns );
        $columns_mobile_escaped = intval( $columns_mobile );
        $data_settings = 'data-slides-to-show="' . $columns_escaped . '" data-slides-to-scroll="' . $columns_escaped . '" data-slides-to-show-mobile="' . $columns_mobile_escaped . '"';
        
        // GEWIJZIGD: Toon lijstje van vaste SKU's
        // $category_param = ( $shortcode == 'product_category' ) ? ' category="' . $category . '"' : '';
        if ( $shortcode == 'product_category' ) {
        	if ( $category === 'koffie' ) {
        		$shortcode = 'products';
        		$important_products = array( '22025', '22026', '22005', '22023', '22602' );
        		// Wordt nog herordend volgens $orderby! (= menu_order, in te stellen op hoofdniveau)
        		$category_param = ' skus="'.implode( ',', $important_products );
        		// Vul vervolgens aan met overige producten uit de categorie (lijkt subcategorieën ook mee te nemen)
        		$extra_products = wc_get_products( array( 'category' => $category, 'limit' => -1 ) );
        		$skus = array();
        		foreach ( $extra_products as $extra_product ) {
        			if ( ! in_array( $extra_product->get_sku(), $important_products ) ) {
        				$skus[] = $extra_product->get_sku();
        			}
        		}
        		if ( count( $skus ) > 0 ) {
        			// $category_param .= ','.implode( ',', $skus );
        		}
        		$category_param .= '"';
        	} elseif ( $category === 'ontbijt' ) {
        		$shortcode = 'products';
        		$category_param = ' skus="26401,26494,27009,26400,26315,24502"';
        	} elseif ( $category === 'wereldkeuken' ) {
        		$shortcode = 'products';
        		$important_products = array( '28810', '28800', '28021', '28018', '27506', '27813', '27101' );
        		// Wordt nog herordend volgens $orderby! (= menu_order, in te stellen op hoofdniveau)
        		$category_param = ' skus="'.implode( ',', $important_products );
        		// Vul vervolgens aan met overige producten uit de categorie (lijkt subcategorieën ook mee te nemen)
        		$extra_products = wc_get_products( array( 'category' => $category, 'limit' => -1 ) );
        		$skus = array();
        		foreach ( $extra_products as $extra_product ) {
        			if ( ! in_array( $extra_product->get_sku(), $important_products ) ) {
        				$skus[] = $extra_product->get_sku();
        			}
        		}
        		if ( count( $skus ) > 0 ) {
        			// $category_param .= ','.implode( ',', $skus );
        		}
        		$category_param .= '"';
        	} elseif ( $category === 'snacks-drinks' ) {
        		$shortcode = 'products';
        		$category_param = ' skus="24303,21515,25451,21052,24233,20809"';
        	} else {
        		$category_param = ' category="' . $category . '"';
        	}
        } else {
        	$category_param = '';
        }
        
        if ( $arrows !== '' ) {
        	// Voorlopig uitschakelen, wordt niet mooi weergegeven in LIVE
            $data_settings .= ' data-arrows="false"';
        }
        
		$shortcode_string = '[' . $shortcode . ' per_page="' . intval( $per_page ) . '" columns="' . $columns_escaped . '" orderby="' . $orderby . '" order="' . $order . '"' . $category_param . ']';
		
        return '<div class="nm-product-slider col-' . $columns_escaped . '" ' . $data_settings . '>' . do_shortcode( $shortcode_string ) . '</div>';
	}
	
	add_shortcode( 'nm_product_slider', 'nm_shortcode_product_slider' );
	