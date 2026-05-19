<?php
/**
 * Template Name: Project - Case Study
 *
 * Single project page template. Editorial case study layout.
 * Uses the WordPress block editor (Gutenberg) for content via the_content().
 *
 * Custom fields (optional, same as gallery):
 *   - project_tags   (comma-separated, e.g. "Web Design, Hugo, Front-End")
 *   - project_year   (e.g. "2024")
 *   - project_url    (external live URL for the CTA button)
 *   - project_role   (e.g. "Design & Development")
 *   - project_client (e.g. "West Virginia University")
 */

get_header();

$tags    = get_post_meta( get_the_ID(), 'project_tags',   true );
$year    = get_post_meta( get_the_ID(), 'project_year',   true );
$url     = get_post_meta( get_the_ID(), 'project_url',    true );
$role    = get_post_meta( get_the_ID(), 'project_role',   true );
$client  = get_post_meta( get_the_ID(), 'project_client', true );
$tags_arr = $tags ? array_map( 'trim', explode( ',', $tags ) ) : [];
$hero_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );

// Sibling projects for prev/next nav
$siblings = get_pages([
  'post_parent' => wp_get_post_parent_id( get_the_ID() ),
  'sort_column' => 'menu_order',
  'sort_order'  => 'ASC',
]);
$sibling_ids = wp_list_pluck( $siblings, 'ID' );
$current_pos = array_search( get_the_ID(), $sibling_ids );
$prev_project = $current_pos > 0 ? $siblings[ $current_pos - 1 ] : null;
$next_project = $current_pos < count($siblings) - 1 ? $siblings[ $current_pos + 1 ] : null;
?>



<?php if ( $url || get_post_parent( get_the_ID() ) ) :
  $back_url = get_permalink( wp_get_post_parent_id( get_the_ID() ) ) ?: home_url('/');
?>
<a href="<?php echo esc_url( $back_url ); ?>" class="project-back">
  <span>←</span> All Work
</a>
<?php endif; ?>

<!-- Hero -->
<div class="project-hero <?php echo $hero_img ? 'has-image' : 'no-image'; ?>" id="project-hero">
  <?php if ( $hero_img ) : ?>
  <div class="hero-bg" style="background-image: url('<?php echo esc_url($hero_img); ?>')"></div>
  <?php endif; ?>
  <div class="hero-content">
    <div class="hero-meta-row">
      <?php foreach ( $tags_arr as $tag ) : ?>
      <span class="hero-tag"><?php echo esc_html($tag); ?></span>
      <?php endforeach; ?>
      <?php if ( $year ) : ?>
      <span class="hero-year"><?php echo esc_html($year); ?></span>
      <?php endif; ?>
    </div>
    <h1 class="hero-title"><?php the_title(); ?></h1>
    <div class="hero-bottom">
      <p class="hero-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 25 ); ?></p>
      <?php if ( $url ) : ?>
      <a href="<?php echo esc_url($url); ?>" class="hero-cta" target="_blank" rel="noopener">
        VIEW LIVE <span>→</span>
      </a>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Meta strip -->
<?php if ( $client || $role || $year || ! empty($tags_arr) ) : ?>
<div class="project-meta-strip">
  <?php if ( $client ) : ?>
  <div class="meta-cell">
    <div class="meta-label">Client</div>
    <div class="meta-value"><?php echo esc_html($client); ?></div>
  </div>
  <?php endif; ?>
  <?php if ( $role ) : ?>
  <div class="meta-cell">
    <div class="meta-label">Role</div>
    <div class="meta-value"><?php echo esc_html($role); ?></div>
  </div>
  <?php endif; ?>
  <?php if ( $year ) : ?>
  <div class="meta-cell">
    <div class="meta-label">Year</div>
    <div class="meta-value"><?php echo esc_html($year); ?></div>
  </div>
  <?php endif; ?>
  <?php if ( ! empty($tags_arr) ) : ?>
  <div class="meta-cell">
    <div class="meta-label">Disciplines</div>
    <div class="meta-value"><?php echo esc_html( implode(', ', $tags_arr) ); ?></div>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>

<!-- Case study content -->
<article class="project-content">
  <?php the_content(); ?>
</article>

<!-- Prev / Next -->
<?php if ( $prev_project || $next_project ) : ?>
<nav class="project-nav">
  <?php if ( $prev_project ) : ?>
  <a href="<?php echo get_permalink($prev_project->ID); ?>" class="project-nav-item prev">
    <span class="nav-label">Previous</span>
    <span class="nav-title"><?php echo esc_html($prev_project->post_title); ?></span>
    <span class="nav-arrow">←</span>
  </a>
  <?php else : ?>
  <div></div>
  <?php endif; ?>
  <?php if ( $next_project ) : ?>
  <a href="<?php echo get_permalink($next_project->ID); ?>" class="project-nav-item next">
    <span class="nav-label">Next</span>
    <span class="nav-title"><?php echo esc_html($next_project->post_title); ?></span>
    <span class="nav-arrow">→</span>
  </a>
  <?php endif; ?>
</nav>
<?php endif; ?>

<script>
(function () {
  // Hero parallax + entrance
  const hero   = document.getElementById('project-hero');
  const heroBg = hero ? hero.querySelector('.hero-bg') : null;

  if (hero) {
    requestAnimationFrame(() => hero.classList.add('loaded'));
  }

  if (heroBg) {
    window.addEventListener('scroll', () => {
      const scrolled = window.scrollY;
      heroBg.style.transform = `scale(1) translateY(${scrolled * 0.3}px)`;
    }, { passive: true });
  }

  // Image scroll reveal
  const images = document.querySelectorAll('.project-content .wp-block-image');
  if (images.length) {
    const imgObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('img-visible');
          imgObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    images.forEach(img => imgObserver.observe(img));
  }
})();
</script>

<?php get_footer(); ?>