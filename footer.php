<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package longhoa
 * @since longhoa 1.0
 */
?>

		</div><!-- #main .site-main -->

		<!-- Facebook Like Box -->
		<div class="fb-wrapper">
			<div class="fb-button"></div>
			<div class="fb-like-box" data-href="http://www.facebook.com/longhoa.maiam" data-width="380" data-height="238" data-border-color="#B6AA9F" data-show-faces="true" data-stream="false" data-header="false">
			</div>
		</div>
		<!-- END Facebook Like Box -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
				<?php do_action( 'longhoa_credits' ); ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon .site-footer -->
	</div><!-- .background -->
</div><!-- #page .hfeed .site -->


<?php wp_footer(); ?>

</body>
</html>