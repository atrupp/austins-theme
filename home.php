<?php get_header(); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Instrument+Serif:ital@0;1&family=DM+Mono:wght@300;400;500&display=swap');

:root {
  --ink: #0d0d0d;
  --paper: #f2efe8;
  --accent: #ff3c2e;
  --mid: #8a8680;
}

.blog-wrap { background: var(--paper); color: var(--ink); min-height: 100vh; }

/* ── HEADER BAR ── */
.blog-topbar {
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

.blog-topbar a {
  color: var(--ink);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: color 0.2s, gap 0.2s;
}

.blog-topbar a:hover { color: var(--accent); gap: 1rem; }
.blog-topbar a::before { content: '←'; }

/* ── HERO ── */
.blog-hero {
  padding: 5rem 3rem 4rem;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 2rem;
}

.blog-hero-left {}

.blog-eyebrow {
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.3em;
  color: var(--accent);
  margin-bottom: 1rem;
}

.blog-headline {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(4rem, 10vw, 9rem);
  line-height: 0.9;
  color: var(--ink);
}

.blog-headline em {
  font-family: 'Instrument Serif', serif;
  font-style: italic;
  color: var(--accent);
}

.blog-hero-right {
  font-family: 'Instrument Serif', serif;
  font-size: 1.1rem;
  color: var(--mid);
  max-width: 280px;
  text-align: right;
  line-height: 1.6;
  flex-shrink: 0;
}

/* ── POST LIST ── */
.blog-list {
  padding: 0 3rem 6rem;
}

.blog-post-item {
  display: grid;
  grid-template-columns: 100px 1fr auto;
  align-items: start;
  gap: 2rem;
  padding: 3rem 0;
  border-bottom: 1px solid rgba(0,0,0,0.08);
  text-decoration: none;
  color: inherit;
  position: relative;
  transition: padding-left 0.3s ease;
}

.blog-post-item::before {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 0;
  background: var(--accent);
  transition: width 0.3s ease;
}

.blog-post-item:hover { padding-left: 1rem; }
.blog-post-item:hover::before { width: 4px; }

.blog-post-date {
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.1em;
  color: var(--mid);
  line-height: 1.4;
  padding-top: 0.5rem;
}

.blog-post-body {}

.blog-post-tag {
  font-family: 'DM Mono', monospace;
  font-size: 10px;
  letter-spacing: 0.2em;
  color: var(--accent);
  margin-bottom: 0.75rem;
}

.blog-post-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: clamp(1.8rem, 3vw, 2.8rem);
  line-height: 1;
  color: var(--ink);
  transition: color 0.2s;
  margin-bottom: 1rem;
}

.blog-post-item:hover .blog-post-title { color: var(--accent); }

.blog-post-excerpt {
  font-family: 'Instrument Serif', serif;
  font-size: 1rem;
  color: var(--mid);
  line-height: 1.6;
  max-width: 600px;
}

.blog-post-arrow {
  font-size: 1.5rem;
  color: var(--mid);
  padding-top: 0.5rem;
  transition: transform 0.3s, color 0.2s;
  flex-shrink: 0;
}

.blog-post-item:hover .blog-post-arrow {
  transform: translateX(8px);
  color: var(--accent);
}

/* ── PAGINATION ── */
.blog-pagination {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 3rem 3rem 6rem;
  font-family: 'DM Mono', monospace;
  font-size: 11px;
  letter-spacing: 0.15em;
}

.blog-pagination a {
  color: var(--ink);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  transition: color 0.2s, gap 0.2s;
}

.blog-pagination a:hover { color: var(--accent); gap: 1.5rem; }

/* ── EMPTY STATE ── */
.blog-empty {
  padding: 6rem 3rem;
  text-align: center;
}

.blog-empty-title {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 4rem;
  color: var(--ink);
  margin-bottom: 1rem;
}

.blog-empty-sub {
  font-family: 'Instrument Serif', serif;
  font-size: 1.2rem;
  color: var(--mid);
}

/* ── NOISE ── */
.blog-wrap::after {
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

@media (max-width: 768px) {
  .blog-topbar, .blog-hero, .blog-list, .blog-pagination { padding-left: 1.5rem; padding-right: 1.5rem; }
  .blog-hero { flex-direction: column; align-items: flex-start; }
  .blog-hero-right { text-align: left; }
  .blog-post-item { grid-template-columns: 1fr auto; }
  .blog-post-date { display: none; }
}
</style>

<div class="blog-wrap">

  <div class="blog-topbar">
    <a href="<?php echo esc_url( home_url('/') ); ?>">HOME</a>
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