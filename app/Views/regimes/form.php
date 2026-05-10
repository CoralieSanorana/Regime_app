<?php $page = 'Régimes'; ?>
    <?= view('header', ['activeMenu' => 'regimes']) ?>
    <?php $isEdit = isset($regime) && !empty($regime); ?>
        <div class="page active" id="pg-regimes-add">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-title"><?= $isEdit ? 'Modifier le régime' : 'Ajouter un nouveau régime' ?></div>
                    <div class="card-body">
                        <form action="<?= $isEdit ? '/regimes/update/' . $regime['id'] : '/regimes/add' ?>" method="post">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nom_regime">Nom du régime</label>
                                    <input type="text" class="form-control" id="nom_regime" name="nom_regime" value="<?= isset($regime['nom_regime']) ? $regime['nom_regime'] : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required><?= isset($regime['description']) ? $regime['description'] : '' ?></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="viande">Viande (%)</label>
                                    <input type="number" class="form-control" id="viande" name="viande" min="0" value="<?= isset($regime['pourcentage_viande']) ? $regime['pourcentage_viande'] : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="volaille">Volaille (%)</label>
                                    <input type="number" class="form-control" id="volaille" name="volaille" min="0" value="<?= isset($regime['pourcentage_volaille']) ? $regime['pourcentage_volaille'] : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="poisson">Poisson (%)</label>
                                    <input type="number" class="form-control" id="poisson" name="poisson" min="0" value="<?= isset($regime['pourcentage_poisson']) ? $regime['pourcentage_poisson'] : '' ?>" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="poids_impact_journalier">Poids d'impact journalier</label>
                                    <input type="number" class="form-control" id="poids_impact_journalier" name="poids_impact_journalier" value="<?= isset($regime['poids_impact_journalier']) ? $regime['poids_impact_journalier'] : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="prix_journalier">Prix journalier</label>
                                    <input type="number" class="form-control" id="prix_journalier" name="prix_journalier" min="0" value="<?= isset($regime['prix_journalier']) ? $regime['prix_journalier'] : '' ?>" required>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Modifier le régime' : 'Ajouter le régime' ?></button>
                                <a href="/regimes" class="btn btn-outline">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?= view('footer') ?>
    
