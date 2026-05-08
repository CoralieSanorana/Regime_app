    <?= view('header', ['activeMenu' => 'codes']) ?>
    <?php $isEdit = isset($code) && !empty($code); ?>
    <div class="page active" id="pg-code-add">
        <div class="container mt-5">
            <div class="card">
                <div class="card-title"><?= $isEdit ? 'Modifier le code de recharge' : 'Ajouter un nouveau code de recharge' ?></div>
                <div class="card-body">
                    <form action="<?= $isEdit ? '/codes/update/' . $code['id'] : '/codes/add' ?>" method="post">
                        <div class="form-group">
                            <label for="code">Code de recharge</label>
                            <input type="text" class="form-control" id="code" name="code_secret" value="<?= isset($code['code_secret']) ? $code['code_secret'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="montant">Montant de la recharge (Ar)</label>
                            <input type="number" class="form-control" id="montant" name="montant" min="0" step="0.01" value="<?= isset($code['montant']) ? $code['montant'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="est_valide">Est valide</label>
                            <select name="est_valide" id="est_valide">
                                <option value="1" <?= isset($code['est_valide']) && (string) $code['est_valide'] === '1' ? 'selected' : '' ?>>Oui</option>
                                <option value="0" <?= isset($code['est_valide']) && (string) $code['est_valide'] === '0' ? 'selected' : '' ?>>Non</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Modifier le code de recharge' : 'Ajouter le code de recharge' ?></button>
                        <a href="/codes" class="btn btn-outline">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>