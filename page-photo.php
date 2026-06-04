<?php
/**
 * Template Name: Photo Gallery
 *
 * Full-width photo gallery page. Apply this template to your photo gallery page
 * in WP Admin under Page Attributes > Template.
 */

$GLOBALS['site_back_btn'] = '<a href="' . esc_url( home_url('/') ) . '" class="site-back-btn">← Home</a>';
get_header(); ?>

<style>
    body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--font-body);
  overflow-x: clip;
}
    </style>


<header class="photo-header">
  <div class="photo-header-left">
    <h1>THROUGH<br>THE <em>Lens</em></h1>
  </div>
  <div class="photo-header-right">
    <strong>Photography</strong>
    Austin Rupp
    
  </div>
</header>

<?php if ( get_the_excerpt() ) : ?>
<div class="photo-intro">
  <?php echo wp_kses_post( get_the_excerpt() ); ?>
</div>
<?php endif; ?>


<!-- Gallery content from block editor -->
<div class="photo-content">
  <?php the_content(); ?>
</div>

<!-- Footer CTA -->
<div class="photo-footer-cta">
  <div class="photo-footer-cta-text">
    <div class="eyebrow">◆ See more</div>
    <h2>CHECK OUT<br>THE <em>Work</em></h2>
  </div>
  <div class="photo-footer-links">
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('projects') ) ); ?>" class="photo-footer-link">
      View Projects →
    </a>
    <a href="<?php echo esc_url( home_url('/') ); ?>" class="photo-footer-link">
      Back to Home →
    </a>
  </div>
</div>

<footer class="photo-page-footer">
  <span>Austin Rupp &mdash; Photography</span>
  <span><?php echo date('Y'); ?></span>
</footer>

<?php get_footer(); ?>