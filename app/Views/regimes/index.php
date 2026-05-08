    <?= view('header', ['activeMenu' => 'regimes']) ?>
    <div class="page active" id="pg-regimes">
        <div class="container mt-5">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Liste des régimes
                        <a href="/regimes/add" class="btn btn-primary">Ajouter un régime</a>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <?php if (session()->getFlashdata('succes')): ?>
                                <div class="alert alert-success mb-0">
                                    <?= session()->getFlashdata('succes') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger mb-0">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom du régime</th>
                    <th>Description</th>
                    <th>Viande (%)</th>
                    <th>Volaille (%)</th>
                    <th>Poisson (%)</th>
                    <th>Impact (kg/jour)</th>
                    <th>Prix journalier (Ar)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($regimes as $regime): ?>
                    <tr>
                        <td>#<?= $regime['id'] ?> <?= $regime['nom_regime'] ?></td>
                        <td><?= $regime['description'] ?></td>
                        <td><?= $regime['pourcentage_viande'] ?></td>
                        <td><?= $regime['pourcentage_volaille'] ?></td>
                        <td><?= $regime['pourcentage_poisson'] ?></td>
                        <td><?= $regime['poids_impact_journalier'] ?></td>
                        <td><?= $regime['prix_journalier'] ?></td>
                        <td>
                            <a href="/regimes/edit/<?= $regime['id'] ?>" class="btn btn-warning btn-sm"><img src="<?= base_url('/assets/images/editer.png') ?>" alt="Modifier" width="20" height="20"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>