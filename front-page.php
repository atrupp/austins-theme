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

    <div class="hero-model" id="hero-model-wrap">
      <canvas id="model-canvas"></canvas>
      <div class="model-scanlines"></div>

      <div class="model-mode-toggle">
        <button class="model-mode-btn" data-mode="wire">Wire</button>
        <button class="model-mode-btn active" data-mode="solid">Solid</button>
      </div>
      <div id="model-loading">
        <div class="model-load-ring"></div>
        <div class="model-load-text">Scanning</div>
      </div>
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


<!-- 3D MODEL STYLES -->
<style>
.hero-model {
  position: absolute;
  right: -10px;
  top: 50%;
  transform: translateY(-58%);
  width: 1000px;
  height: 1000px;
  z-index: 1;
}
#model-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; border-radius: 50%; }
.model-scanlines {
  position: absolute; inset: 0; pointer-events: none; z-index: 2; border-radius: 50%; overflow: hidden;
  background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,212,255,0.012) 2px, rgba(0,212,255,0.012) 4px);
}

.model-mode-toggle {
  position: absolute; bottom: -44px; left: 50%; transform: translateX(-50%);
  z-index: 10; display: flex; border: 1px solid rgba(0,212,255,0.25);
  border-radius: 100px; overflow: hidden;
  backdrop-filter: blur(10px); background: rgba(10,10,10,0.6);
  white-space: nowrap;
}
.model-mode-btn {
  background: transparent; border: none; color: rgba(232,228,220,0.35);
  font-family: 'DM Sans', sans-serif; font-size: 0.6rem;
  letter-spacing: 0.14em; text-transform: uppercase; padding: 6px 14px; cursor: pointer;
  transition: color 0.2s, background 0.2s;
}
.model-mode-btn.active { background: rgba(0,212,255,0.12); color: #00d4ff; }
#model-loading {
  position: absolute; inset: 0; z-index: 20; border-radius: 50%;
  display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px;
  background: #0a0a0a; transition: opacity 0.8s ease;
}
#model-loading.hidden { opacity: 0; pointer-events: none; }
.model-load-ring {
  width: 32px; height: 32px;
  border: 1px solid rgba(0,212,255,0.15); border-top-color: #00d4ff;
  border-radius: 50%; animation: modelSpin 1s linear infinite;
}
@keyframes modelSpin { to { transform: rotate(360deg); } }
.model-load-text {
  font-family: 'DM Sans', sans-serif; font-size: 0.6rem;
  letter-spacing: 0.2em; text-transform: uppercase; color: rgba(0,212,255,0.6);
}
@media (max-width: 1800px) {
  .hero-model {
    position: relative;
    right: auto;
    top: auto;
    transform: none;
    z-index: auto;
    width: 320px;
    height: 320px;
    grid-area: model;
    margin: 2rem auto 0;
  }
}
@media (max-width: 480px) {
  .hero-model { width: 220px; height: 220px; }
}
</style>


<!-- WORK -->
<section class="work-section">
  <div class="work-header reveal">
    <h2 class="work-title">SELECTED<br><em>Work</em></h2>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('work') ) ); ?>" class="work-link">ALL PROJECTS</a>
  </div>

  <div class="projects-grid">
    <?php
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
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('projects') ) ); ?>" class="gallery-btn">ENTER<br>GALLERY<br>→</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('photo') ) ); ?>" class="gallery-btn">ENTER<br>PHOTO GALLERY<br>→</a>
    <a href="<?php echo esc_url( get_permalink( get_page_by_path('blog') ) ); ?>" class="gallery-btn">ENTER<br>BLOG<br>→</a>
  </div>
</div>

<?php get_footer(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
// ── Existing scripts ──────────────────────────────────────────

const cursor = document.getElementById('cursor');
let mx = 0, my = 0, cx = 0, cy = 0;
document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
document.querySelectorAll('a, button, .project-card, .hero-blob').forEach(el => {
  el.addEventListener('mouseenter', () => cursor.classList.add('big'));
  el.addEventListener('mouseleave', () => cursor.classList.remove('big'));
});
function animateCursor() {
  cx += (mx - cx) * 0.18; cy += (my - cy) * 0.18;
  cursor.style.transform = `translate(calc(${cx}px - 50%), calc(${cy}px - 50%))`;
  requestAnimationFrame(animateCursor);
}
animateCursor();

function updateTime() {
  document.getElementById('hero-time').textContent =
    new Date().toLocaleTimeString('en-US', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
}
setInterval(updateTime, 1000);
updateTime();



const reveals = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver(entries => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) setTimeout(() => entry.target.classList.add('visible'), i * 80);
  });
}, { threshold: 0.1 });
reveals.forEach(el => revealObserver.observe(el));

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

// ── Three.js model ────────────────────────────────────────────
(function () {

  const canvas   = document.getElementById('model-canvas');
  const loading  = document.getElementById('model-loading');
  const modeBtns = document.querySelectorAll('.model-mode-btn');

  const renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setClearColor(0x0a0a0a, 1);

  const scene  = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(45, 1, 0.01, 100);
  camera.position.set(0, 0, 3);

  function resize() {
    const w = canvas.clientWidth, h = canvas.clientHeight;
    renderer.setSize(w, h, false);
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  }
  window.addEventListener('resize', resize);

  scene.add(new THREE.AmbientLight(0xffffff, 0.15));
  const rimLight = new THREE.DirectionalLight(0x00d4ff, 2.5);
  rimLight.position.set(-2, 1, -1);
  scene.add(rimLight);
  const keyLight = new THREE.DirectionalLight(0xffffff, 0.6);
  keyLight.position.set(1, 2, 2);
  scene.add(keyLight);
  const accentLight = new THREE.PointLight(0xff3d2e, 1.2, 8);
  accentLight.position.set(2, -1, 1);
  scene.add(accentLight);

  const wireMat  = new THREE.MeshBasicMaterial({ color: 0x00d4ff, wireframe: true, transparent: true, opacity: 0.06, side: THREE.DoubleSide, depthWrite: false });
  const solidMat = new THREE.MeshStandardMaterial({ color: 0x1a2a35, roughness: 0.6, metalness: 0.3, emissive: 0x00d4ff, emissiveIntensity: 0.04 });
  const xrayMat  = new THREE.MeshBasicMaterial({ color: 0x00d4ff, transparent: true, opacity: 0.08, side: THREE.DoubleSide });

  let modelGroup = null;

  function applyMode(mode) {
    if (!modelGroup) return;
    const mat = mode === 'wire' ? wireMat : mode === 'solid' ? solidMat : xrayMat;
    modelGroup.traverse(child => { if (child.isMesh) { child.material = mat; } });
  }

  modeBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      modeBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      applyMode(btn.dataset.mode);
    });
  });

  const loaderScript = document.createElement('script');
  loaderScript.src = 'https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js';
  document.head.appendChild(loaderScript);

  loaderScript.onload = () => {
    const loader = new THREE.GLTFLoader();

    // ↓ Put your GLB in your theme's /assets/ folder and it will be picked up automatically
    const MODEL_PATH = '<?php echo esc_js( get_template_directory_uri() ); ?>/assets/model.glb';

    function initModel(group) {
      modelGroup = group;
      const box    = new THREE.Box3().setFromObject(modelGroup);
      const center = box.getCenter(new THREE.Vector3());
      const size   = box.getSize(new THREE.Vector3());
      const scale  = 2.2 / Math.max(size.x, size.y, size.z);
      modelGroup.position.sub(center.multiplyScalar(scale));
      modelGroup.scale.setScalar(scale);
      applyMode('solid');
      scene.add(modelGroup);
      loading.classList.add('hidden');
      resize();
      tick();
    }

    loader.load(
      MODEL_PATH,
      (gltf) => initModel(gltf.scene),
      null,
      () => {
        // Fallback wireframe sphere if GLB not found
        const g = new THREE.Group();
        g.add(new THREE.Mesh(new THREE.IcosahedronGeometry(1, 4), wireMat));
        initModel(g);
      }
    );
  };

  let currentRotY = 0, currentRotX = 0;
  let targetRotY = 0, targetRotX = 0;

  document.addEventListener('mousemove', e => {
    targetRotY = (e.clientX / window.innerWidth  - 0.5) * Math.PI * 0.5;
    targetRotX = (e.clientY / window.innerHeight - 0.5) * Math.PI * 0.3;
  });

  let frame = 0;
  function tick() {
    requestAnimationFrame(tick);
    frame++;
    if (modelGroup) {
      currentRotY += (targetRotY - currentRotY) * 0.06;
      currentRotX += (targetRotX - currentRotX) * 0.06;
      modelGroup.rotation.y = currentRotY;
      modelGroup.rotation.x = currentRotX;
    }
    accentLight.intensity = 1.2 + Math.sin(frame * 0.02) * 0.4;
    renderer.render(scene, camera);
  }

  resize();

})();
</script>
