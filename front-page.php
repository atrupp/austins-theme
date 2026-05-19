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


<!-- 3D MODEL SECTION -->
<style>
.model-section { position: relative; background: #0a0a0a; }
.model-scroll-stage { height: 280vh; position: relative; }
.model-sticky {
  position: sticky; top: 0; height: 100vh; width: 100%;
  display: flex; align-items: center; justify-content: center; overflow: hidden;
}
#model-canvas { position: absolute; inset: 0; width: 100%; height: 100%; display: block; }
.model-scanlines {
  position: absolute; inset: 0; pointer-events: none; z-index: 2;
  background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,212,255,0.012) 2px, rgba(0,212,255,0.012) 4px);
}
.model-brackets { position: absolute; inset: 40px; pointer-events: none; z-index: 3; }
.model-bracket { position: absolute; width: 32px; height: 32px; border-color: #00d4ff; border-style: solid; opacity: 0.35; }
.model-bracket.tl { top:0; left:0;   border-width: 1px 0 0 1px; }
.model-bracket.tr { top:0; right:0;  border-width: 1px 1px 0 0; }
.model-bracket.bl { bottom:0; left:0;  border-width: 0 0 1px 1px; }
.model-bracket.br { bottom:0; right:0; border-width: 0 1px 1px 0; }
.model-hud {
  position: absolute; z-index: 4; pointer-events: none;
  font-family: 'DM Sans', sans-serif; font-size: 0.62rem;
  letter-spacing: 0.18em; text-transform: uppercase; line-height: 1.9;
}
.model-hud-tl { top:48px; left:56px; color: rgba(0,212,255,0.55); }
.model-hud-tr { top:48px; right:56px; text-align:right; color: rgba(0,212,255,0.55); }
.model-hud-bl { bottom:48px; left:56px; color: rgba(232,228,220,0.35); }
.model-hud-br { bottom:48px; right:56px; text-align:right; color: rgba(232,228,220,0.35); }
.model-mode-toggle {
  position: absolute; top: 48px; left: 50%; transform: translateX(-50%);
  z-index: 10; display: flex; border: 1px solid rgba(0,212,255,0.25);
  border-radius: 100px; overflow: hidden;
  backdrop-filter: blur(10px); background: rgba(10,10,10,0.6);
}
.model-mode-btn {
  background: transparent; border: none; color: rgba(232,228,220,0.35);
  font-family: 'DM Sans', sans-serif; font-size: 0.65rem;
  letter-spacing: 0.14em; text-transform: uppercase; padding: 8px 18px; cursor: pointer;
  transition: color 0.2s, background 0.2s;
}
.model-mode-btn.active { background: rgba(0,212,255,0.12); color: #00d4ff; }
#model-loading {
  position: absolute; inset: 0; z-index: 20;
  display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 20px;
  background: #0a0a0a; transition: opacity 0.8s ease;
}
#model-loading.hidden { opacity: 0; pointer-events: none; }
.model-load-ring {
  width: 48px; height: 48px;
  border: 1px solid rgba(0,212,255,0.15); border-top-color: #00d4ff;
  border-radius: 50%; animation: modelSpin 1s linear infinite;
}
@keyframes modelSpin { to { transform: rotate(360deg); } }
.model-load-text {
  font-family: 'DM Sans', sans-serif; font-size: 0.65rem;
  letter-spacing: 0.2em; text-transform: uppercase; color: rgba(0,212,255,0.6);
}
.model-scroll-hint {
  position: absolute; bottom: 48px; left: 50%; transform: translateX(-50%);
  z-index: 4; display: flex; flex-direction: column; align-items: center; gap: 8px;
  font-family: 'DM Sans', sans-serif; font-size: 0.62rem;
  letter-spacing: 0.18em; text-transform: uppercase; color: rgba(232,228,220,0.35);
  animation: modelHintFade 3s ease 1.5s both;
}
@keyframes modelHintFade {
  0%  { opacity:0; transform: translateX(-50%) translateY(10px); }
  30% { opacity:0.6; transform: translateX(-50%) translateY(0); }
  70% { opacity:0.6; }
  100%{ opacity:0; }
}
.model-scroll-hint-line {
  width: 1px; height: 32px;
  background: linear-gradient(to bottom, #00d4ff, transparent);
  animation: modelScrollLine 1.5s ease-in-out 1.5s infinite;
}
@keyframes modelScrollLine {
  0%  { transform: scaleY(0); transform-origin: top; }
  50% { transform: scaleY(1); transform-origin: top; }
  51% { transform: scaleY(1); transform-origin: bottom; }
  100%{ transform: scaleY(0); transform-origin: bottom; }
}
</style>

<section class="model-section">
  <div class="model-scroll-stage" id="model-scroll-stage">
    <div class="model-sticky">
      <canvas id="model-canvas"></canvas>
      <div class="model-scanlines"></div>
      <div class="model-brackets">
        <div class="model-bracket tl"></div>
        <div class="model-bracket tr"></div>
        <div class="model-bracket bl"></div>
        <div class="model-bracket br"></div>
      </div>
      <div class="model-hud model-hud-tl">
        Austin Rupp<br>Digital Specialist<br>
        <span id="model-hud-angle">ROT 000°</span>
      </div>
      <div class="model-hud model-hud-tr">
        WVU Digital<br>2019 — Present<br>
        <span id="model-hud-mode">MODE: WIRE</span>
      </div>
      <div class="model-hud model-hud-bl">Colorado Springs, CO</div>
      <div class="model-hud model-hud-br">Scroll to rotate</div>
      <div class="model-mode-toggle">
        <button class="model-mode-btn active" data-mode="wire">Wireframe</button>
        <button class="model-mode-btn" data-mode="solid">Solid</button>
        <button class="model-mode-btn" data-mode="xray">X-Ray</button>
      </div>
      <div class="model-scroll-hint">
        Scroll
        <div class="model-scroll-hint-line"></div>
      </div>
      <div id="model-loading">
        <div class="model-load-ring"></div>
        <div class="model-load-text">Initializing scan</div>
      </div>
    </div>
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
document.addEventListener('mousemove', e => { mx = e.clientX - 6; my = e.clientY - 6; });
document.querySelectorAll('a, button, .project-card, .hero-blob').forEach(el => {
  el.addEventListener('mouseenter', () => cursor.classList.add('big'));
  el.addEventListener('mouseleave', () => cursor.classList.remove('big'));
});
function animateCursor() {
  cx += (mx - cx) * 0.18; cy += (my - cy) * 0.18;
  cursor.style.transform = `translate(${cx}px, ${cy}px)`;
  requestAnimationFrame(animateCursor);
}
animateCursor();

function updateTime() {
  document.getElementById('hero-time').textContent =
    new Date().toLocaleTimeString('en-US', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
}
setInterval(updateTime, 1000);
updateTime();

const blob = document.getElementById('heroBlob');
window.addEventListener('scroll', () => {
  const s = window.scrollY;
  const r1 = 50 + (s * 0.05) % 30;
  const r2 = 50 - (s * 0.04) % 20;
  blob.style.borderRadius = `${r1}% ${100-r1}% ${r2}% ${100-r2}% / ${100-r2}% ${r1}% ${100-r1}% ${r2}%`;
}, { passive: true });

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
  const hudAngle = document.getElementById('model-hud-angle');
  const hudMode  = document.getElementById('model-hud-mode');
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

  const wireMat  = new THREE.MeshBasicMaterial({ color: 0x00d4ff, wireframe: true, transparent: true, opacity: 0.55 });
  const solidMat = new THREE.MeshStandardMaterial({ color: 0x1a2a35, roughness: 0.6, metalness: 0.3, emissive: 0x00d4ff, emissiveIntensity: 0.04 });
  const xrayMat  = new THREE.MeshBasicMaterial({ color: 0x00d4ff, transparent: true, opacity: 0.08, side: THREE.DoubleSide });

  let modelGroup = null;

  function applyMode(mode) {
    hudMode.textContent = 'MODE: ' + mode.toUpperCase();
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
      modelGroup.rotation.x = -Math.PI / 2;
      applyMode('wire');
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

  let targetRotY = 0, currentRotY = 0;
  let targetRotX = 0, currentRotX = 0;

  window.addEventListener('scroll', () => {
    const stage    = document.getElementById('model-scroll-stage');
    const rect     = stage.getBoundingClientRect();
    const total    = stage.offsetHeight - window.innerHeight;
    const scrolled = Math.max(0, -rect.top);
    const progress = Math.min(1, scrolled / total);
    targetRotY = (progress - 0.5) * Math.PI * (2 / 3);
    targetRotX = Math.sin(progress * Math.PI) * 0.15;
    const deg = Math.round(((progress - 0.5) * 120 + 360) % 360);
    hudAngle.textContent = 'ROT ' + String(deg).padStart(3, '0') + '°';
  }, { passive: true });

  let mouseX = 0, mouseY = 0;
  document.addEventListener('mousemove', e => {
    mouseX = (e.clientX / window.innerWidth  - 0.5) * 0.15;
    mouseY = (e.clientY / window.innerHeight - 0.5) * 0.1;
  });

  let frame = 0;
  function tick() {
    requestAnimationFrame(tick);
    frame++;
    if (modelGroup) {
      currentRotY += (targetRotY + mouseX - currentRotY) * 0.06;
      currentRotX += (targetRotX + mouseY - currentRotX) * 0.06;
      modelGroup.rotation.y = currentRotY;
      modelGroup.rotation.x = currentRotX;
    }
    accentLight.intensity = 1.2 + Math.sin(frame * 0.02) * 0.4;
    renderer.render(scene, camera);
  }

  resize();

})();
</script>