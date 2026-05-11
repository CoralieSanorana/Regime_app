    <?php $page = 'Mon Profil'; ?>
    <?= view('header', ['activeMenu' => 'profil']) ?>

        <!-- ──────────── PAGE: PROFIL ──────────── -->
        <div class="page active" id="pg-profil">
            <div class="page-header">
                <h1>Mon Profil</h1>
                <p>Gérez vos informations personnelles et de santé</p>
            </div>

            <div class="grid-2 section-gap">
                <div class="card">
                    <form action="/user/update" method="post">
                        <div class="card-title"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#person') ?>"></use></svg> Informations personnelles</div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" name="prenom" value="<?= $profil['prenom'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nom" value="<?= $profil['nom'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date de naissance</label>
                            <input type="date" name="date_naissance" value="<?= $profil['date_naissance'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= $profil['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Adresse</label>
                            <input type="text" name="adresse" value="<?= $profil['adresse'] ?>">
                        </div>
                        <input type="hidden" name="id" value="<?= $profil['id'] ?>">
                        <input type="submit" class="btn btn-primary btn-sm" value="Update">
                    </form>
                </div>

                <div>
                    <div class="card section-gap">
                        <form action="/userDetails/update" method="post">
                            <div class="card-title"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#heart-pulse') ?>"></use></svg> Informations de santé</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Genre</label>
                                    <select name="genre" id="genre-select">
                                        <option value="M" <?= $profil['genre'] === 'M' ? 'selected' : '' ?>>Homme</option>
                                        <option value="F" <?= $profil['genre'] === 'F' ? 'selected' : '' ?>>Femme</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Poids actuel (kg)</label>
                                    <input type="number" name="poids_actuel" id="poids-input" value="<?= $profil['poids'] ?>" step="any">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Taille (cm)</label>
                                <input type="number" name="taille" id="taille-input" value="<?= $profil['taille'] ?>" step="any">
                            </div>
                            <input type="hidden" name="details_id" value="<?= $profil['details_id'] ?>">
                            <input type="hidden" name="id" value="<?= $profil['id'] ?>">
                            <input type="submit" class="btn btn-primary btn-sm" value="Update">
                        </form>
                    </div>

                    <div class="imc-display" style="background: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem;">
                        <div style="display: grid; grid-template-columns: auto 1fr; gap: 2rem; align-items: center;">
                            <!-- Cercle IMC -->
                            <div style="position: relative; width: 140px; height: 140px; flex-shrink: 0;">
                                <svg id="imc-ring-svg" width="140" height="140" viewBox="0 0 140 140" style="filter: drop-shadow(0 0 15px rgba(74, 222, 128, 0.3)); position: absolute; top: 0; left: 0;">
                                    <circle cx="70" cy="70" r="60" fill="none" stroke="#1f2b23" stroke-width="12"/>
                                    <circle id="imc-ring-progress" cx="70" cy="70" r="60" fill="none" stroke="#4ade80" stroke-width="12"
                                    stroke-dasharray="260 376.99" stroke-linecap="round" stroke-dashoffset="0"/>
                                </svg>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                    <div class="imc-number" id="imc-value" style="font-size: 2.5rem; font-weight: 700; line-height: 1; color: #4ade80;">22.9</div>
                                    <div class="imc-unit" style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px;">IMC</div>
                                </div>
                            </div>
                            
                            <!-- Infos IMC -->
                            <div class="imc-info">
                                <h3 id="imc-category" style="margin: 0 0 8px 0; font-size: 1.2rem; color: white;">Poids Normal</h3>
                                <div class="imc-status" id="imc-status" style="font-size: 0.92rem; margin-bottom: 8px; color: #4ade80;"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#check2-circle') ?>"></use></svg> IMC Sain</div>
                                <div id="imc-description" style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-title"><svg class="bi" aria-hidden="true"><use href="<?= base_url('assets/icones/bootstrap-icons.svg#shield-lock') ?>"></use></svg> Sécurité</div>
                <form action="/user/update/pwd" method="post">
                    <div class="form-row">
                        <div class="form-group password-field">
                            <label>Mot de passe actuel</label>
                            <input type="password" name="old_password" unavailable value="<?= $profil['mot_de_passe'] ?>" placeholder="••••••••">
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </div>
                        <div class="form-group password-field">
                            <label>Nouveau mot de passe</label>
                            <input type="password" name="new_password" placeholder="••••••••">
                            <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" aria-label="Afficher le mot de passe">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $profil['id'] ?>">
                    <input type="submit" class="btn btn-outline btn-sm" value="Changer le mot de passe">
                </form>
            </div>
        </div>
    
    <?= view('footer') ?>
    
    <script src="<?= base_url('assets/js/profil.js') ?>"></script>
</body>
</html>