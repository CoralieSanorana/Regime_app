// ── BACKGROUND CANVAS ──
const canvas = document.getElementById('bg');

if (canvas) {
  const ctx = canvas.getContext('2d');

  function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  // Dots
  const DOTS = [];
  for (let i = 0; i < 120; i++) {
    DOTS.push({
      x: Math.random() * window.innerWidth,
      y: Math.random() * window.innerHeight,
      r: Math.random() * 1.5 + 0.3,
      a: Math.random() * 0.5 + 0.1,
      speed: Math.random() * 0.15 + 0.05
    });
  }

  // Diagonal lines
  const LINES = [];
  for (let i = 0; i < 8; i++) {
    LINES.push({
      x1: Math.random() * 1.5 * window.innerWidth,
      y1: -100,
      x2: Math.random() * 1.5 * window.innerWidth,
      y2: window.innerHeight + 100,
      color: i % 2 === 0 ? '#00cfff' : '#00ff88',
      alpha: Math.random() * 0.04 + 0.015,
      angle: (Math.random() - 0.5) * 0.6
    });
  }

  // Hexagons / geometric nodes
  const NODES = [];
  for (let i = 0; i < 18; i++) {
    NODES.push({
      x: Math.random() * window.innerWidth,
      y: Math.random() * window.innerHeight,
      size: Math.random() * 30 + 10,
      color: i % 3 === 0 ? '#00cfff' : i % 3 === 1 ? '#00ff88' : '#ffffff',
      alpha: Math.random() * 0.06 + 0.02,
      rot: Math.random() * Math.PI * 2,
      rotSpeed: (Math.random() - 0.5) * 0.003
    });
  }

  let t = 0;
  function draw() {
    t++;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Background gradient
    const bg = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
    bg.addColorStop(0, '#040810');
    bg.addColorStop(0.5, '#060d1a');
    bg.addColorStop(1, '#040810');
    ctx.fillStyle = bg;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Ambient glow blobs
    const glows = [
      { x: canvas.width * 0.15, y: canvas.height * 0.25, r: 300, c: '#00cfff', a: 0.07 },
      { x: canvas.width * 0.85, y: canvas.height * 0.75, r: 280, c: '#00ff88', a: 0.06 },
      { x: canvas.width * 0.5, y: canvas.height * 0.5, r: 220, c: '#00cfff', a: 0.03 },
    ];
    glows.forEach(g => {
      const grad = ctx.createRadialGradient(g.x, g.y, 0, g.x, g.y, g.r);
      grad.addColorStop(0, g.c + Math.round(g.a * 255).toString(16).padStart(2, '0'));
      grad.addColorStop(1, 'transparent');
      ctx.fillStyle = grad;
      ctx.fillRect(0, 0, canvas.width, canvas.height);
    });

    // Diagonal lines
    LINES.forEach(l => {
      ctx.save();
      ctx.translate((l.x1 + l.x2) / 2, canvas.height / 2);
      ctx.rotate(l.angle);
      ctx.translate(-(l.x1 + l.x2) / 2, -canvas.height / 2);
      ctx.beginPath();
      ctx.moveTo(l.x1, l.y1);
      ctx.lineTo(l.x2, l.y2);
      ctx.strokeStyle = l.color + Math.round(l.alpha * 255).toString(16).padStart(2, '0');
      ctx.lineWidth = 0.7;
      ctx.stroke();
      ctx.restore();
    });

    // Geometric nodes (hexagons)
    NODES.forEach(n => {
      n.rot += n.rotSpeed;
      ctx.save();
      ctx.translate(n.x, n.y);
      ctx.rotate(n.rot);
      ctx.beginPath();
      for (let i = 0; i < 6; i++) {
        const angle = (Math.PI / 3) * i;
        const px = Math.cos(angle) * n.size;
        const py = Math.sin(angle) * n.size;
        i === 0 ? ctx.moveTo(px, py) : ctx.lineTo(px, py);
      }
      ctx.closePath();
      ctx.strokeStyle = n.color + Math.round(n.alpha * 255).toString(16).padStart(2, '0');
      ctx.lineWidth = 0.5;
      ctx.stroke();
      ctx.restore();
    });

    // Small cross marks
    for (let i = 0; i < 6; i++) {
      const bx = (canvas.width / 7) * (i + 1);
      const by = canvas.height * 0.5 + Math.sin(t * 0.008 + i) * 20;
      ctx.save();
      ctx.globalAlpha = 0.08;
      ctx.strokeStyle = i % 2 === 0 ? '#00cfff' : '#00ff88';
      ctx.lineWidth = 0.8;
      ctx.beginPath();
      ctx.moveTo(bx - 6, by);
      ctx.lineTo(bx + 6, by);
      ctx.stroke();
      ctx.beginPath();
      ctx.moveTo(bx, by - 6);
      ctx.lineTo(bx, by + 6);
      ctx.stroke();
      ctx.restore();
    }

    // Dots
    DOTS.forEach((d, i) => {
      d.y -= d.speed;
      if (d.y < -2) {
        d.y = canvas.height + 2;
        d.x = Math.random() * canvas.width;
      }
      const pulse = 0.5 + 0.5 * Math.sin(t * 0.03 + i);
      ctx.beginPath();
      ctx.arc(d.x, d.y, d.r, 0, Math.PI * 2);
      ctx.fillStyle = (i % 3 === 0 ? '#00cfff' : '#00ff88') + Math.round((d.a * pulse + 0.05) * 255).toString(16).padStart(2, '0');
      ctx.fill();
    });

    requestAnimationFrame(draw);
  }
  draw();
}
