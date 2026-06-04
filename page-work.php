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

$GLOBALS['site_back_btn'] = '<a href="' . esc_url( home_url('/') ) . '" class="site-back-btn">← Home</a>';
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
