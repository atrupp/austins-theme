<?php get_header(); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Instrument+Serif:ital@0;1&family=DM+Mono:wght@300;400;500&display=swap');

:root {
  --ink: #0d0d0d;
  --paper: #f2efe8;
  --accent: #ff3c2e;
  --mid: #8a8680;
}

.single-wrap { background: var(--paper); color: var(--ink); min-height: 100vh; }

/* ── TOPBAR ── */
.single-topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 2rem 3rem;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.2em;
  color: var(--mid);
}

.single-topbar a {
  color: var(--ink);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: color 0.2s, gap 0.2s;
}

.single-topbar a:hover { color: var(--accent); gap: 1rem; }
.single-topbar a::before { content: '←'; }

/* ── POST HEADER ── */
.single-header {
  padding: 5rem 3rem 4rem;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  max-width: 900px;
}

.single-meta {
  display: flex;
  align-items: center;
  gap: 2rem;
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.2em;
  color: var(--mid);
  margin-bottom: 2rem;
}

.single-meta-cat { color: var(--accent); }

.single-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(3rem, 7vw, 7rem);
  line-height: 0.95;
  color: var(--ink);
  letter-spacing: -0.01em;
}

.single-title em {
  font-family: 'Instrument Serif', serif;
  font-style: italic;
  color: var(--accent);
}

/* ── FEATURED IMAGE ── */
.single-featured {
  width: 100%;
  max-height: 60vh;
  object-fit: cover;
  display: block;
}

/* ── CONTENT ── */
.single-content-wrap {
  display: grid;
  grid-template-columns: 1fr 640px 1fr;
  gap: 0;
  padding: 5rem 0;
}

.single-content {
  grid-column: 2;
  font-family: 'Instrument Serif', serif;
  font-size: 1.2rem;
  line-height: 1.8;
  color: var(--ink);
}

.single-content h1,
.single-content h2,
.single-content h3 {
  font-family: 'Bebas Neue', sans-serif;
  letter-spacing: 0.02em;
  color: var(--ink);
  margin: 3rem 0 1rem;
  line-height: 1;
}

.single-content h2 { font-size: clamp(2rem, 4vw, 3.5rem); }
.single-content h3 { font-size: clamp(1.5rem, 3vw, 2.5rem); }

.single-content p { margin-bottom: 1.5rem; }

.single-content a {
  color: var(--accent);
  text-decoration: underline;
  text-underline-offset: 3px;
}

.single-content blockquote {
  border-left: 3px solid var(--accent);
  margin: 2.5rem 0;
  padding: 1rem 0 1rem 2rem;
  font-style: italic;
  font-size: 1.4rem;
  color: var(--mid);
}

.single-content img {
  width: 100%;
  height: auto;
  display: block;
  margin: 2.5rem 0;
}

.single-content hr {
  border: none;
  border-top: 1px solid rgba(0,0,0,0.1);
  margin: 3rem 0;
}

.single-content ul, .single-content ol {
  padding-left: 1.5rem;
  margin-bottom: 1.5rem;
}

.single-content li { margin-bottom: 0.5rem; }

.single-content code {
  font-family: 'DM Mono', monospace;
  font-size: 0.85em;
  background: rgba(0,0,0,0.06);
  padding: 2px 6px;
  border-radius: 3px;
}

.single-content pre {
  background: var(--ink);
  color: var(--paper);
  padding: 2rem;
  overflow-x: auto;
  margin: 2rem 0;
}

.single-content pre code {
  background: none;
  padding: 0;
  font-size: 0.9rem;
}

/* ── POST FOOTER ── */
.single-footer {
  border-top: 1px solid rgba(0,0,0,0.1);
  padding: 4rem 3rem 6rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 2rem;
}

.single-footer-nav {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.single-footer-label {
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.2em;
  color: var(--mid);
}

.single-footer-link {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 1.8rem;
  color: var(--ink);
  text-decoration: none;
  transition: color 0.2s;
  line-height: 1;
}

.single-footer-link:hover { color: var(--accent); }

.single-back-btn {
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.15em;
  color: var(--paper);
  background: var(--ink);
  padding: 14px 32px;
  text-decoration: none;
  display: inline-block;
  transition: background 0.2s, letter-spacing 0.2s;
}

.single-back-btn:hover {
  background: var(--accent);
  letter-spacing: 0.25em;
  color: var(--paper);
}

/* ── NOISE ── */
.single-wrap::after {
  content: '';
  position: fixed;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  pointer-events: none;
  z-index: 9998;
  opacity: 0.4;
}

/* ── REVEAL ── */
.reveal {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.reveal.visible { opacity: 1; transform: translateY(0); }

@media (max-width: 900px) {
  .single-content-wrap { grid-template-columns: 1fr; padding: 3rem 1.5rem; }
  .single-content { grid-column: 1; }
  .single-topbar, .single-header, .single-footer { padding-left: 1.5rem; padding-right: 1.5rem; }
}
</style>

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