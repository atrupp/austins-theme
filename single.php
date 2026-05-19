<?php get_header(); ?>




<div class="single-wrap">

  <div class="single-topbar">
    <a href="<?php echo esc_url( get_permalink( get_option('page_for_posts') ) ); ?>">BLOG</a>
    <span>AUSTIN RUPP</span>
  </div>

  <?php while ( have_posts() ) : the_post(); ?>

    <div class="single-header reveal">
      <div class="single-meta">
        <?php
          $categories = get_the_category();
          if ( $categories ) :
        ?>
          <span class="single-meta-cat"><?php echo esc_html( strtoupper($categories[0]->name) ); ?></span>
        <?php endif; ?>
        <span><?php echo get_the_date('F j, Y'); ?></span>
        <span><?php echo ceil( str_word_count( strip_tags( get_the_content() ) ) / 200 ); ?> MIN READ</span>
      </div>
      <h1 class="single-title"><?php the_title(); ?></h1>
    </div>

    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('full', ['class' => 'single-featured']); ?>
    <?php endif; ?>

    <div class="single-content-wrap">
      <div class="single-content reveal">
        <?php the_content(); ?>
      </div>
    </div>

    <div class="single-footer">
      <div style="display:flex; gap:4rem; flex-wrap:wrap;">
        <?php $prev = get_previous_post(); if ($prev) : ?>
        <div class="single-footer-nav">
          <span class="single-footer-label">← PREVIOUS</span>
          <a href="<?php echo esc_url( get_permalink($prev) ); ?>" class="single-footer-link">
            <?php echo esc_html( get_the_title($prev) ); ?>
          </a>
        </div>
        <?php endif; ?>
        <?php $next = get_next_post(); if ($next) : ?>
        <div class="single-footer-nav">
          <span class="single-footer-label">NEXT →</span>
          <a href="<?php echo esc_url( get_permalink($next) ); ?>" class="single-footer-link">
            <?php echo esc_html( get_the_title($next) ); ?>
          </a>
        </div>
        <?php endif; ?>
      </div>
      <a href="<?php echo esc_url( get_permalink( get_option('page_for_posts') ) ); ?>" class="single-back-btn">
        ALL POSTS →
      </a>
    </div>

  <?php endwhile; ?>

</div>

<?php get_footer(); ?>

<script>
const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver(entries => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      setTimeout(() => entry.target.classList.add('visible'), i * 80);
    }
  });
}, { threshold: 0.1 });
reveals.forEach(el => observer.observe(el));
</script>