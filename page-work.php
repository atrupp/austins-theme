<?php
/**
 * Template Name: Work Gallery
 *
 * Portfolio gallery page. Projects are child pages of a page with slug 'projects'.
 * Flexible: uses featured image if set, falls back to a generated placeholder.
 * Custom fields supported (optional):
 *   - project_tags  (comma-separated string, e.g. "Web Design, Front-End, Hugo")
 *   - project_year  (e.g. "2024")
 *   - project_url   (external live URL, falls back to the page permalink)
 */

get_header(); ?>

<?php
$projects = new WP_Query([
  'post_type'      => 'page',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'post_parent'    => get_queried_object_id(),
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);

$items = [];
$count = 1;
if ( $projects->have_posts() ) :
  while ( $projects->have_posts() ) : $projects->the_post();
    $tags     = get_post_meta( get_the_ID(), 'project_tags', true );
    $year     = get_post_meta( get_the_ID(), 'project_year', true );
    $ext_url  = get_post_meta( get_the_ID(), 'project_url',  true );
    $img_url  = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    $items[]  = [
      'num'     => str_pad( $count, 2, '0', STR_PAD_LEFT ),
      'title'   => get_the_title(),
      'excerpt' => wp_trim_words( get_the_excerpt(), 15 ),
      'link'    => $ext_url ?: get_permalink(),
      'img'     => $img_url ?: '',
      'tags'    => $tags ? array_map( 'trim', explode( ',', $tags ) ) : [],
      'year'    => $year ?: '',
    ];
    $count++;
  endwhile;
  wp_reset_postdata();
else :
  // Placeholder data when no project pages exist yet
  $items = [
    ['num'=>'01','title'=>'Project Name','excerpt'=>'A short punchy description of the work goes here.','link'=>'#','img'=>'','tags'=>['Web Design','Front-End'],'year'=>'2024'],
    ['num'=>'02','title'=>'Project Name','excerpt'=>'A short punchy description of the work goes here.','link'=>'#','img'=>'','tags'=>['Branding','Design'],'year'=>'2023'],
    ['num'=>'03','title'=>'Project Name','excerpt'=>'A short punchy description of the work goes here.','link'=>'#','img'=>'','tags'=>['Development','Hugo'],'year'=>'2023'],
    ['num'=>'04','title'=>'Project Name','excerpt'=>'A short punchy description of the work goes here.','link'=>'#','img'=>'','tags'=>['Analytics','SEO'],'year'=>'2022'],
    ['num'=>'05','title'=>'Project Name','excerpt'=>'A short punchy description of the work goes here.','link'=>'#','img'=>'','tags'=>['CMS','CloudCannon'],'year'=>'2022'],
  ];
endif;
?>

<style>
/* ─── Reset / Base ─────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:        #0e0e0e;
  --surface:   #161616;
  --border:    rgba(255,255,255,0.07);
  --text:      #e8e4dc;
  --muted:     rgba(232,228,220,0.38);
  --accent:    #ff3d2e;
  --accent2:   #6b7b8c;
  --font-disp: 'Bebas Neue', sans-serif;
  --font-body: 'DM Sans', sans-serif;
  --ease-out:  cubic-bezier(0.16, 1, 0.3, 1);
}

@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');

body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--font-body);
  cursor: none;
  overflow-x: hidden;
}

a { color: inherit; text-decoration: none; }

/* ─── Custom Cursor ────────────────────────────────────────── */
#cursor {
  position: fixed;
  top: 0; left: 0;
  width: 12px; height: 12px;
  background: var(--accent);
  border-radius: 50%;
  pointer-events: none;
  z-index: 9999;
  transform: translate(-50%, -50%);
  transition: width 0.2s var(--ease-out),
              height 0.2s var(--ease-out),
              background 0.2s ease;
  mix-blend-mode: normal;
}
#cursor.expand {
  width: 60px; height: 60px;
  background: rgba(255,61,46,0.15);
  border: 1.5px solid var(--accent);
}
#cursor-label {
  position: fixed;
  top: 0; left: 0;
  pointer-events: none;
  z-index: 9999;
  font-family: var(--font-body);
  font-size: 10px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--accent);
  transform: translate(-50%, 28px);
  opacity: 0;
  transition: opacity 0.2s ease;
}
#cursor-label.show { opacity: 1; }

/* ─── Floating Preview Image ───────────────────────────────── */
#preview-img {
  position: fixed;
  top: 0; left: 0;
  width: 360px;
  aspect-ratio: 16/10;
  border-radius: 4px;
  overflow: hidden;
  pointer-events: none;
  z-index: 900;
  opacity: 0;
  transform: translate(-50%, -60%) scale(0.88) rotate(-2deg);
  transition: opacity 0.35s var(--ease-out),
              transform 0.35s var(--ease-out);
  box-shadow: 0 32px 80px rgba(0,0,0,0.7);
}
#preview-img.visible {
  opacity: 1;
  transform: translate(-50%, -60%) scale(1) rotate(0deg);
}
#preview-img img,
#preview-img .preview-placeholder {
  width: 100%; height: 100%;
  object-fit: cover;
  display: block;
}
#preview-img .preview-placeholder {
  background: var(--surface);
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-disp);
  font-size: 2rem;
  letter-spacing: 0.1em;
  color: var(--muted);
}

/* ─── Page Header ──────────────────────────────────────────── */
.gallery-header {
  padding: 120px 6vw 60px;
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  border-bottom: 1px solid var(--border);
}
.gallery-header h1 {
  font-family: var(--font-disp);
  font-size: clamp(3.5rem, 10vw, 8rem);
  line-height: 0.9;
  letter-spacing: 0.02em;
}
.gallery-header h1 em {
  font-family: var(--font-disp);
  font-style: italic;
  color: var(--accent);
}
.gallery-meta {
  text-align: right;
  font-size: 0.75rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--muted);
  line-height: 2;
}
.gallery-meta strong {
  display: block;
  font-family: var(--font-disp);
  font-size: 2.5rem;
  color: var(--text);
  letter-spacing: 0.05em;
  line-height: 1;
}

/* ─── Filter Bar ───────────────────────────────────────────── */
.filter-bar {
  padding: 20px 6vw;
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  border-bottom: 1px solid var(--border);
}
.filter-btn {
  background: transparent;
  border: 1px solid var(--border);
  color: var(--muted);
  font-family: var(--font-body);
  font-size: 0.7rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 100px;
  cursor: none;
  transition: all 0.2s ease;
}
.filter-btn:hover,
.filter-btn.active {
  border-color: var(--accent);
  color: var(--accent);
  background: rgba(255,61,46,0.07);
}

/* ─── Project List ─────────────────────────────────────────── */
.projects-list {
  padding: 0 6vw;
}

.project-row {
  display: grid;
  grid-template-columns: 60px 1fr auto 40px;
  align-items: center;
  gap: 24px;
  padding: 28px 0;
  border-bottom: 1px solid var(--border);
  cursor: none;
  position: relative;
  transition: background 0.3s ease;

  /* entrance animation */
  opacity: 0;
  transform: translateY(32px);
  transition: opacity 0.6s var(--ease-out),
              transform 0.6s var(--ease-out),
              background 0.3s ease;
}
.project-row.in-view {
  opacity: 1;
  transform: translateY(0);
}
.project-row:hover .row-num   { color: var(--accent); }
.project-row:hover .row-title { letter-spacing: 0.06em; }
.project-row:hover .row-arrow { transform: translateX(6px) rotate(-45deg); color: var(--accent); }

/* Hover stripe */
.project-row::before {
  content: '';
  position: absolute;
  left: -6vw; right: -6vw; top: 0; bottom: 0;
  background: rgba(255,255,255,0.025);
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
}
.project-row:hover::before { opacity: 1; }

.row-num {
  font-family: var(--font-disp);
  font-size: 0.95rem;
  letter-spacing: 0.1em;
  color: var(--muted);
  transition: color 0.3s ease;
}

.row-main { min-width: 0; }

.row-title {
  font-family: var(--font-disp);
  font-size: clamp(1.8rem, 4vw, 3.4rem);
  letter-spacing: 0.03em;
  line-height: 1;
  transition: letter-spacing 0.4s var(--ease-out);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.row-desc {
  font-size: 0.8rem;
  color: var(--muted);
  margin-top: 5px;
  font-weight: 300;
}

.row-tags {
  display: flex;
  gap: 6px;
  flex-wrap: wrap;
  justify-content: flex-end;
}
.row-tag {
  font-size: 0.65rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--muted);
  border: 1px solid var(--border);
  padding: 3px 10px;
  border-radius: 100px;
}

.row-arrow {
  font-size: 1.3rem;
  color: var(--muted);
  transition: transform 0.3s var(--ease-out), color 0.3s ease;
}

/* Year pill */
.row-year {
  font-size: 0.65rem;
  letter-spacing: 0.1em;
  color: var(--muted);
  margin-top: 4px;
}

/* ─── Full-screen Takeover ─────────────────────────────────── */
#project-overlay {
  position: fixed;
  inset: 0;
  z-index: 1000;
  background: var(--bg);
  display: flex;
  flex-direction: column;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.4s var(--ease-out);
  overflow-y: auto;
}
#project-overlay.open {
  opacity: 1;
  pointer-events: all;
}

.overlay-inner {
  flex: 1;
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 100vh;
}

.overlay-img-side {
  position: sticky;
  top: 0;
  height: 100vh;
  overflow: hidden;
  background: var(--surface);
}
.overlay-img-side img,
.overlay-img-placeholder {
  width: 100%; height: 100%;
  object-fit: cover;
  display: block;
}
.overlay-img-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-disp);
  font-size: 4rem;
  letter-spacing: 0.08em;
  color: var(--muted);
}

.overlay-content-side {
  padding: 80px 60px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.overlay-close {
  position: fixed;
  top: 28px; right: 36px;
  background: transparent;
  border: 1px solid var(--border);
  color: var(--text);
  font-family: var(--font-body);
  font-size: 0.7rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  padding: 8px 18px;
  cursor: none;
  border-radius: 100px;
  transition: border-color 0.2s, color 0.2s;
  z-index: 1001;
}
.overlay-close:hover { border-color: var(--accent); color: var(--accent); }

.overlay-num {
  font-family: var(--font-disp);
  font-size: 0.9rem;
  letter-spacing: 0.15em;
  color: var(--accent);
  margin-bottom: 16px;
}
.overlay-title {
  font-family: var(--font-disp);
  font-size: clamp(3rem, 6vw, 5.5rem);
  line-height: 0.92;
  letter-spacing: 0.02em;
  margin-bottom: 28px;
}
.overlay-excerpt {
  font-size: 1rem;
  font-weight: 300;
  color: rgba(232,228,220,0.7);
  line-height: 1.7;
  max-width: 480px;
  margin-bottom: 40px;
}
.overlay-tags {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 48px;
}
.overlay-tag {
  font-size: 0.7rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--muted);
  border: 1px solid var(--border);
  padding: 5px 14px;
  border-radius: 100px;
}
.overlay-cta {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  font-family: var(--font-disp);
  font-size: 1.1rem;
  letter-spacing: 0.12em;
  color: var(--accent);
  border-bottom: 1px solid var(--accent);
  padding-bottom: 4px;
  width: fit-content;
  transition: gap 0.3s var(--ease-out);
}
.overlay-cta:hover { gap: 20px; }

/* ─── Footer strip ─────────────────────────────────────────── */
.gallery-footer {
  padding: 60px 6vw;
  border-top: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.gallery-footer span {
  font-size: 0.7rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--muted);
}

/* ─── Responsive ───────────────────────────────────────────── */
@media (max-width: 900px) {
  .overlay-inner { grid-template-columns: 1fr; }
  .overlay-img-side { position: relative; height: 50vw; }
  .project-row { grid-template-columns: 40px 1fr 40px; }
  .row-tags { display: none; }
  #preview-img { display: none; }
  body { cursor: auto; }
  #cursor, #cursor-label { display: none; }
}
</style>

<!-- Cursor elements -->
<div id="cursor"></div>
<div id="cursor-label">VIEW</div>

<!-- Floating preview -->
<div id="preview-img" aria-hidden="true">
  <div class="preview-placeholder">AR</div>
</div>

<!-- Full-screen overlay -->
<div id="project-overlay" role="dialog" aria-modal="true" aria-label="Project detail">
  <button class="overlay-close" id="overlay-close">&#x2715; Close</button>
  <div class="overlay-inner">
    <div class="overlay-img-side" id="overlay-img-side">
      <div class="overlay-img-placeholder">AR</div>
    </div>
    <div class="overlay-content-side">
      <div class="overlay-num" id="overlay-num"></div>
      <h2 class="overlay-title" id="overlay-title"></h2>
      <p class="overlay-excerpt" id="overlay-excerpt"></p>
      <div class="overlay-tags" id="overlay-tags"></div>
      <a href="#" class="overlay-cta" id="overlay-cta" target="_blank" rel="noopener">
        VIEW PROJECT <span>→</span>
      </a>
    </div>
  </div>
</div>

<!-- Page -->
<main>
  <header class="gallery-header">
    <h1>SELECTED<br><em>Work</em></h1>
    <div class="gallery-meta">
      <strong><?php echo count($items); ?></strong>
      Projects
    </div>
  </header>

  <?php
  // Collect all unique tags for filter bar
  $all_tags = [];
  foreach ( $items as $item ) {
    foreach ( $item['tags'] as $t ) {
      if ( ! in_array( $t, $all_tags ) ) $all_tags[] = $t;
    }
  }
  if ( ! empty( $all_tags ) ) : ?>
  <div class="filter-bar" id="filter-bar">
    <button class="filter-btn active" data-filter="all">All</button>
    <?php foreach ( $all_tags as $tag ) : ?>
    <button class="filter-btn" data-filter="<?php echo esc_attr( strtolower( $tag ) ); ?>">
      <?php echo esc_html( $tag ); ?>
    </button>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <div class="projects-list" id="projects-list">
    <?php foreach ( $items as $i => $item ) : ?>
    <div
      class="project-row"
      data-index="<?php echo $i; ?>"
      data-img="<?php echo esc_attr( $item['img'] ); ?>"
      data-title="<?php echo esc_attr( $item['title'] ); ?>"
      data-excerpt="<?php echo esc_attr( $item['excerpt'] ); ?>"
      data-tags="<?php echo esc_attr( implode( ',', $item['tags'] ) ); ?>"
      data-year="<?php echo esc_attr( $item['year'] ); ?>"
      data-link="<?php echo esc_url( $item['link'] ); ?>"
      data-num="<?php echo esc_attr( $item['num'] ); ?>"
      tabindex="0"
      role="button"
      aria-label="View project: <?php echo esc_attr( $item['title'] ); ?>"
    >
      <span class="row-num"><?php echo esc_html( $item['num'] ); ?></span>
      <div class="row-main">
        <div class="row-title"><?php echo esc_html( $item['title'] ); ?></div>
        <div class="row-desc"><?php echo esc_html( $item['excerpt'] ); ?></div>
        <?php if ( $item['year'] ) : ?>
        <div class="row-year"><?php echo esc_html( $item['year'] ); ?></div>
        <?php endif; ?>
      </div>
      <?php if ( ! empty( $item['tags'] ) ) : ?>
      <div class="row-tags">
        <?php foreach ( $item['tags'] as $tag ) : ?>
        <span class="row-tag"><?php echo esc_html( $tag ); ?></span>
        <?php endforeach; ?>
      </div>
      <?php else : ?>
      <div></div>
      <?php endif; ?>
      <span class="row-arrow">→</span>
    </div>
    <?php endforeach; ?>
  </div>

  <footer class="gallery-footer">
    <span>Austin Rupp &mdash; Selected Work</span>
    <span><?php echo date('Y'); ?></span>
  </footer>
</main>

<script>
(function () {
  'use strict';

  /* ── Cursor tracking ─────────────────────────────── */
  const cursor      = document.getElementById('cursor');
  const cursorLabel = document.getElementById('cursor-label');
  let mx = -200, my = -200;
  let cx = -200, cy = -200;

  document.addEventListener('mousemove', e => {
    mx = e.clientX;
    my = e.clientY;
  });

  // Smooth cursor follow
  function animateCursor() {
    cx += (mx - cx) * 0.12;
    cy += (my - cy) * 0.12;
    cursor.style.left      = cx + 'px';
    cursor.style.top       = cy + 'px';
    cursorLabel.style.left = cx + 'px';
    cursorLabel.style.top  = cy + 'px';
    requestAnimationFrame(animateCursor);
  }
  animateCursor();

  /* ── Floating preview image ──────────────────────── */
  const preview     = document.getElementById('preview-img');
  const previewImg  = preview.querySelector('img');
  const previewPH   = preview.querySelector('.preview-placeholder');
  let px = 0, py = 0;
  let pvx = 0, pvy = 0;

  document.addEventListener('mousemove', e => {
    px = e.clientX;
    py = e.clientY;
  });

  function animatePreview() {
    pvx += (px - pvx) * 0.07;
    pvy += (py - pvy) * 0.07;
    preview.style.left = pvx + 'px';
    preview.style.top  = pvy + 'px';
    requestAnimationFrame(animatePreview);
  }
  animatePreview();

  function showPreview(imgSrc, title) {
    if (imgSrc) {
      if (!previewImg) {
        const img = document.createElement('img');
        img.src = imgSrc;
        img.alt = title;
        preview.insertBefore(img, previewPH);
      } else {
        previewImg.src = imgSrc;
        previewImg.style.display = 'block';
      }
      if (previewPH) previewPH.style.display = 'none';
    } else {
      if (previewImg) previewImg.style.display = 'none';
      if (previewPH) {
        previewPH.style.display = 'flex';
        previewPH.textContent = title.substring(0, 2).toUpperCase();
      }
    }
    preview.classList.add('visible');
  }

  function hidePreview() {
    preview.classList.remove('visible');
  }

  /* ── Overlay ─────────────────────────────────────── */
  const overlay      = document.getElementById('project-overlay');
  const overlayClose = document.getElementById('overlay-close');
  const oImgSide     = document.getElementById('overlay-img-side');
  const oNum         = document.getElementById('overlay-num');
  const oTitle       = document.getElementById('overlay-title');
  const oExcerpt     = document.getElementById('overlay-excerpt');
  const oTags        = document.getElementById('overlay-tags');
  const oCta         = document.getElementById('overlay-cta');

  function openOverlay(row) {
    const img     = row.dataset.img;
    const title   = row.dataset.title;
    const excerpt = row.dataset.excerpt;
    const tags    = row.dataset.tags ? row.dataset.tags.split(',') : [];
    const link    = row.dataset.link;
    const num     = row.dataset.num;

    oNum.textContent     = '/ ' + num;
    oTitle.textContent   = title;
    oExcerpt.textContent = excerpt;
    oCta.href            = link;

    oTags.innerHTML = tags.map(t =>
      `<span class="overlay-tag">${t.trim()}</span>`
    ).join('');

    oImgSide.innerHTML = img
      ? `<img src="${img}" alt="${title}">`
      : `<div class="overlay-img-placeholder">${title.substring(0,2).toUpperCase()}</div>`;

    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
    overlayClose.focus();
  }

  function closeOverlay() {
    overlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  overlayClose.addEventListener('click', closeOverlay);
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeOverlay();
  });

  /* ── Project rows ────────────────────────────────── */
  const rows = document.querySelectorAll('.project-row');

  rows.forEach(row => {
    row.addEventListener('mouseenter', () => {
      showPreview(row.dataset.img, row.dataset.title);
      cursor.classList.add('expand');
      cursorLabel.classList.add('show');
    });

    row.addEventListener('mouseleave', () => {
      hidePreview();
      cursor.classList.remove('expand');
      cursorLabel.classList.remove('show');
    });

    row.addEventListener('click', () => openOverlay(row));

    row.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openOverlay(row);
      }
    });
  });

  /* ── Scroll reveal ───────────────────────────────── */
  const observer = new IntersectionObserver(entries => {
    entries.forEach((entry, idx) => {
      if (entry.isIntersecting) {
        const delay = Array.from(rows).indexOf(entry.target) * 60;
        setTimeout(() => entry.target.classList.add('in-view'), delay);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  rows.forEach(row => observer.observe(row));

  /* ── Filter bar ──────────────────────────────────── */
  const filterBtns = document.querySelectorAll('.filter-btn');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.dataset.filter;
      rows.forEach(row => {
        const tags = row.dataset.tags ? row.dataset.tags.toLowerCase() : '';
        if (filter === 'all' || tags.includes(filter)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  });

})();
</script>

<?php get_footer(); ?>
