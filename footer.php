<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shroom_Bros
 */

?>

</main><!-- .main -->

<footer class="footer">
  <?php get_template_part( 'components/common/boat' ); ?>


  <?php if ( is_page_template( 'templates/calculator.php' ) ) : ?>
  <?php get_template_part( 'components/product/related-calc' ); ?>
  <?php endif; ?>

  <?php if ( ! is_page_template( 'templates/calculator.php' ) ) : ?>
  <?php get_template_part( 'components/footer/blog' ); ?>
  <?php endif; ?>

  <?php get_template_part( 'components/footer/top' ); ?>

  <?php get_template_part( 'components/footer/bottom' ); ?>
</footer>

<?php get_template_part( 'components/footer/cta-popup' ); ?>

<?php wp_footer(); ?>

</body>

</html>