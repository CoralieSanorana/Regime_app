<?= view('header', ['activeMenu' => 'objectif']) ?>

<div class="page active" id="pg-objectif">
    <div class="page-header">
        <h1>Mon Objectif</h1>
        <p>Définissez votre poids cible pour recevoir des suggestions adaptées.</p>
    </div>

    <div class="grid-2 section-gap">
        <div class="card">
            <div class="card-title">🎯 Choisir un objectif</div>
            <form action="/regimes/suggestions" method="post">
                <div class="form-group">
                    <label>Poids actuel</label>
                    <input type="number" value="<?= esc((string) ($currentWeight ?? '')) ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Poids cible (kg)</label>
                    <input type="number" name="poids_cible" min="1" step="0.1" placeholder="Ex: 65" required>
                </div>
                <input type="hidden" name="user_id" value="<?= esc((string) $user['id']) ?>">
                <input type="submit" class="btn btn-primary" value="Voir les suggestions">
            </form>
        </div>

        <div class="card">
            <div class="card-title">📌 Conseils rapides</div>
            <div style="display:grid;gap:12px;color:var(--text-muted);font-size:0.92rem;line-height:1.6;">
                <div style="padding:14px;border-radius:12px;background:var(--surface2);">Choisissez un objectif réaliste pour recevoir des régimes cohérents.</div>
                <div style="padding:14px;border-radius:12px;background:var(--surface2);">Le système comparera votre poids actuel et vos besoins pour générer les suggestions.</div>
            </div>
        </div>
    </div>
</div>

    </div>
    </div>
</body>
</html>