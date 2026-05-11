<?php $page = 'Sports'; ?>
    <?= view('header', ['activeMenu' => 'sports']) ?>
    
        <div class="page active" id="pg-sports">
            <div class="container mt-5">
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Liste des sports
                            <a href="/sports/add" class="btn btn-primary">Ajouter un sport</a>
                            <a href="/sports/export-list" class="btn btn-outline btn-sm" target="_blank" rel="noopener">Export PDF</a>
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom du sport</th>
                                    <th>Description</th>
                                    <th>Effet par jour (kg)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sports as $sport): ?>
                                    <tr>
                                        <td>#<?= $sport['id'] ?> <?= esc($sport['nom_activite'] ?? $sport['nom_sport'] ?? '') ?></td>
                                        <td><?= $sport['description'] ?></td>
                                        <td><?= $sport['effet_jour'] ?></td>
                                        <td>
                                            <a href="/sports/edit/<?= $sport['id'] ?>" class="btn btn-warning btn-sm me-1"><img src="<?= base_url('/assets/images/editer.png') ?>" alt="Modifier" width="20" height="20"></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <?= view('footer') ?>
