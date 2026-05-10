    <?php $page = 'Tableau de bord'; ?>
    <?= view('header', ['activeMenu' => 'dashboard']) ?>
    <style>
      .dashboard-hero {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(260px, 0.9fr);
        gap: 18px;
        align-items: stretch;
      }

      .dashboard-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(96, 165, 250, 0.12);
        color: #dbeafe;
        font-size: 0.78rem;
        letter-spacing: 0.02em;
      }

      .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
      }

      .kpi-card {
        padding: 20px;
        border-radius: 18px;
        background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.015));
        border: 1px solid rgba(255,255,255,0.06);
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.18);
      }

      .kpi-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
      }

      .kpi-icon {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        background: rgba(74, 222, 128, 0.12);
        color: var(--accent);
        font-size: 1rem;
      }

      .kpi-value {
        font-family: var(--font-display);
        font-size: 2rem;
        line-height: 1;
        margin-bottom: 8px;
      }

      .kpi-sub {
        color: var(--text-muted);
        font-size: 0.82rem;
      }

      .chart-card {
        min-height: 360px;
      }

      .pie-chart-wrap {
        display: grid;
        grid-template-columns: minmax(180px, 240px) minmax(0, 1fr);
        gap: 18px;
        align-items: center;
      }

      .pie-chart {
        width: 220px;
        aspect-ratio: 1;
        border-radius: 50%;
        position: relative;
        margin: 0 auto;
        box-shadow: inset 0 0 0 18px rgba(10, 15, 12, 0.35);
      }

      .pie-chart::after {
        content: '';
        position: absolute;
        inset: 28%;
        border-radius: 50%;
        background: var(--surface);
        box-shadow: 0 0 0 1px rgba(255,255,255,0.05);
      }

      .legend-list {
        display: grid;
        gap: 12px;
      }

      .legend-item {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        align-items: center;
        padding: 12px 14px;
        border-radius: 14px;
        background: rgba(255,255,255,0.03);
      }

      .legend-left {
        display: flex;
        align-items: center;
        gap: 12px;
      }

      .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex: 0 0 auto;
      }

      .bar-chart {
        display: flex;
        align-items: end;
        gap: 16px;
        min-height: 260px;
        padding-top: 12px;
      }

      .bar-item {
        flex: 1;
        min-width: 0;
        text-align: center;
      }

      .bar-track {
        height: 220px;
        display: flex;
        align-items: end;
        justify-content: center;
        border-radius: 18px 18px 10px 10px;
        background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.015));
        border: 1px solid rgba(255,255,255,0.06);
        overflow: hidden;
      }

      .bar-fill {
        width: 100%;
        border-radius: 18px 18px 10px 10px;
        background: linear-gradient(180deg, var(--accent2), var(--accent));
        min-height: 8px;
      }

      .bar-meta {
        margin-top: 10px;
        font-size: 0.8rem;
        color: var(--text-muted);
      }

      .table-wrap {
        overflow: auto;
      }

      .admin-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 760px;
      }

      .admin-table th,
      .admin-table td {
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        font-size: 0.9rem;
      }

      .admin-table th {
        color: var(--text-muted);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
      }

      .pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
      }

      .pill.credit {
        background: rgba(74, 222, 128, 0.14);
        color: #86efac;
      }

      .pill.muted {
        background: rgba(255,255,255,0.06);
        color: var(--text-muted);
      }

      @media (max-width: 1100px) {
        .kpi-grid {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-hero,
        .pie-chart-wrap {
          grid-template-columns: 1fr;
        }

        .pie-chart {
          width: 190px;
        }
      }

      @media (max-width: 720px) {
        .kpi-grid {
          grid-template-columns: 1fr;
        }

        .bar-chart {
          flex-direction: column;
          align-items: stretch;
        }

        .bar-item {
          display: grid;
          grid-template-columns: 1fr 2.6fr;
          gap: 12px;
          align-items: center;
        }

        .bar-track {
          height: 120px;
        }
      }
    </style>

    <div class="page active" id="pg-dashboard">
      <div class="page-header dashboard-hero">
        <div class="card" style="padding:24px;display:flex;flex-direction:column;justify-content:space-between;gap:16px;">
          <div>
            <div class="dashboard-badge">Espace administrateur</div>
            <h1 style="margin-top:14px;"><span class="accent-dot"></span>Tableau de bord</h1>
            <p>Vue synthétique de l'activité de la plateforme et des recharges effectuées.</p>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:10px;color:var(--text-muted);font-size:0.88rem;">
            <span class="pill muted">Utilisateurs: <?= number_format((float) $totalUsers, 0, ',', ' ') ?></span>
            <span class="pill muted">Gold: <?= number_format((float) $goldUsers, 0, ',', ' ') ?></span>
            <span class="pill muted">Solde global: <?= number_format((float) $totalWallet, 0, ',', ' ') ?> Ar</span>
          </div>
        </div>

        <div class="card" style="padding:24px;display:flex;flex-direction:column;justify-content:center;gap:14px;background:linear-gradient(180deg, rgba(74,222,128,0.12), rgba(96,165,250,0.08));">
          <div style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.12em;color:var(--text-muted);">Administrateur connecté</div>
          <div style="font-family:var(--font-display);font-size:1.7rem;line-height:1.2;">
            <?= esc(trim(($currentUser['prenom'] ?? '') . ' ' . ($currentUser['nom'] ?? ''))) ?: 'Administrateur' ?>
          </div>
          <div style="color:var(--text-muted);font-size:0.88rem;">
            <?= esc($currentUser['email'] ?? '') ?>
          </div>
        </div>
      </div>

      <div class="kpi-grid section-gap">
        <div class="kpi-card">
          <div class="kpi-label"><div class="kpi-icon">👥</div> Utilisateurs inscrits</div>
          <div class="kpi-value"><?= number_format((float) $totalUsers, 0, ',', ' ') ?></div>
          <div class="kpi-sub">Nombre total de comptes créés</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-label"><div class="kpi-icon">⭐</div> Option Gold</div>
          <div class="kpi-value"><?= number_format((float) $goldUsers, 0, ',', ' ') ?></div>
          <div class="kpi-sub">Utilisateurs actifs en formule Gold</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-label"><div class="kpi-icon">💰</div> Solde total</div>
          <div class="kpi-value"><?= number_format((float) $totalWallet, 0, ',', ' ') ?> <span style="font-size:1rem;">Ar</span></div>
          <div class="kpi-sub">Montant cumulé dans tous les porte-monnaies</div>
        </div>
        <div class="kpi-card">
          <div class="kpi-label"><div class="kpi-icon">🎯</div> Objectifs suivis</div>
          <div class="kpi-value"><?= number_format((float) $objectiveTotal, 0, ',', ' ') ?></div>
          <div class="kpi-sub">Achats de programmes analysés pour les graphiques</div>
        </div>
      </div>

      <div class="grid-2 section-gap">
        <div class="card chart-card">
          <div class="card-title">📊 Répartition des objectifs choisis</div>
          <div class="pie-chart-wrap">
            <div class="pie-chart" style="background: <?= esc($pieBackground) ?>;"></div>
            <div class="legend-list">
              <?php foreach ($objectiveChart as $item): ?>
                <?php
                  $percent = $objectiveTotal > 0 ? round(($item['value'] * 100) / $objectiveTotal, 1) : 0;
                ?>
                <div class="legend-item">
                  <div class="legend-left">
                    <span class="legend-dot" style="background: <?= esc($item['color']) ?>;"></span>
                    <div>
                      <div style="font-weight:700;"><?= esc($item['label']) ?></div>
                      <div style="font-size:0.78rem;color:var(--text-muted);"><?= number_format((float) $item['value'], 0, ',', ' ') ?> demande(s)</div>
                    </div>
                  </div>
                  <div style="font-family:var(--font-display);font-size:1.05rem;"><?= $percent ?>%</div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="card chart-card">
          <div class="card-title">🏆 Régimes les plus populaires</div>
          <?php if (!empty($popularRegimes)): ?>
            <div class="bar-chart">
              <?php foreach ($popularRegimes as $regime): ?>
                <div class="bar-item">
                  <div class="bar-track">
                    <div class="bar-fill" style="height: <?= (int) $regime['bar_height'] ?>%;"></div>
                  </div>
                  <div class="bar-meta">
                    <div style="font-weight:700;color:var(--text);margin-bottom:4px;"><?= esc($regime['nom_regime'] ?? 'Régime') ?></div>
                    <div><?= number_format((float) $regime['total_achats'], 0, ',', ' ') ?> achat(s)</div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div style="height:240px;display:grid;place-items:center;color:var(--text-muted);">
              Aucun achat de régime enregistré pour le moment.
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="card section-gap">
        <div class="card-title">💳 Dernières recharges de porte-monnaie</div>
        <div class="table-wrap">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Utilisateur</th>
                <th>Code utilisé</th>
                <th>Montant</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($rechargeTransactions)): ?>
                <?php foreach ($rechargeTransactions as $transaction): ?>
                  <tr>
                    <td><?= esc($transaction['user_name'] ?: 'Utilisateur inconnu') ?></td>
                    <td><span class="pill muted"><?= esc($transaction['code']) ?></span></td>
                    <td><span class="pill credit"><?= esc($transaction['montant_formatted']) ?> Ar</span></td>
                    <td><?= esc($transaction['date_formatted']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="4" style="text-align:center;color:var(--text-muted);padding:24px 16px;">Aucune recharge via code enregistrée.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?= view('footer') ?>

    <script>
      function navigate(page, el) {
        const routes = {
          dashboard: '/dashboard',
          profil: '/profil/<?= (int) ($currentUser['id'] ?? 0) ?>',
          regimes: '/regimes',
          sports: '/sports',
          codes: '/codes',
          wallet: '/porte_monnaie/<?= (int) ($currentUser['id'] ?? 0) ?>',
          monregime: '/monRegime',
        };

        if (routes[page]) {
          window.location.href = routes[page];
        }
      }
    </script>