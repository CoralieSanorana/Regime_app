<?php $page = 'Porte-monnaie'; ?>
    <?= view('header', ['activeMenu' => 'porte_monnaie']) ?>
    <?php
    if (!isset($userId)) {
      $userId = session()->get('user_id') ?: 0;
    }
    if (!isset($userSolde)) {
      $userSolde = session()->get('user_solde') ?: 0;
    }
    ?>

        <div class="page active" id="pg-wallet">
          <div class="page-header">
            <h1>Porte-monnaie</h1>
            <p>Gérez votre solde et rechargez avec un code</p>
          </div>
    
          <div class="wallet-display">
            <div class="wallet-balance-label">Solde disponible</div>
            <div class="wallet-balance"><?= $userSolde ?> <span class="wallet-currency">Ar</span></div>
          </div>
    
          <div class="grid-2 section-gap">
            <div class="card">
              <div class="card-title">🔑 Recharger avec un code</div>
              <form action="/porte_monnaie/recharger" method="post">
                  <div class="form-group">
                    <label>Code de recharge</label>
                    <input type="text" name="code" placeholder="Ex: XXXX-XXXX" style="text-transform:uppercase;letter-spacing:0.05em;" required>
                    <input type="hidden" name="user_id" value="<?= $userId ?>">
                  </div>
                  <input type="submit" class="btn btn-primary" style="width:100%;justify-content:center;" value="💳 Valider le code">
                  <div style="margin-top:14px;padding:12px 16px;background:var(--surface2);border-radius:10px;font-size:0.8rem;color:var(--text-muted);">
                    ℹ️ Les codes de recharge sont disponibles auprès de nos partenaires ou en ligne.
                  </div>
              </form>
            </div>
    
            <div class="card">
              <div class="card-title">📜 Historique des transactions</div>
              <div class="wallet-transactions">
                <?php if (!empty($transactions)) {
                    foreach ($transactions as $tx) {
                    $type = $tx['type'] ?? '';
                    $typeClass = $type === 'credit' ? 'tx-credit' : 'tx-debit';
                    $icon = $type === 'credit' ? '➕' : '➖';
                    $description = $tx['description'] ?? 'Transaction';
                    $createdAt = !empty($tx['created_at']) ? date('j F Y', strtotime($tx['created_at'])) : '';
                    $amount = $tx['amount'] ?? 0;
                        echo '<div class="transaction-item '.$typeClass.'">
                        <div class="tx-info"><div class="tx-icon">'.$icon.'</div><div><div class="tx-label">'.$description.'</div><div class="tx-date">'.$createdAt.'</div></div></div>
                        <div class="tx-amount">'.($type === 'credit' ? '+' : '-').number_format($amount, 0, ',', ' ').' Ar</div>
                              </div>';
                    } 
                } else {
                    echo '<div style="text-align:center;color:var(--text-muted);padding:20px 0;">Aucune transaction trouvée.</div>';
                }?>
                
              </div>
            </div>
          </div>
        </div>

      <?= view('footer') ?>

      <script>
          window.addEventListener('DOMContentLoaded', function () {
            const topbarTitle = document.getElementById('topbar-title');
            if (topbarTitle) {
              topbarTitle.textContent = 'Porte-monnaie';
            }
          });
      </script>