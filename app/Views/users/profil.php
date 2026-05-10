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
                        <div class="card-title">👤 Informations personnelles</div>
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
                        <input type="submit" class="btn btn-primary btn-sm" value="💾 Update">
                    </form>
                </div>

                <div>
                    <div class="card section-gap">
                        <form action="/userDetails/update" method="post">
                            <div class="card-title">🏥 Informations de santé</div>
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
                                    <input type="number" name="poids_actuel" id="poids-input" value="<?= $profil['poids'] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Taille (cm)</label>
                                <input type="number" name="taille" id="taille-input" value="<?= $profil['taille'] ?>">
                            </div>
                            <input type="hidden" name="details_id" value="<?= $profil['details_id'] ?>">
                            <input type="hidden" name="id" value="<?= $profil['id'] ?>">
                            <input type="submit" class="btn btn-primary btn-sm" value="💾 Update">
                            <button type="button" id="imc-btn" class="btn btn-outline btn-sm" onclick="calculerIMC()" >🔄 Recalculer l'IMC</button>
                        </form>
                    </div>

                    <div class="imc-display">
                        <div class="imc-ring">
                            <svg id="imc-ring-svg" width="120" height="120">
                                <circle cx="60" cy="60" r="50" fill="none" stroke="#1f2b23" stroke-width="10"/>
                                <circle id="imc-ring-progress" cx="60" cy="60" r="50" fill="none" stroke="#4ade80" stroke-width="10"
                                stroke-dasharray="220 314" stroke-linecap="round"/>
                            </svg>
                            <div class="imc-value-wrap">
                                <div class="imc-number" id="imc-value">22.9</div>
                                <div class="imc-unit">IMC</div>
                            </div>
                        </div>
                        <div class="imc-info">
                            <h3 id="imc-category">Poids Normal</h3>
                            <div class="imc-status" id="imc-status">✓ IMC Sain</div>
                            <div id="imc-description" style="font-size:0.82rem;color:var(--text-muted);">IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-title">🔒 Sécurité</div>
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
                    <input type="submit" class="btn btn-outline btn-sm" value="🔑 Changer le mot de passe">
                </form>
            </div>
        </div>
    
    <?= view('footer') ?>
    
    <script>
        function navigate(page, el) {
            const pages = document.querySelectorAll('.page');
            pages.forEach(function(currentPage) {
                currentPage.classList.remove('active');
            });

            const targetPage = document.getElementById('pg-' + page);
            if (targetPage) {
                targetPage.classList.add('active');
            }

            document.querySelectorAll('.nav-item').forEach(function(item) {
                item.classList.remove('active');
            });

            if (el) {
                el.classList.add('active');
            }
        }

        function calculerIMC() {
            // Récupérer les valeurs des champs
            const poids = parseFloat(document.getElementById('poids-input').value);
            const taille = parseFloat(document.getElementById('taille-input').value);

            // Vérifier que les valeurs sont valides
            if (!poids || !taille || poids <= 0 || taille <= 0) {
                alert('Veuillez entrer des valeurs valides pour le poids et la taille');
                return;
            }

            // Calculer l'IMC
            const tailleEnMetres = taille / 100;
            const imc = poids / (tailleEnMetres * tailleEnMetres);

            // Déterminer la catégorie et les infos
            let category = '';
            let status = '';
            let description = '';
            let strokeColor = '#4ade80'; // Vert par défaut

            if (imc < 18.5) {
                category = 'Poids insuffisant';
                status = '⚠️ IMC Bas';
                description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est en dessous du poids normal.';
                strokeColor = '#3b82f6'; // Bleu
            } else if (imc >= 18.5 && imc < 25) {
                category = 'Poids Normal';
                status = '✓ IMC Sain';
                description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est dans la zone saine.';
                strokeColor = '#4ade80'; // Vert
            } else if (imc >= 25 && imc < 30) {
                category = 'Surpoids';
                status = '⚠️ IMC Élevé';
                description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est au-dessus du poids normal.';
                strokeColor = '#fbbf24'; // Orange
            } else {
                category = 'Obésité';
                status = '❌ IMC Critique';
                description = 'IMC idéal : 18.5 – 24.9<br>Votre IMC est au-dessus des normes saines.';
                strokeColor = '#ef4444'; // Rouge
            }

            // Mettre à jour l'affichage du nombre IMC
            document.getElementById('imc-value').textContent = imc.toFixed(1);

            // Mettre à jour la catégorie
            document.getElementById('imc-category').textContent = category;

            // Mettre à jour le statut
            document.getElementById('imc-status').textContent = status;

            // Mettre à jour la description
            document.getElementById('imc-description').innerHTML = description;

            // Mettre à jour la couleur de la bague (cercle de progression)
            const progressCircle = document.getElementById('imc-ring-progress');
            if (progressCircle) {
                progressCircle.setAttribute('stroke', strokeColor);
            }
        }

        // Initialiser l'IMC au chargement de la page avec les valeurs initiales
        window.addEventListener('DOMContentLoaded', function() {
            const appShell = document.getElementById('app-shell');
            if (appShell) {
                appShell.style.display = 'flex';
            }
            calculerIMC();
        });
    </script>
</body>
</html>