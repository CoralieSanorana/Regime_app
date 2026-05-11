<?php $page = 'Option Gold'; ?>
<?= view('header', ['activeMenu' => 'gold']) ?>

    <div class="page active" id="pg-gold">
      <div class="page-header">
        <h1>Option Gold ⭐</h1>
        <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
        <?php else: ?>
          <p>Débloquez des avantages exclusifs en une seule fois</p>
        <?php endif; ?>
      </div>

      <div class="gold-promo">
        <div class="gold-crown">👑</div>
        <div class="gold-promo-content">
          <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
            <h3>Vous bénéficiez déjà de l'Option Gold !</h3>
          <?php else: ?>
            <h3>Passez à l'Option Gold dès aujourd'hui !</h3>
          <?php endif; ?>  
          <p>Profitez de 15% de remise sur tous les régimes, des recommandations avancées, et d'un accès prioritaire aux nouveaux programmes.</p>
          <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
            <span class="badge badge-gold">⭐ GOLD ACTIF</span>
          <?php endif; ?>
        </div>
      </div>

      <div class="grid-3">
        <div class="card" style="border-color:rgba(245,158,11,0.2);">
          <div style="font-size:2rem;margin-bottom:12px;">💰</div>
          <div style="font-family:var(--font-display);font-weight:600;margin-bottom:6px;">-15% sur les régimes</div>
          <div style="font-size:0.82rem;color:var(--text-muted);">Réduction automatique appliquée sur chaque achat de régime.</div>
        </div>
        <div class="card" style="border-color:rgba(245,158,11,0.2);">
          <div style="font-size:2rem;margin-bottom:12px;">🎯</div>
          <div style="font-family:var(--font-display);font-weight:600;margin-bottom:6px;">Recommandations avancées</div>
          <div style="font-size:0.82rem;color:var(--text-muted);">Algorithme de suggestion plus précis avec suivi personnalisé.</div>
        </div>
        <div class="card" style="border-color:rgba(245,158,11,0.2);">
          <div style="font-size:2rem;margin-bottom:12px;">📊</div>
          <div style="font-family:var(--font-display);font-weight:600;margin-bottom:6px;">Statistiques détaillées</div>
          <div style="font-size:0.82rem;color:var(--text-muted);">Accès à l'historique complet et aux graphiques d'évolution.</div>
        </div>
      </div>

      <div style="margin-top:24px;padding:24px;background:var(--surface);border:1px dashed rgba(245,158,11,0.25);border-radius:var(--radius);text-align:center;">
        <div style="font-family:var(--font-display);font-size:1.4rem;color:var(--gold);margin-bottom:6px;">Prix Gold : <?php if(!empty($prix)) { echo number_format($prix, 0, ',', ' '); } ?> Ar</div>
        <div style="font-size:0.85rem;color:var(--text-muted);margin-bottom:16px;">Paiement unique — Accès à vie · Remboursable sur le porte-monnaie NutriPath</div>

        <?php if(!empty($is_gold) && (int) $is_gold === 1): ?>
          <button class="btn btn-gold" style="opacity:0.5;cursor:default;">✓ Déjà actif sur votre compte</button>
        <?php else: ?>
          <button class="btn btn-gold" onclick="activateGold()" style="opacity:1;cursor:default;">Activer sur votre compte</button>
        <?php endif; ?>
        
      </div>
    </div>

  </div></div><div class="notif" id="toast">
  <span class="notif-icon">✅</span>
  <span id="toast-msg">Opération réussie</span>
</div>

<?= view('footer') ?>

<script src="<?= base_url('assets/js/gold.js') ?>"></script>

</body>
</html>