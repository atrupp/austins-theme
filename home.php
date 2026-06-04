<?php $GLOBALS['site_back_btn'] = '<a href="' . esc_url( home_url('/') ) . '" class="site-back-btn">← Home</a>'; ?>
<?php get_header(); ?>

<div class="blog-wrap">

  <div class="blog-topbar">
    <span>AUSTIN RUPP — BLOG</span>
  </div>

  <div class="blog-hero">
    <div class="blog-hero-left">
      <div class="blog-eyebrow reveal">◆ THOUGHTS & PROJECTS</div>
      <h1 class="blog-headline reveal" style="transition-delay:0.1s">THE<br><em>Blog.</em></h1>
    </div>
    <p class="blog-hero-right reveal" style="transition-delay:0.2s">
      Writing about design, building things, and whatever else is on my mind.
    </p>
  </div>

  <div class="blog-list">
    <?php if ( have_posts() ) : ?>
      <?php $count = 1; while ( have_posts() ) : the_post(); ?>
        <?php
          $categories = get_the_category();
          $cat_name = $categories ? $categories[0]->name : 'Post';
        ?>
        <a href="<?php the_permalink(); ?>" class="blog-post-item reveal">
          <div class="blog-post-date">
            <?php echo get_the_date('M') . '<br>' . get_the_date('d') . '<br>' . get_the_date('Y'); ?>
          </div>
          <div class="blog-post-body">
            <div class="blog-post-tag"><?php echo esc_html( strtoupper($cat_name) ); ?></div>
            <div class="blog-post-title"><?php the_title(); ?></div>
            <p class="blog-post-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
          </div>
          <span class="blog-post-arrow">→</span>
        </a>
      <?php $count++; endwhile; ?>
    <?php else : ?>
      <div class="blog-empty">
        <div class="blog-empty-title">NOTHING YET.</div>
        <p class="blog-empty-sub">Check back soon — something's brewing.</p>
      </div>
    <?php endif; ?>
  </div>

  <?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
  <div class="blog-pagination">
    <span><?php previous_posts_link('← NEWER POSTS'); ?></span>
    <span><?php next_posts_link('OLDER POSTS →'); ?></span>
  </div>
  <?php endif; ?>

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