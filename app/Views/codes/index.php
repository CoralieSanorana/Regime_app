    <?php $page = 'Codes Promo'; ?>
    <?= view('header', ['activeMenu' => 'codes']) ?>
    <div class="page active" id="pg-codes">
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Codes de recharge
                    <a href="/codes/add" class="btn btn-primary">Ajouter un code</a>
                    <a href="/codes/export-list" class="btn btn-outline btn-sm" target="_blank" rel="noopener">Export PDF</a>
                </h2>
            </div>
            <?php if (session()->getFlashdata('succes')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('succes') ?></div>
            <?php endif; ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code de recharge</th>
                        <th>Montant de la recharge (Ar)</th>
                        <th>Est valide</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($codes as $code): ?>
                        <tr>
                            <td><?= $code['id'] ?></td>
                            <td><?= esc($code['code_secret']) ?></td>
                            <td><?= esc($code['montant']) ?></td>
                            <td><?= $code['est_valide'] ? 'Oui' : 'Non' ?></td>
                            <td>
                                <a href="/codes/edit/<?= $code['id'] ?>" class="btn btn-warning btn-sm me-1"><img src="<?= base_url('/assets/images/editer.png') ?>" alt="Modifier" width="20" height="20"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>