# Gestionnaire de Liens Raccourcis

## ⚒️ Installation et Configuration

1. **Installer les dépendances PHP et Node.js**
   ```sh
   composer install
   npm install
   ```

2. **Configurer l'environnement**
   ```sh
   cp .env.example .env
   ```

3. **Créer la base de données et effectuer la migration**
   ```sh
   php artisan migrate
   ```

4. **Remplir la base de données avec des données de test**
   ```sh
   php artisan db:seed
   ```

5. **Compiler les assets**
   ```sh
   npm run build
   ```

6. **Lancer le serveur**
   ```sh
   php artisan serve
   ```

L'application sera accessible à l'adresse suivante :  
📍 **http://127.0.0.1:8000**

---

Deux utilisateurs sont créés avec des liens déjà présents :
- **alexandre.lecam@example.com**
- **test@example.com**

🔑 Mot de passe pour les deux : **password**

---

## Organisation des Layouts

Étant donné le **délai de réalisation**, j’ai utilisé **Laravel Breeze** pour générer les vues liées à l'authentification.

💡 **Breeze intègre :**
- **TailwindCSS** pour le style
- **Alpine.js** pour les interactions

Ces vues sont utilisées pour **toutes les pages liées à l'authentification** (connexion, inscription, mot de passe oublié…).

Pour assurer une **cohérence avec MyAnaPro**, j’ai utilisé **Bootstrap** et **jQuery** pour le reste de l’application :
- **Bootstrap** pour le design et la mise en page
- **jQuery** pour la gestion des interactions (modales, AJAX…)

L’application repose donc sur plusieurs layouts :
- **`guest.blade.php`** : pour les pages publiques et l'authentification
- **`app.blade.php`** : utilisé pour l’authentification avec Laravel Breeze
- **`main.blade.php`** : utilisé pour le reste de l'application (Bootstrap & jQuery)
