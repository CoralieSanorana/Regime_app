<?php $page = 'Sports'; ?>
    <?= view('header', ['activeMenu' => 'sports']) ?>
    <?php $isEdit = isset($sport) && !empty($sport); ?>
    <div class="page active" id="pg-sport-add">
        <div class="container mt-5">
            <div class="card">
                <div class="card-title"><?= $isEdit ? 'Modifier le sport' : 'Ajouter un nouveau sport' ?></div>
                <div class="card-body">
                    <form action="<?= $isEdit ? '/sports/update/' . $sport['id'] : '/sports/add' ?>" method="post">
                        <div class="form-group">
                            <label for="nom_sport">Nom du sport</label>
                            <input type="text" class="form-control" id="nom_sport" name="nom_sport" value="<?= isset($sport['nom_activite']) ? $sport['nom_activite'] : '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= isset($sport['description']) ? $sport['description'] : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="effet_jour">Effet par jour (kg)</label>
                            <input type="number" class="form-control" id="effet_jour" name="effet_jour" value="<?= isset($sport['effet_jour']) ? $sport['effet_jour'] : '' ?>" step="any" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Modifier le sport' : 'Ajouter le sport' ?></button>
                        <a href="/sports" class="btn btn-outline">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= view('footer') ?>