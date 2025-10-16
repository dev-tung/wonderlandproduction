<div class="product-main">
 <div class="row content-row">

 	<div id="product-sidebar" class="col large-3 hide-for-medium shop-sidebar <?php flatsome_sidebar_classes(); ?>">
 		<div class="thongtinsp">
 			<p><?php echo get_post_meta( get_the_ID(), '_vi_tri', true ); ?></p>
 			<span class="price"><?php echo get_post_meta( get_the_ID(), '_gia_hien_thi', true ); ?></span>
 			<span class="btn-care quan_tam js-btn-care" type="button" data-id="<?php echo get_the_ID(); ?>"><span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Quan tâm</span>
 		</div>
		<?php
			do_action('flatsome_before_product_sidebar');
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			if (is_active_sidebar( 'product-sidebar' ) ) {
				dynamic_sidebar('product-sidebar');
			} else if(is_active_sidebar( 'shop-sidebar' )) {
				dynamic_sidebar('shop-sidebar');
			}
		?>
	</div>

	<div class="col large-9">
		<div class="row">
			<div class="large-<?php echo flatsome_option('product_image_width'); ?> col col_image_large">
				<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>

			</div>


			<div class="product-info summary entry-summary col col-fit <?php flatsome_product_summary_classes();?>">
				<?php

				if(get_post_meta( get_the_ID(), '_vi_tri', true ) || get_post_meta( get_the_ID(), '_chieu_cao_tang', true ) || get_post_meta( get_the_ID(), '_chieu_cao_tran', true ) || get_post_meta( get_the_ID(), '_dien_tich_san', true ) || get_post_meta( get_the_ID(), '_do_xe', true ) || get_post_meta( get_the_ID(), '_thang_may', true ) || get_post_meta( get_the_ID(), '_dieu_hoa', true ) || get_post_meta( get_the_ID(), '_dien_du_phong', true ) || get_post_meta( get_the_ID(), '_gio_lam_viec', true )) {
					echo '<div class="box-item tab-item thong_so edit"><div class="tab-title"><strong>Thông số toà nhà</strong></div><div class="tab-content"><ul><li><strong>Vị trí </strong><span>'.get_post_meta( get_the_ID(), '_vi_tri', true ).'</span></li><li><strong>Chiều cao tầng </strong><span>'.get_post_meta( get_the_ID(), '_chieu_cao_tang', true ).'</span></li><li><strong>Chiều cao trần </strong><span>'.get_post_meta( get_the_ID(), '_chieu_cao_tran', true ).'</span></li><li><strong>Diện tích sàn </strong><span>'.get_post_meta( get_the_ID(), '_dien_tich_san', true ).'</span></li><li><strong>Đỗ xe</strong><span>'.get_post_meta( get_the_ID(), '_do_xe', true ).'</span></li></ul><ul><li><strong>Thang máy </strong><span>'.get_post_meta( get_the_ID(), '_thang_may', true ).'</span></li><li><strong>Điều hòa </strong><span>'.get_post_meta( get_the_ID(), '_dieu_hoa', true ).'</span></li><li><strong>Điện dự phòng </strong><span>'.get_post_meta( get_the_ID(), '_dien_du_phong', true ).'</span></li><li><strong>Giờ làm việc </strong><span>'.get_post_meta( get_the_ID(), '_gio_lam_viec', true ).'</span></li><li><strong>Hướng tòa nhà </strong><span>'.get_post_meta( get_the_ID(), '_huong_toa_nha', true ).'</span></li></ul></div></div>';
				}

				if(get_post_meta( get_the_ID(), '_gia_thue_gop', true ) || get_post_meta( get_the_ID(), '_gia_thue', true ) || get_post_meta( get_the_ID(), '_phi_dich_vu', true ) || get_post_meta( get_the_ID(), '_dien_tich_cho_thue_tieu_chuan', true ) || get_post_meta( get_the_ID(), '_do_xe', true ) || get_post_meta( get_the_ID(), '_tien_dien_dieu_hoa', true ) || get_post_meta( get_the_ID(), '_do_xe_may', true ) || get_post_meta( get_the_ID(), '_do_o_to', true ) || get_post_meta( get_the_ID(), '_tien_dien_trong_van_phong', true )) {
					echo '<div class="box-item tab-item thong_so edit"><div class="tab-title"><strong>Chi tiết giá thuê và diện tích</strong></div><div class="tab-content gia_thue"><ul><li><strong>Giá thuê gộp (Giá thuê + Phí dịch vụ) </strong><span>'.get_post_meta( get_the_ID(), '_gia_thue_gop', true ).'</span></li><li><strong>Giá thuê </strong><span>'.get_post_meta( get_the_ID(), '_gia_thue', true ).'</span></li><li><strong>Phí dịch vụ </strong><span>'.get_post_meta( get_the_ID(), '_phi_dich_vu', true ).'</span></li><li><strong>Diện tích cho thuê tiêu chuẩn </strong><span>'.get_post_meta( get_the_ID(), '_dien_tich_cho_thue_tieu_chuan', true ).'</span></li></ul><ul><li><strong>Tiền điện điều hòa </strong><span>'.get_post_meta( get_the_ID(), '_tien_dien_dieu_hoa', true ).'</span></li><li><strong>Đỗ xe máy </strong><span>'.get_post_meta( get_the_ID(), '_do_xe_may', true ).'</span></li><li><strong>Đỗ ô tô </strong><span>'.get_post_meta( get_the_ID(), '_do_o_to', true ).'</span></li><li><strong>Tiền điện trong văn phòng </strong><span>'.get_post_meta( get_the_ID(), '_tien_dien_trong_van_phong', true ).'</span></li></ul></div></div>';
				}
				
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			</div>


			</div>
			<div class="product-footer">
			<?php
					/**
					 * woocommerce_after_single_product_summary hook
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * @hooked woocommerce_upsell_display - 15
					 * @hooked woocommerce_output_related_products - 20
					 */
					do_action( 'woocommerce_after_single_product_summary' );
				?>
			</div>
	
    </div>

</div>
</div>
<?php echo do_shortcode('[block id="lien-he-tu-van-bao-gia"]'); ?>
<?php echo do_shortcode('[block id="doi-ngu-tu-van-luon-san-sang"]'); ?>