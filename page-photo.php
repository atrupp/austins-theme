<?php
/**
 * Template Name: Photo Gallery
 *
 * Full-width photo gallery page. Apply this template to your photo gallery page
 * in WP Admin under Page Attributes > Template.
 */

get_header(); ?>

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:        #0e0e0e;
  --surface:   #161616;
  --border:    rgba(255,255,255,0.07);
  --text:      #e8e4dc;
  --muted:     rgba(232,228,220,0.38);
  --accent:    #ff3d2e;
  --font-disp: 'Bebas Neue', sans-serif;
  --font-body: 'DM Sans', sans-serif;
  --ease-out:  cubic-bezier(0.16, 1, 0.3, 1);
}

@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500&display=swap');

body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--font-body);
  overflow-x: hidden;
}

a { color: inherit; text-decoration: none; }

/* ── Back button ── */
.photo-back {
  position: fixed;
  top: 28px;
  left: 36px;
  z-index: 100;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.7rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--muted);
  border: 1px solid var(--border);
  padding: 8px 18px;
  border-radius: 100px;
  backdrop-filter: blur(12px);
  background: rgba(14,14,14,0.7);
  transition: color 0.2s, border-color 0.2s;
}
.photo-back:hover { color: var(--accent); border-color: var(--accent); }

/* ── Page header ── */
.photo-header {
  padding: 120px 6vw 60px;
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  border-bottom: 1px solid var(--border);
}

.photo-header-left h1 {
  font-family: var(--font-disp);
  font-size: clamp(3.5rem, 10vw, 8rem);
  line-height: 0.9;
  letter-spacing: 0.02em;
}
.photo-header-left h1 em {
  font-style: italic;
  color: var(--accent);
}

.photo-header-right {
  text-align: right;
  font-size: 0.72rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--muted);
  line-height: 2;
}
.photo-header-right strong {
  display: block;
  font-family: var(--font-disp);
  font-size: 2.5rem;
  color: var(--text);
  letter-spacing: 0.05em;
  line-height: 1;
}

/* ── Excerpt / intro ── */
.photo-intro {
  padding: 40px 6vw;
  border-bottom: 1px solid var(--border);
  max-width: 680px;
  font-size: 0.95rem;
  font-weight: 300;
  color: var(--muted);
  line-height: 1.8;
}

/* ── Gallery content ── */
.photo-content {
  padding: 60px 4vw 80px;
}

/* Override Gutenberg gallery defaults to match theme */
.photo-content .wp-block-gallery {
  gap: 6px !important;
}

.photo-content .wp-block-gallery .wp-block-image img {
  border-radius: 2px;
  transition: opacity 0.3s ease, transform 0.4s var(--ease-out);
  filter: brightness(0.92) saturate(0.9);
}

.photo-content .wp-block-gallery .wp-block-image:hover img {
  opacity: 0.85;
  transform: scale(1.02);
  filter: brightness(1) saturate(1);
}

.photo-content .wp-block-gallery .wp-block-image {
  overflow: hidden;
  border-radius: 2px;
}

/* Full width single images */
.photo-content .wp-block-image img {
  border-radius: 2px;
  width: 100%;
  height: auto;
  display: block;
}

/* Caption styling */
.photo-content figcaption,
.photo-content .wp-element-caption {
  font-size: 0.68rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--muted);
  text-align: center;
  margin-top: 8px;
}

/* Columns block */
.photo-content .wp-block-columns {
  gap: 6px;
  margin-bottom: 6px;
}
.photo-content .wp-block-column {
  overflow: hidden;
  border-radius: 2px;
}

/* ── Film strip ticker ── */
.photo-ticker {
  overflow: hidden;
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
  padding: 14px 0;
  margin-bottom: 60px;
  white-space: nowrap;
}
.photo-ticker-inner {
  display: inline-flex;
  gap: 48px;
  animation: tickerScroll 20s linear infinite;
}
.photo-ticker-item {
  font-family: var(--font-disp);
  font-size: 0.9rem;
  letter-spacing: 0.18em;
  color: var(--muted);
  display: flex;
  align-items: center;
  gap: 48px;
}
.photo-ticker-item::after {
  content: '◆';
  font-size: 0.4rem;
  color: var(--accent);
}
@keyframes tickerScroll {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

/* ── Footer CTA ── */
.photo-footer-cta {
  border-top: 1px solid var(--border);
  padding: 80px 6vw;
  display: grid;
  grid-template-columns: 1fr auto;
  align-items: center;
  gap: 40px;
}

.photo-footer-cta-text .eyebrow {
  font-size: 0.65rem;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--accent);
  margin-bottom: 12px;
}

.photo-footer-cta-text h2 {
  font-family: var(--font-disp);
  font-size: clamp(2.5rem, 6vw, 5rem);
  letter-spacing: 0.02em;
  line-height: 0.95;
}
.photo-footer-cta-text h2 em {
  font-style: italic;
  color: var(--accent);
}

.photo-footer-links {
  display: flex;
  flex-direction: column;
  gap: 12px;
  align-items: flex-end;
}

.photo-footer-link {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  font-family: var(--font-disp);
  font-size: 1rem;
  letter-spacing: 0.12em;
  color: var(--text);
  border: 1px solid var(--border);
  padding: 14px 28px;
  border-radius: 100px;
  white-space: nowrap;
  transition: border-color 0.2s, color 0.2s, gap 0.3s var(--ease-out);
}
.photo-footer-link:hover {
  border-color: var(--accent);
  color: var(--accent);
  gap: 20px;
}

/* ── Page footer strip ── */
.photo-page-footer {
  padding: 32px 6vw;
  border-top: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.photo-page-footer span {
  font-size: 0.65rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: var(--muted);
}

/* ── Responsive ── */
@media (max-width: 768px) {
  .photo-back { left: 20px; top: 20px; }
  .photo-header { flex-direction: column; gap: 24px; align-items: flex-start; }
  .photo-header-right { text-align: left; }
  .photo-footer-cta { grid-template-columns: 1fr; }
  .photo-footer-links { align-items: flex-start; }
}
</style>

<a href="<?php echo esc_url( home_url('/') ); ?>" class="photo-back">← Home</a>

<header class="photo-header">
  <div class="photo-header-left">
    <h1>THROUGH<br>THE <em>Lens</em></h1>
  </div>
  <div class="photo-header-right">
    <strong>Film</strong>
    Austin Rupp<br>
    Photography
  </div>
</header>

<?php if ( get_the_excerpt() ) : ?>
<div class="photo-intro">
  <?php echo wp_kses_post( get_the_excerpt() ); ?>
</div>
<?php endif; ?>

<!-- Film strip ticker -->
<div class="photo-ticker">
  <div class="photo-ticker-inner">
    <?php
    $ticker_items = ['Photography', 'Colorado Springs', 'Film', 'Austin Rupp', 'Through The Lens', 'Visual Archive'];
    // Duplicate for seamless loop
    $all_items = array_merge($ticker_items, $ticker_items);
    foreach ($all_items as $item) :
    ?>
    <span class="photo-ticker-item"><?php echo esc_html($item); ?></span>
    <?php endforeach; ?>
  </div>
</div>

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