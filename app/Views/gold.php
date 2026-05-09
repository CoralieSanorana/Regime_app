<?= view('header', ['activeMenu' => 'gold']) ?>

<div class="page active" id="pg-gold">
    <div class="page-header">
        <h1>Option Gold</h1>
        <p>Suivez l'état de votre formule Gold et ses avantages.</p>
    </div>

    <div class="card">
        <div class="card-title">⭐ Statut Gold</div>
        <?php if (!empty($user['is_gold'])): ?>
            <div style="padding:16px;border-radius:14px;background:rgba(74,222,128,0.12);color:#dcfce7;font-size:1.05rem;line-height:1.6;">
                Votre compte est actuellement en mode Gold. Vous bénéficiez déjà des avantages premium.
            </div>
        <?php else: ?>
            <div style="padding:16px;border-radius:14px;background:rgba(96,165,250,0.12);color:#dbeafe;font-size:1.05rem;line-height:1.6;">
                Votre compte n'est pas encore Gold. Cette page peut servir de point d'entrée pour afficher ou activer des avantages premium.
            </div>
        <?php endif; ?>
    </div>
</div>

    </div>
    </div>
</body>
</html>