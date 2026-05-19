<?php get_header(); ?>



<div class="cursor" id="cursor"></div>

<!-- HERO -->
<section class="hero">
  <div class="hero-ticker">
    <span>AUSTIN RUPP — WEB DESIGNER</span>
    <div class="hero-ticker-right">
      <span>COLORADO SPRINGS, CO</span>
      <span id="hero-time">—</span>
    </div>
  </div>

  <div class="hero-main">
    <h1 class="hero-headline reveal" style="transition-delay:0.1s">
      DESIGN<br>THAT <em>hits</em><br>DIFFERENT.
    </h1>

    <div class="hero-blob" id="heroBlob">
      <div class="hero-blob-ring"></div>
      <div class="hero-blob-text">VIEW<br>MY WORK</div>
    </div>

    <div class="hero-sub reveal" style="transition-delay:0.2s">
      <p class="hero-bio">
        I design it, build it, and track whether it actually does anything. Front-end development, digital analytics, and SEO --<em> all under one roof.</em>
      </p>
      <div class="hero-stats">
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="1600">0</span>
          <span class="hero-stat-label">Websites Maintained</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="7">0</span>
          <span class="hero-stat-label">YEARS IN</span>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-bottom reveal" style="transition-delay:0.3s">
    <div class="hero-scroll">
      <div class="hero-scroll-line"></div>
      SCROLL
    </div>
    <a href="<?php echo esc_url( get_page_link( get_page_by_path('contact') ) ); ?>" class="hero-cta">
      LET'S TALK →
    </a>
  </div>
</section>



<!-- WORK -->
<section class="work-section">
  <div class="work-header reveal">
    <h2 class="work-title">SELECTED<br><em>Work</em></h2>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('work') ) ); ?>" class="work-link">ALL PROJECTS</a>
  </div>

  <div class="projects-grid">
    <?php
    // Queries child pages of a parent page with the slug 'projects'.
    // In WP Admin: create a page called "Projects", then set each project page's parent to it.
    $projects_parent = get_page_by_path( 'projects' );
    $projects = new WP_Query([
      'post_type'      => 'page',
      'posts_per_page' => 4,
      'post_status'    => 'publish',
      'post_parent'    => $projects_parent ? $projects_parent->ID : 0,
      'orderby'        => 'menu_order',
      'order'          => 'ASC',
    ]);

    $count = 1;
    if ( $projects->have_posts() ) :
      while ( $projects->have_posts() ) : $projects->the_post();
        $num = str_pad($count, 2, '0', STR_PAD_LEFT);
        $excerpt = get_the_excerpt();
    ?>
    <a href="<?php the_permalink(); ?>" class="project-card reveal">
      <span class="project-num"><?php echo esc_html($num); ?></span>
      <span class="project-name"><?php the_title(); ?></span>
      <div class="project-meta">
        <span class="project-type">PROJECT</span>
        <span class="project-desc"><?php echo wp_trim_words( $excerpt, 10 ); ?></span>
      </div>
      <span class="project-arrow">→</span>
    </a>
    <?php
        $count++;
      endwhile;
      wp_reset_postdata();
    else :
      // Placeholder cards if no posts yet
      $placeholders = [
        ['num' => '01', 'name' => 'PROJECT NAME HERE', 'type' => 'WEB DESIGN', 'desc' => 'A short punchy description.'],
        ['num' => '02', 'name' => 'PROJECT NAME HERE', 'type' => 'BRANDING', 'desc' => 'A short punchy description.'],
        ['num' => '03', 'name' => 'PROJECT NAME HERE', 'type' => 'DEVELOPMENT', 'desc' => 'A short punchy description.'],
      ];
      foreach ($placeholders as $p) :
    ?>
    <div class="project-card reveal">
      <span class="project-num"><?php echo esc_html($p['num']); ?></span>
      <span class="project-name"><?php echo esc_html($p['name']); ?></span>
      <div class="project-meta">
        <span class="project-type"><?php echo esc_html($p['type']); ?></span>
        <span class="project-desc"><?php echo esc_html($p['desc']); ?></span>
      </div>
      <span class="project-arrow">→</span>
    </div>
    <?php endforeach; endif; ?>
  </div>
</section>

<!-- GALLERY CTA -->
<div class="gallery-cta reveal">
  <div class="gallery-cta-text">
    <div class="gallery-cta-eyebrow">◆ THE FULL COLLECTION</div>
    <h2 class="gallery-cta-headline">THERE'S<br><em>More</em><br>WHERE THAT<br>CAME FROM.</h2>
    <p class="gallery-cta-sub">Every project tells a story. Come see the rest of the work.</p>
  </div>

  <div class="gallery-cta-buttons">
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('projects') ) ); ?>" class="gallery-btn">
      ENTER<br>GALLERY<br>→
    </a>

    <a href="<?php echo esc_url( get_permalink( get_page_by_path('photo') ) ); ?>" class="gallery-btn">
      ENTER<br>PHOTO GALLERY<br>→
    </a>

    <a href="<?php echo esc_url( get_permalink( get_page_by_path('blog') ) ); ?>" class="gallery-btn">
      ENTER<br>BLOG<br>→
    </a>
  </div>
</div>

<?php get_footer(); ?>

<script>
// Custom cursor
const cursor = document.getElementById('cursor');
let mx = 0, my = 0, cx = 0, cy = 0;

document.addEventListener('mousemove', e => {
  mx = e.clientX - 6;
  my = e.clientY - 6;
});

document.querySelectorAll('a, button, .project-card, .hero-blob').forEach(el => {
  el.addEventListener('mouseenter', () => cursor.classList.add('big'));
  el.addEventListener('mouseleave', () => cursor.classList.remove('big'));
});

function animateCursor() {
  cx += (mx - cx) * 0.18;
  cy += (my - cy) * 0.18;
  cursor.style.transform = `translate(${cx}px, ${cy}px)`;
  requestAnimationFrame(animateCursor);
}
animateCursor();

// Live clock
function updateTime() {
  const now = new Date();
  document.getElementById('hero-time').textContent =
    now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
}
setInterval(updateTime, 1000);
updateTime();

// Blob morph on scroll
const blob = document.getElementById('heroBlob');
window.addEventListener('scroll', () => {
  const s = window.scrollY;
  const r1 = 50 + (s * 0.05) % 30;
  const r2 = 50 - (s * 0.04) % 20;
  blob.style.borderRadius = `${r1}% ${100-r1}% ${r2}% ${100-r2}% / ${100-r2}% ${r1}% ${100-r1}% ${r2}%`;
});

// Scroll reveal
const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver(entries => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      setTimeout(() => entry.target.classList.add('visible'), i * 80);
    }
  });
}, { threshold: 0.1 });

reveals.forEach(el => observer.observe(el));

// Count up numbers
document.querySelectorAll('[data-count]').forEach(el => {
  const target = parseInt(el.dataset.count);
  let current = 0;
  const step = target / 40;
  const timer = setInterval(() => {
    current += step;
    if (current >= target) { el.textContent = target + '+'; clearInterval(timer); }
    else el.textContent = Math.floor(current);
  }, 40);
});
</script>