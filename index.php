<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Austin\'s_Theme
 */

get_header();
?>

	<main id="primary" class="site-main container">
		<div class="row">
	<div class="col-8">
		<?php get_header(); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Instrument+Serif:ital@0;1&family=DM+Mono:wght@300;400;500&display=swap');

:root {
  --ink: #0d0d0d;
  --paper: #f2efe8;
  --accent: #ff3c2e;
  --mid: #8a8680;
  --loud: #ff3c2e;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  background: var(--paper);
  color: var(--ink);
  overflow-x: hidden;
}

/* ── CURSOR ── */
.cursor {
  width: 12px; height: 12px;
  background: var(--accent);
  border-radius: 50%;
  position: fixed;
  top: 0; left: 0;
  pointer-events: none;
  z-index: 9999;
  transition: transform 0.15s ease, width 0.2s, height 0.2s;
  mix-blend-mode: multiply;
}
.cursor.big { width: 60px; height: 60px; transform: translate(-24px, -24px); }

/* ── HERO ── */
.hero {
  min-height: 100vh;
  display: grid;
  grid-template-rows: auto 1fr auto;
  padding: 2rem 3rem;
  position: relative;
  overflow: hidden;
}

.hero-ticker {
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.2em;
  color: var(--mid);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 2rem;
  border-bottom: 1px solid rgba(0,0,0,0.1);
}

.hero-ticker-right {
  display: flex;
  gap: 2rem;
}

.hero-main {
  display: flex;
  flex-direction: column;
  justify-content: center;
  position: relative;
  padding: 4rem 0;
}

.hero-eyebrow {
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.3em;
  color: var(--accent);
  margin-bottom: 1.5rem;
}

.hero-headline {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(5rem, 14vw, 13rem);
  line-height: 0.9;
  letter-spacing: -0.01em;
  color: var(--ink);
  position: relative;
  z-index: 2;
}

.hero-headline em {
  font-family: 'Instrument Serif', serif;
  font-style: italic;
  color: var(--accent);
}

.hero-blob {
  position: absolute;
  right: -5%;
  top: 50%;
  transform: translateY(-50%);
  width: 420px;
  height: 420px;
  border-radius: 50%;
  background: var(--ink);
  z-index: 1;
  transition: border-radius 0.8s ease;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.hero-blob:hover {
  border-radius: 38% 62% 70% 30% / 30% 50% 50% 70%;
}

.hero-blob-text {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 1.4rem;
  color: var(--paper);
  letter-spacing: 0.2em;
  text-align: center;
  z-index: 2;
  position: relative;
  user-select: none;
}

.hero-blob-ring {
  position: absolute;
  width: 100%; height: 100%;
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 50%;
  animation: spin 12s linear infinite;
}

.hero-blob-ring::before {
  content: 'SCROLL TO EXPLORE ◆ VIEW MY WORK ◆ AUSTIN RUPP ◆ WEB DESIGNER ◆ ';
  position: absolute;
  top: -10px;
  left: 50%;
  transform: translateX(-50%);
  font-family: 'DM Mono', monospace;
  font-size: 9px;
  letter-spacing: 0.15em;
  color: rgba(255,255,255,0.3);
  white-space: nowrap;
}

@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

.hero-sub {
  margin-top: 3rem;
  display: flex;
  gap: 3rem;
  align-items: flex-start;
  position: relative;
  z-index: 3;
}

.hero-bio {
  font-family: 'Instrument Serif', serif;
  font-size: 1.35rem;
  line-height: 1.5;
  color: var(--ink);
  max-width: 380px;
}

.hero-bio em { color: var(--accent); font-style: italic; }

.hero-stats {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.hero-stat {
  display: flex;
  align-items: baseline;
  gap: 0.75rem;
}

.hero-stat-num {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 2.5rem;
  color: var(--ink);
  line-height: 1;
}

.hero-stat-label {
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.15em;
  color: var(--mid);
}

.hero-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 2rem;
  border-top: 1px solid rgba(0,0,0,0.1);
}

.hero-scroll {
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.2em;
  color: var(--mid);
  display: flex;
  align-items: center;
  gap: 1rem;
}

.hero-scroll-line {
  width: 60px;
  height: 1px;
  background: var(--mid);
  animation: scrollpulse 2s ease-in-out infinite;
}

@keyframes scrollpulse {
  0%,100% { width: 60px; opacity: 1; }
  50% { width: 100px; opacity: 0.4; }
}

.hero-cta {
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.15em;
  color: var(--paper);
  background: var(--ink);
  border: none;
  padding: 14px 32px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  transition: background 0.2s, letter-spacing 0.2s;
}

.hero-cta:hover {
  background: var(--accent);
  letter-spacing: 0.25em;
  color: var(--paper);
}

/* ── MARQUEE ── */
.marquee-wrap {
  background: var(--ink);
  padding: 1.2rem 0;
  overflow: hidden;
  white-space: nowrap;
}

.marquee-track {
  display: inline-flex;
  animation: marquee 18s linear infinite;
}

.marquee-item {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 1.1rem;
  letter-spacing: 0.15em;
  color: var(--paper);
  padding: 0 2.5rem;
}

.marquee-item.red { color: var(--accent); }

@keyframes marquee {
  from { transform: translateX(0); }
  to { transform: translateX(-50%); }
}

/* ── WORK ── */
.work-section {
  padding: 6rem 3rem;
}

.work-header {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  margin-bottom: 4rem;
}

.work-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(3rem, 6vw, 5rem);
  line-height: 1;
}

.work-title em {
  font-family: 'Instrument Serif', serif;
  font-style: italic;
  color: var(--accent);
}

.work-link {
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.2em;
  color: var(--mid);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  transition: color 0.2s, gap 0.2s;
}

.work-link:hover { color: var(--ink); gap: 1.5rem; }
.work-link::after { content: '→'; }

/* PROJECT CARDS */
.projects-grid {
  display: flex;
  flex-direction: column;
  gap: 0;
}

.project-card {
  display: grid;
  grid-template-columns: 80px 1fr 1fr auto;
  align-items: center;
  gap: 2rem;
  padding: 2.5rem 0;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  cursor: pointer;
  position: relative;
  transition: padding-left 0.3s ease;
  text-decoration: none;
  color: inherit;
}

.project-card:first-child { border-top: 1px solid rgba(0,0,0,0.1); }

.project-card:hover { padding-left: 1rem; }

.project-card::before {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 0;
  background: var(--accent);
  transition: width 0.3s ease;
}

.project-card:hover::before { width: 4px; }

.project-num {
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.1em;
  color: var(--mid);
}

.project-name {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(2rem, 3.5vw, 3rem);
  line-height: 1;
  transition: color 0.2s;
}

.project-card:hover .project-name { color: var(--accent); }

.project-meta {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

.project-type {
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.2em;
  color: var(--mid);
}

.project-desc {
  font-family: 'Instrument Serif', serif;
  font-size: 1rem;
  color: var(--ink);
  opacity: 0.6;
}

.project-arrow {
  font-size: 1.5rem;
  color: var(--mid);
  transition: transform 0.3s, color 0.2s;
}

.project-card:hover .project-arrow {
  transform: translateX(8px);
  color: var(--accent);
}

/* ── GALLERY CTA ── */
.gallery-cta {
  margin: 2rem 3rem 6rem;
  background: var(--ink);
  padding: 5rem 4rem;
  display: grid;
  grid-template-columns: 1fr auto;
  align-items: center;
  gap: 2rem;
  position: relative;
  overflow: hidden;
}

.gallery-cta::before {
  content: 'GALLERY';
  position: absolute;
  right: -2rem;
  top: 50%;
  transform: translateY(-50%) rotate(90deg);
  font-family: 'Bebas Neue', sans-serif;
  font-size: 8rem;
  color: rgba(255,255,255,0.03);
  letter-spacing: 0.1em;
  pointer-events: none;
}

.gallery-cta-eyebrow {
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.3em;
  color: var(--accent);
  margin-bottom: 1.5rem;
}

.gallery-cta-headline {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(3rem, 6vw, 5.5rem);
  line-height: 0.95;
  color: var(--paper);
}

.gallery-cta-headline em {
  font-family: 'Instrument Serif', serif;
  font-style: italic;
}

.gallery-cta-sub {
  font-family: 'Instrument Serif', serif;
  font-size: 1.1rem;
  color: rgba(242,239,232,0.5);
  margin-top: 1.5rem;
  max-width: 400px;
}

.gallery-btn {
  width: 160px;
  height: 160px;
  border-radius: 50%;
  border: 1px solid rgba(255,255,255,0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.15em;
  color: var(--paper);
  text-decoration: none;
  text-align: center;
  transition: background 0.3s, border-color 0.3s, transform 0.3s;
  flex-shrink: 0;
}

.gallery-btn:hover {
  background: var(--accent);
  border-color: var(--accent);
  color: var(--paper);
  transform: scale(1.08);
}

/* ── NOISE ── */
body::after {
  content: '';
  position: fixed;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 9998;
  opacity: 0.4;
}

/* ── REVEAL ANIMATIONS ── */
.reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}

.reveal.visible {
  opacity: 1;
  transform: translateY(0);
}

@media (max-width: 768px) {
  .hero { padding: 1.5rem; }
  .hero-blob { display: none; }
  .hero-sub { flex-direction: column; gap: 2rem; }
  .work-section { padding: 4rem 1.5rem; }
  .project-card { grid-template-columns: 50px 1fr auto; gap: 1rem; }
  .project-meta { display: none; }
  .gallery-cta { margin: 1rem 1.5rem 4rem; padding: 3rem 2rem; grid-template-columns: 1fr; }
  .gallery-btn { width: 120px; height: 120px; }
}
</style>

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
    <div class="hero-eyebrow reveal">◆ AVAILABLE FOR PROJECTS</div>
    <h1 class="hero-headline reveal" style="transition-delay:0.1s">
      DESIGN<br>THAT <em>hits</em><br>DIFFERENT.
    </h1>

    <div class="hero-blob" id="heroBlob">
      <div class="hero-blob-ring"></div>
      <div class="hero-blob-text">VIEW<br>MY WORK</div>
    </div>

    <div class="hero-sub reveal" style="transition-delay:0.2s">
      <p class="hero-bio">
        Web designer who builds things that <em>actually work.</em>
        From concept to code — sharp visuals, clean builds, zero fluff.
      </p>
      <div class="hero-stats">
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="12">0</span>
          <span class="hero-stat-label">PROJECTS SHIPPED</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="3">0</span>
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

<!-- MARQUEE -->
<div class="marquee-wrap">
  <div class="marquee-track">
    <?php
    $items = ['WEB DESIGN', '◆', 'WORDPRESS', '◆', 'BOOTSTRAP', '◆', 'UI/UX', '◆', 'BRANDING', '◆', 'DEVELOPMENT', '◆', 'COLORADO', '◆'];
    for ($i = 0; $i < 4; $i++) {
      foreach ($items as $idx => $item) {
        $class = $item === '◆' ? 'marquee-item red' : 'marquee-item';
        echo '<span class="' . $class . '">' . esc_html($item) . '</span>';
      }
    }
    ?>
  </div>
</div>

<!-- WORK -->
<section class="work-section">
  <div class="work-header reveal">
    <h2 class="work-title">SELECTED<br><em>Work</em></h2>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('work') ) ); ?>" class="work-link">ALL PROJECTS</a>
  </div>

  <div class="projects-grid">
    <?php
    // Pull latest 4 projects — using pages with category or just latest posts
    // Swap post_type to 'project' if you add a custom post type later
    $projects = new WP_Query([
      'post_type'      => 'post',
      'posts_per_page' => 4,
      'post_status'    => 'publish',
    ]);

    $count = 1;
    if ( $projects->have_posts() ) :
      while ( $projects->have_posts() ) : $projects->the_post();
        $num = str_pad($count, 2, '0', STR_PAD_LEFT);
        $tags = get_the_tags();
        $tag_name = $tags ? $tags[0]->name : 'Web Design';
    ?>
    <a href="<?php the_permalink(); ?>" class="project-card reveal">
      <span class="project-num"><?php echo esc_html($num); ?></span>
      <span class="project-name"><?php the_title(); ?></span>
      <div class="project-meta">
        <span class="project-type"><?php echo esc_html(strtoupper($tag_name)); ?></span>
        <span class="project-desc"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></span>
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
  <div>
    <div class="gallery-cta-eyebrow">◆ THE FULL COLLECTION</div>
    <h2 class="gallery-cta-headline">THERE'S<br><em>More</em><br>WHERE THAT<br>CAME FROM.</h2>
    <p class="gallery-cta-sub">Every project tells a story. Come see the rest of the work.</p>
  </div>
  <a href="<?php echo esc_url( get_permalink( get_page_by_path('work') ) ); ?>" class="gallery-btn">
    ENTER<br>GALLERY<br>→
  </a>
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

	</div>
	</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
