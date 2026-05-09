<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NutriPath — Votre parcours santé</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Satoshi:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
  /* ============ CSS VARIABLES ============ */
  :root {
    --bg: #0a0e0b;
    --surface: #111614;
    --surface2: #181f1b;
    --border: #1f2b23;
    --accent: #4ade80;
    --accent2: #86efac;
    --accent-glow: rgba(74, 222, 128, 0.18);
    --gold: #f59e0b;
    --gold-light: #fcd34d;
    --text: #e8f5ec;
    --text-muted: #7a9983;
    --text-dim: #3d5445;
    --danger: #f87171;
    --info: #60a5fa;
    --radius: 16px;
    --radius-sm: 10px;
    --font-display: 'Clash Display', sans-serif;
    --font-body: 'Satoshi', sans-serif;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: var(--font-body);
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    overflow-x: hidden;
  }

  /* ============ NOISE TEXTURE OVERLAY ============ */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 9999;
    opacity: 0.4;
  }

  /* ============ TYPOGRAPHY ============ */
  h1, h2, h3, .brand { font-family: var(--font-display); }

  /* ============ LAYOUT SHELL ============ */
  .app { display: flex; min-height: 100vh; }

  /* ============ SIDEBAR ============ */
  .sidebar {
    width: 260px;
    flex-shrink: 0;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    padding: 28px 0;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
  }

  .brand {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--accent);
    padding: 0 28px 32px;
    letter-spacing: -0.03em;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .brand-icon {
    width: 36px; height: 36px;
    background: var(--accent-glow);
    border: 1px solid var(--accent);
    border-radius: 10px;
    display: grid;
    place-items: center;
    font-size: 18px;
  }

  .nav-section {
    padding: 0 16px 8px;
    margin-bottom: 4px;
  }

  .nav-label {
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    color: var(--text-dim);
    text-transform: uppercase;
    padding: 0 12px;
    margin-bottom: 6px;
  }

  .nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0.88rem;
    font-weight: 500;
    color: var(--text-muted);
    text-decoration: none;
    margin-bottom: 2px;
  }

  .nav-item:hover { background: var(--surface2); color: var(--text); }

  .nav-item.active {
    background: var(--accent-glow);
    color: var(--accent);
    border: 1px solid rgba(74,222,128,0.2);
  }

  .nav-item .icon {
    width: 32px; height: 32px;
    display: grid; place-items: center;
    border-radius: 8px;
    font-size: 15px;
    background: var(--surface2);
    flex-shrink: 0;
  }

  .nav-item.active .icon {
    background: rgba(74,222,128,0.15);
  }

  .sidebar-footer {
    margin-top: auto;
    padding: 16px 28px;
    border-top: 1px solid var(--border);
  }

  .user-card {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #16a34a);
    display: grid;
    place-items: center;
    font-weight: 700;
    font-size: 0.85rem;
    color: var(--bg);
    flex-shrink: 0;
  }

  .user-info .name { font-size: 0.85rem; font-weight: 600; }
  .user-info .email { font-size: 0.72rem; color: var(--text-muted); }

  /* ============ MAIN CONTENT ============ */
  .main {
    flex: 1;
    overflow-x: hidden;
    display: flex;
    flex-direction: column;
  }

  /* ============ TOP BAR ============ */
  .topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 36px;
    border-bottom: 1px solid var(--border);
    background: var(--surface);
    position: sticky;
    top: 0;
    z-index: 100;
  }

  .topbar-title {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 600;
  }

  .topbar-actions { display: flex; align-items: center; gap: 12px; }

  .wallet-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 100px;
    background: var(--surface2);
    border: 1px solid var(--border);
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }

  .wallet-badge:hover { border-color: var(--accent); color: var(--accent); }
  .wallet-badge .amount { color: var(--accent); }

  .gold-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 100px;
    background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(245,158,11,0.05));
    border: 1px solid rgba(245,158,11,0.35);
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--gold);
    letter-spacing: 0.05em;
  }

  /* ============ PAGE CONTENT ============ */
  .page { display: none; padding: 36px; animation: fadeIn 0.35s ease; }
  .page.active { display: block; }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* ============ PAGE HEADER ============ */
  .page-header { margin-bottom: 32px; }
  .page-header h1 {
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: -0.04em;
    line-height: 1.1;
    margin-bottom: 8px;
  }

  .page-header p { color: var(--text-muted); font-size: 0.9rem; }

  .accent-dot {
    display: inline-block;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--accent);
    margin-right: 6px;
    animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(74,222,128,0.4); }
    50% { box-shadow: 0 0 0 6px rgba(74,222,128,0); }
  }

  /* ============ CARDS ============ */
  .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 24px;
  }

  .card-title {
    font-family: var(--font-display);
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* ============ GRID ============ */
  .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
  .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }

  /* ============ STATS CARDS (DASHBOARD) ============ */
  .stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px;
    position: relative;
    overflow: hidden;
    transition: border-color 0.2s;
  }

  .stat-card::before {
    content: '';
    position: absolute;
    top: -30px; right: -30px;
    width: 100px; height: 100px;
    border-radius: 50%;
    opacity: 0.06;
  }

  .stat-card.green::before { background: var(--accent); }
  .stat-card.gold::before { background: var(--gold); }
  .stat-card.blue::before { background: var(--info); }
  .stat-card.red::before { background: var(--danger); }

  .stat-card:hover { border-color: var(--text-dim); }

  .stat-label {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .stat-icon {
    width: 28px; height: 28px;
    border-radius: 8px;
    display: grid; place-items: center;
    font-size: 14px;
  }

  .stat-card.green .stat-icon { background: rgba(74,222,128,0.12); }
  .stat-card.gold .stat-icon { background: rgba(245,158,11,0.12); }
  .stat-card.blue .stat-icon { background: rgba(96,165,250,0.12); }
  .stat-card.red .stat-icon { background: rgba(248,113,113,0.12); }

  .stat-value {
    font-family: var(--font-display);
    font-size: 2.2rem;
    font-weight: 700;
    letter-spacing: -0.04em;
    line-height: 1;
    margin-bottom: 6px;
  }

  .stat-card.green .stat-value { color: var(--accent); }
  .stat-card.gold .stat-value { color: var(--gold); }
  .stat-card.blue .stat-value { color: var(--info); }
  .stat-card.red .stat-value { color: var(--danger); }

  .stat-sub { font-size: 0.78rem; color: var(--text-muted); }

  /* ============ FORMS ============ */
  .form-group { margin-bottom: 20px; }

  label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    color: var(--text-muted);
    margin-bottom: 8px;
    text-transform: uppercase;
  }

  input, select, textarea {
    width: 100%;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 12px 16px;
    color: var(--text);
    font-family: var(--font-body);
    font-size: 0.9rem;
    transition: all 0.2s;
    outline: none;
  }

  input:focus, select:focus, textarea:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(74,222,128,0.1);
  }

  input::placeholder { color: var(--text-dim); }

  select option { background: var(--surface2); }

  /* ============ BUTTONS ============ */
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 22px;
    border-radius: var(--radius-sm);
    font-family: var(--font-body);
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
    letter-spacing: 0.02em;
  }

  .btn-primary {
    background: var(--accent);
    color: var(--bg);
  }

  .btn-primary:hover {
    background: var(--accent2);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(74,222,128,0.25);
  }

  .btn-outline {
    background: transparent;
    color: var(--text);
    border: 1px solid var(--border);
  }

  .btn-outline:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  .btn-gold {
    background: linear-gradient(135deg, var(--gold), #d97706);
    color: var(--bg);
  }

  .btn-gold:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(245,158,11,0.3);
  }

  .btn-danger {
    background: rgba(248,113,113,0.12);
    color: var(--danger);
    border: 1px solid rgba(248,113,113,0.2);
  }

  .btn-danger:hover { background: rgba(248,113,113,0.2); }

  .btn-sm { padding: 8px 14px; font-size: 0.8rem; }

  .btn-icon {
    padding: 10px;
    background: var(--surface2);
    border: 1px solid var(--border);
    color: var(--text-muted);
    border-radius: var(--radius-sm);
  }

  .btn-icon:hover { color: var(--accent); border-color: var(--accent); }

  /* ============ STEP PROGRESS ============ */
  .step-progress {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 36px;
  }

  .step {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
  }

  .step-circle {
    width: 36px; height: 36px;
    border-radius: 50%;
    display: grid; place-items: center;
    font-weight: 700;
    font-size: 0.85rem;
    flex-shrink: 0;
    border: 2px solid var(--border);
    color: var(--text-muted);
    background: var(--surface2);
    transition: all 0.3s;
  }

  .step.done .step-circle {
    background: var(--accent);
    border-color: var(--accent);
    color: var(--bg);
  }

  .step.active .step-circle {
    border-color: var(--accent);
    color: var(--accent);
    box-shadow: 0 0 0 4px rgba(74,222,128,0.15);
  }

  .step-label { font-size: 0.78rem; font-weight: 600; color: var(--text-muted); }
  .step.active .step-label { color: var(--text); }
  .step.done .step-label { color: var(--accent); }

  .step-line {
    flex: 1;
    height: 2px;
    background: var(--border);
    margin: 0 8px;
  }

  .step-line.done { background: var(--accent); }

  /* ============ IMC GAUGE ============ */
  .imc-display {
    display: flex;
    align-items: center;
    gap: 32px;
    padding: 28px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    margin-bottom: 24px;
  }

  .imc-ring {
    position: relative;
    width: 120px; height: 120px;
    flex-shrink: 0;
  }

  .imc-ring svg { transform: rotate(-90deg); }

  .imc-value-wrap {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2px;
  }

  .imc-number {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent);
    letter-spacing: -0.04em;
  }

  .imc-unit { font-size: 0.65rem; color: var(--text-muted); }

  .imc-info h3 {
    font-family: var(--font-display);
    font-size: 1.2rem;
    margin-bottom: 4px;
  }

  .imc-status {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 100px;
    font-size: 0.75rem;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .status-normal { background: rgba(74,222,128,0.12); color: var(--accent); }
  .status-over { background: rgba(248,113,113,0.12); color: var(--danger); }
  .status-under { background: rgba(96,165,250,0.12); color: var(--info); }

  .imc-scale {
    display: flex;
    gap: 4px;
    align-items: center;
    font-size: 0.7rem;
    color: var(--text-muted);
    flex-wrap: wrap;
  }

  .scale-seg {
    padding: 3px 8px;
    border-radius: 4px;
    font-weight: 600;
  }

  /* ============ OBJECTIF CARDS ============ */
  .objective-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; margin-bottom: 28px; }

  .obj-card {
    background: var(--surface);
    border: 2px solid var(--border);
    border-radius: var(--radius);
    padding: 24px 20px;
    cursor: pointer;
    transition: all 0.25s;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .obj-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: var(--accent);
    transform: scaleX(0);
    transition: transform 0.25s;
  }

  .obj-card:hover { border-color: var(--text-dim); transform: translateY(-3px); }
  .obj-card:hover::before { transform: scaleX(1); }

  .obj-card.selected {
    border-color: var(--accent);
    background: var(--accent-glow);
  }

  .obj-card.selected::before { transform: scaleX(1); }

  .obj-emoji { font-size: 2.4rem; margin-bottom: 12px; }
  .obj-title { font-family: var(--font-display); font-size: 1rem; font-weight: 600; margin-bottom: 6px; }
  .obj-desc { font-size: 0.78rem; color: var(--text-muted); line-height: 1.5; }

  /* ============ REGIME CARDS ============ */
  .regime-list { display: flex; flex-direction: column; gap: 16px; }

  .regime-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 22px 24px;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 20px;
    align-items: center;
    cursor: pointer;
    transition: all 0.2s;
    position: relative;
    overflow: hidden;
  }

  .regime-card::after {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: var(--accent);
    transform: scaleY(0);
    transition: transform 0.2s;
  }

  .regime-card:hover { border-color: var(--text-dim); }
  .regime-card:hover::after { transform: scaleY(1); }

  .regime-card.selected {
    border-color: var(--accent);
    background: var(--accent-glow);
  }

  .regime-card.selected::after { transform: scaleY(1); }

  .regime-name {
    font-family: var(--font-display);
    font-size: 1.05rem;
    font-weight: 600;
    margin-bottom: 8px;
  }

  .regime-nutrients {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 10px;
  }

  .nutrient-pill {
    padding: 4px 10px;
    border-radius: 100px;
    font-size: 0.72rem;
    font-weight: 600;
  }

  .n-viande { background: rgba(248,113,113,0.12); color: var(--danger); }
  .n-poisson { background: rgba(96,165,250,0.12); color: var(--info); }
  .n-volaille { background: rgba(245,158,11,0.12); color: var(--gold); }

  .regime-effect { font-size: 0.8rem; color: var(--text-muted); }

  .regime-price {
    text-align: right;
  }

  .price-total {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--accent);
    letter-spacing: -0.03em;
  }

  .price-sub { font-size: 0.75rem; color: var(--text-muted); }
  .duration-tag {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 100px;
    background: var(--surface2);
    font-size: 0.72rem;
    color: var(--text-muted);
    margin-top: 6px;
  }

  /* ============ TABLE ============ */
  .table-wrap {
    overflow-x: auto;
    border-radius: var(--radius);
    border: 1px solid var(--border);
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
  }

  thead tr { background: var(--surface2); }

  th {
    padding: 14px 18px;
    text-align: left;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    white-space: nowrap;
  }

  td {
    padding: 14px 18px;
    border-top: 1px solid var(--border);
    color: var(--text);
  }

  tr:hover td { background: var(--surface2); }

  .badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 100px;
    font-size: 0.7rem;
    font-weight: 700;
  }

  .badge-green { background: rgba(74,222,128,0.12); color: var(--accent); }
  .badge-gold { background: rgba(245,158,11,0.12); color: var(--gold); }
  .badge-red { background: rgba(248,113,113,0.12); color: var(--danger); }
  .badge-blue { background: rgba(96,165,250,0.12); color: var(--info); }
  .badge-gray { background: var(--surface2); color: var(--text-muted); }

  /* ============ AUTH PAGES ============ */
  .auth-shell {
    display: none;
    min-height: 100vh;
    background: var(--bg);
    position: relative;
    overflow: hidden;
  }

  .auth-shell.active { display: flex; align-items: stretch; }

  .auth-visual {
    width: 42%;
    background: linear-gradient(160deg, #0f2015 0%, #071009 60%, #0a0e0b 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px;
    position: relative;
    overflow: hidden;
    border-right: 1px solid var(--border);
  }

  .auth-visual::before {
    content: '';
    position: absolute;
    top: -100px; right: -100px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(74,222,128,0.08) 0%, transparent 70%);
  }

  .auth-visual-brand {
    font-family: var(--font-display);
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--accent);
    letter-spacing: -0.04em;
    margin-bottom: 16px;
  }

  .auth-visual p {
    color: var(--text-muted);
    font-size: 1rem;
    line-height: 1.7;
    max-width: 320px;
    margin-bottom: 40px;
  }

  .auth-features { display: flex; flex-direction: column; gap: 16px; }

  .auth-feature {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 0.88rem;
    color: var(--text-muted);
  }

  .auth-feature-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    background: rgba(74,222,128,0.08);
    border: 1px solid rgba(74,222,128,0.15);
    display: grid; place-items: center;
    font-size: 16px;
    flex-shrink: 0;
  }

  .auth-form-wrap {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px;
    overflow-y: auto;
  }

  .auth-form-wrap h2 {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: -0.04em;
    margin-bottom: 6px;
  }

  .auth-subtitle { color: var(--text-muted); font-size: 0.88rem; margin-bottom: 32px; }

  .auth-link {
    color: var(--accent);
    text-decoration: none;
    font-weight: 600;
    cursor: pointer;
  }

  .auth-link:hover { text-decoration: underline; }

  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

  .divider {
    display: flex; align-items: center;
    gap: 12px; margin: 20px 0;
    font-size: 0.78rem; color: var(--text-dim);
  }

  .divider::before, .divider::after {
    content: ''; flex: 1;
    height: 1px; background: var(--border);
  }

  /* ============ WALLET ============ */
  .wallet-display {
    background: linear-gradient(135deg, #0f2015, #071009);
    border: 1px solid rgba(74,222,128,0.2);
    border-radius: 20px;
    padding: 32px;
    position: relative;
    overflow: hidden;
    margin-bottom: 28px;
  }

  .wallet-display::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(74,222,128,0.08) 0%, transparent 70%);
  }

  .wallet-balance-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    margin-bottom: 10px;
  }

  .wallet-balance {
    font-family: var(--font-display);
    font-size: 3rem;
    font-weight: 700;
    color: var(--accent);
    letter-spacing: -0.05em;
    margin-bottom: 8px;
  }

  .wallet-currency { font-size: 1.2rem; color: var(--text-muted); }

  .wallet-transactions { }

  .transaction-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
    font-size: 0.88rem;
  }

  .transaction-item:last-child { border-bottom: none; }

  .tx-info { display: flex; align-items: center; gap: 12px; }

  .tx-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: grid; place-items: center;
    font-size: 16px;
  }

  .tx-credit .tx-icon { background: rgba(74,222,128,0.12); }
  .tx-debit .tx-icon { background: rgba(248,113,113,0.12); }

  .tx-label { font-weight: 500; }
  .tx-date { font-size: 0.75rem; color: var(--text-muted); }

  .tx-amount { font-weight: 700; font-family: var(--font-display); }
  .tx-credit .tx-amount { color: var(--accent); }
  .tx-debit .tx-amount { color: var(--danger); }

  /* ============ MINI CHART ============ */
  .chart-bar-wrap { display: flex; align-items: flex-end; gap: 6px; height: 80px; }

  .chart-bar {
    flex: 1;
    border-radius: 4px 4px 0 0;
    transition: height 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    min-height: 4px;
  }

  .bar-green { background: linear-gradient(180deg, var(--accent), rgba(74,222,128,0.4)); }
  .bar-gold { background: linear-gradient(180deg, var(--gold), rgba(245,158,11,0.4)); }
  .bar-blue { background: linear-gradient(180deg, var(--info), rgba(96,165,250,0.4)); }

  /* ============ TOGGLE ============ */
  .toggle { display: flex; background: var(--surface2); border-radius: var(--radius-sm); padding: 4px; gap: 4px; margin-bottom: 24px; width: fit-content; }

  .toggle-btn {
    padding: 9px 20px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    background: transparent;
    color: var(--text-muted);
    transition: all 0.2s;
  }

  .toggle-btn.active {
    background: var(--surface);
    color: var(--text);
    box-shadow: 0 1px 4px rgba(0,0,0,0.3);
  }

  /* ============ GOLD PROMO ============ */
  .gold-promo {
    background: linear-gradient(135deg, rgba(245,158,11,0.12) 0%, rgba(245,158,11,0.04) 100%);
    border: 1px solid rgba(245,158,11,0.25);
    border-radius: var(--radius);
    padding: 28px 32px;
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 28px;
  }

  .gold-crown { font-size: 3rem; }

  .gold-promo-content h3 {
    font-family: var(--font-display);
    font-size: 1.2rem;
    color: var(--gold);
    margin-bottom: 6px;
  }

  .gold-promo-content p { font-size: 0.85rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 14px; }

  /* ============ ACTIVITY CARDS ============ */
  .activity-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; }

  .activity-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    transition: all 0.2s;
    cursor: pointer;
  }

  .activity-card:hover { border-color: var(--accent); transform: translateY(-2px); }

  .activity-icon { font-size: 2rem; margin-bottom: 12px; }
  .activity-name { font-family: var(--font-display); font-size: 0.95rem; font-weight: 600; margin-bottom: 6px; }
  .activity-detail { font-size: 0.78rem; color: var(--text-muted); line-height: 1.5; }

  /* ============ NOTIFICATION ============ */
  .notif {
    position: fixed;
    top: 24px; right: 24px;
    background: var(--surface);
    border: 1px solid var(--accent);
    border-radius: var(--radius);
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.88rem;
    font-weight: 500;
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    transform: translateX(120%);
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 1000;
    max-width: 320px;
  }

  .notif.show { transform: translateX(0); }
  .notif-icon { font-size: 1.2rem; }

  /* ============ EXPORT BTN ============ */
  .export-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 16px 22px;
    margin-bottom: 20px;
  }

  .export-bar p { font-size: 0.85rem; color: var(--text-muted); }

  /* ============ SECTION SPACER ============ */
  .section-gap { margin-bottom: 28px; }

  /* ============ RESPONSIVE ============ */
  @media (max-width: 900px) {
    .sidebar { display: none; }
    .grid-3, .grid-4 { grid-template-columns: repeat(2,1fr); }
    .objective-grid { grid-template-columns: 1fr; }
    .activity-grid { grid-template-columns: repeat(2,1fr); }
    .auth-visual { display: none; }
    .auth-form-wrap { padding: 40px 28px; }
    .page { padding: 24px; }
    .topbar { padding: 16px 24px; }
  }

  /* ============ SCROLLBAR ============ */
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-track { background: var(--bg); }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
  ::-webkit-scrollbar-thumb:hover { background: var(--text-dim); }

  /* ============ VALIDATION STYLES ============ */
  .error-message {
    color: var(--danger);
    font-size: 0.78rem;
    font-weight: 500;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
    animation: fadeIn 0.2s ease;
  }

  /* Style pour l'input quand il y a une erreur */
  input.input-error, select.input-error {
    border-color: var(--danger) !important;
    background: rgba(248, 113, 113, 0.03); /* Un très léger fond rouge */
  }

  /* Pour que l'erreur s'affiche bien sous les inputs */
  .form-group div.error-message {
    margin-bottom: -10px; /* Ajustement optionnel selon votre espacement */
  }
</style>
</head>
<body>

<?php
    $validation = session('validation') ?? [];
    
    // Logique de détection de l'étape active après erreur
    $activeStep = 'page-register1'; // Étape par défaut
    if (isset($validation['poids_actuel']) || isset($validation['taille'])) {
        $activeStep = 'page-register2';
    } elseif (isset($validation['mot_de_passe']) || isset($validation['mot_de_passe_confirmer'])) {
        $activeStep = 'page-register3';
    }
?>

    <form action="<?= base_url('/inscription/save') ?>" method="post">
        <?= csrf_field() ?>

        <!-- ══════════════════════════════════ -->
        <!--      AUTH: REGISTER STEP 1        -->
        <!-- ══════════════════════════════════ -->
        <div class="auth-shell <?= $activeStep === 'page-register1' ? 'active' : '' ?>" id="page-register1">
            <div class="auth-visual">
                <div class="auth-visual-brand">🌿 NutriPath</div>
                <p>Rejoignez des milliers d'utilisateurs qui ont transformé leur alimentation et leur corps.</p>
                <div class="auth-features">
                    <div class="auth-feature"><div class="auth-feature-icon">✅</div><span>Inscription gratuite</span></div>
                    <div class="auth-feature"><div class="auth-feature-icon">🔒</div><span>Vos données restent privées</span></div>
                    <div class="auth-feature"><div class="auth-feature-icon">⚡</div><span>Résultats dès le premier jour</span></div>
                </div>
            </div>
            <div class="auth-form-wrap">
                <?php if (isset($validation['db'])): ?>
                    <div class="error-message" style="margin-bottom: 16px;">
                        <span style="font-size: 14px;">!</span> <?= $validation['db'] ?>
                    </div>
                <?php endif; ?>

                <div class="step-progress">
                    <div class="step active"><div class="step-circle">1</div><div class="step-label">Infos personnelles</div></div>
                    <div class="step-line"></div>
                    <div class="step"><div class="step-circle">2</div><div class="step-label">Santé</div></div>
                    <div class="step-line"></div>
                    <div class="step"><div class="step-circle">3</div><div class="step-label">Sécurité</div></div>
                </div>

                <h2>Créer un compte</h2>
                <p class="auth-subtitle">Étape 1 — Vos informations personnelles & contact.</p>

                <div class="form-row">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" placeholder="Jean" class="<?= isset($validation['prenom']) ? 'input-error' : '' ?>" value="<?= old('prenom') ?>">
                        <?php if (isset($validation['prenom'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['prenom'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" placeholder="Dupont" class="<?= isset($validation['nom']) ? 'input-error' : '' ?>" value="<?= old('nom') ?>">
                        <?php if (isset($validation['nom'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['nom'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Genre</label>
                        <select name="genre" class="<?= isset($validation['genre']) ? 'input-error' : '' ?>">
                            <option value="">— Choisir —</option>
                            <option value="M" <?= old('genre') === 'M' ? 'selected' : '' ?>>Homme</option>
                            <option value="F" <?= old('genre') === 'F' ? 'selected' : '' ?>>Femme</option>
                        </select>
                        <?php if (isset($validation['genre'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['genre'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" name="date_naissance" class="<?= isset($validation['date_naissance']) ? 'input-error' : '' ?>" value="<?= old('date_naissance') ?>">
                        <?php if (isset($validation['date_naissance'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['date_naissance'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Adresse Email</label>
                    <input type="email" name="email" placeholder="jean.dupont@mail.com" class="<?= isset($validation['email']) ? 'input-error' : '' ?>" value="<?= old('email') ?>">
                    <?php if (isset($validation['email'])): ?>
                        <div class="error-message"><span>⚠️</span> <?= $validation['email'] ?></div>
                    <?php endif; ?>
                </div>

                <button type="button" class="btn btn-primary" style="width:100%; justify-content:center;" onclick="showStep(2)">Continuer →</button>
                <div style="text-align:center; margin-top:14px; font-size:0.82rem; color:var(--text-muted);">
                  Déjà inscrit ? <a href="<?= base_url('/login') ?>" class="auth-link" >Se connecter</a>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════ -->
        <!--      AUTH: REGISTER STEP 2        -->
        <!-- ══════════════════════════════════ -->
        <div class="auth-shell <?= $activeStep === 'page-register2' ? 'active' : '' ?>" id="page-register2">
            <div class="auth-visual">
                <div class="auth-visual-brand">🌿 NutriPath</div>
                <p>Ces informations nous permettent de calculer votre IMC et de vous proposer les meilleurs régimes.</p>
            </div>
            <div class="auth-form-wrap">
                <div class="step-progress">
                    <div class="step done"><div class="step-circle">✓</div><div class="step-label">Infos</div></div>
                    <div class="step-line done"></div>
                    <div class="step active"><div class="step-circle">2</div><div class="step-label">Santé</div></div>
                    <div class="step-line"></div>
                    <div class="step"><div class="step-circle">3</div><div class="step-label">Sécurité</div></div>
                </div>

                <h2>Informations de santé</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label>Poids actuel (kg)</label>
                        <input type="number" name="poids_actuel" placeholder="70" value="<?= old('poids_actuel') ?>">
                        <?php if (isset($validation['poids_actuel'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['poids_actuel'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Taille (cm)</label>
                        <input type="number" name="taille" placeholder="175" value="<?= old('taille') ?>">
                        <?php if (isset($validation['taille'])): ?>
                            <div class="error-message"><span>⚠️</span> <?= $validation['taille'] ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top: 20px;">
                    <button type="button" class="btn btn-outline" onclick="showStep(1)">← Retour</button>
                    <button type="button" class="btn btn-primary" style="flex:1; justify-content:center;" onclick="showStep(3)">Continuer →</button>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════ -->
        <!--      AUTH: REGISTER STEP 3        -->
        <!-- ══════════════════════════════════ -->
        <div class="auth-shell <?= $activeStep === 'page-register3' ? 'active' : '' ?>" id="page-register3">
            <div class="auth-visual">
                <div class="auth-visual-brand">🌿 NutriPath</div>
                <p>Choisissez un mot de passe sécurisé pour protéger votre compte.</p>
            </div>
            <div class="auth-form-wrap">
                <div class="step-progress">
                    <div class="step done"><div class="step-circle">✓</div><div class="step-label">Infos</div></div>
                    <div class="step-line done"></div>
                    <div class="step done"><div class="step-circle">✓</div><div class="step-label">Santé</div></div>
                    <div class="step-line done"></div>
                    <div class="step active"><div class="step-circle">3</div><div class="step-label">Sécurité</div></div>
                </div>

                <h2>Sécurité du compte</h2>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" class="<?= isset($validation['mot_de_passe']) ? 'input-error' : '' ?>" value="<?= old('mot_de_passe') ?>">
                    <?php if (isset($validation['mot_de_passe'])): ?>
                        <div class="error-message"><span>⚠️</span> <?= $validation['mot_de_passe'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="mot_de_passe_confirmer" class="<?= isset($validation['mot_de_passe_confirmer']) ? 'input-error' : '' ?>" value="<?= old('mot_de_passe_confirmer') ?>">
                    <?php if (isset($validation['mot_de_passe_confirmer'])): ?>
                        <div class="error-message"><span>⚠️</span> <?= $validation['mot_de_passe_confirmer'] ?></div>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:12px; margin-top: 20px;">
                    <button type="button" class="btn btn-outline" onclick="showStep(2)">← Retour</button>
                    <button type="submit" class="btn btn-primary" style="flex:1; justify-content:center;">Créer mon compte ✓</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        // ── NAVIGATION AUTH ──
        function showLogin() {
            document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
            document.getElementById('page-login').classList.add('active');
        }

        function showRegister() {
            document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
            document.getElementById('page-register1').classList.add('active');
        }

        function showRegister2() {
            document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
            document.getElementById('page-register2').classList.add('active');
        }

        function showRegister3() {
            document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
            document.getElementById('page-register3').classList.add('active');
        }

        function showApp() {
            document.querySelectorAll('.auth-shell').forEach(p => p.classList.remove('active'));
            document.getElementById('app-shell').style.display = 'flex';
            showNotif('🌿 Bienvenue sur NutriPath, Jean !');
        }

        function showLogout() {
            document.getElementById('app-shell').style.display = 'none';
            showLogin();
        }

        // ── MAIN NAV ──
        const titles = {
            dashboard: 'Tableau de bord',
            profil: 'Mon Profil',
            objectif: 'Mon Objectif',
            suggestions: 'Régimes & Activités',
            monregime: 'Mon Régime Actuel',
            wallet: 'Porte-monnaie',
            gold: 'Option Gold ⭐'
        };

        function navigate(page, el) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.getElementById('pg-' + page).classList.add('active');
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            if (el) el.classList.add('active');
            document.getElementById('topbar-title').textContent = titles[page] || '';
        }

        // ── TABS ──
        function switchTab(btn, tabId) {
            document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('tab-regimes').style.display = tabId === 'tab-regimes' ? 'block' : 'none';
            document.getElementById('tab-activites').style.display = tabId === 'tab-activites' ? 'block' : 'none';
        }

        // ── SELECTION ──
        function selectObj(el) {
            document.querySelectorAll('.obj-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
        }

        function selectRegime(el) {
            document.querySelectorAll('.regime-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            showNotif('✅ Régime sélectionné ! Consultez "Mon Régime Actuel".');
        }

        // ── TOAST ──
        let toastTimer;
        function showNotif(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            toast.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toast.classList.remove('show'), 3500);
        }

        function showStep(stepNumber) {
            document.querySelectorAll('.auth-shell').forEach(shell => shell.classList.remove('active'));
            document.getElementById('page-register' + stepNumber).classList.add('active');
        }

        // ── ANIMATE BARS ON LOAD ──
        window.addEventListener('load', () => {
            const bars = document.querySelectorAll('.chart-bar');
            bars.forEach((b, i) => {
            const h = b.style.height;
            b.style.height = '0';
            setTimeout(() => b.style.height = h, 200 + i * 60);
            });
        });
    </script>
</body>
</html>