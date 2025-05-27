# EventHub

Een modern evenementenbeheerplatform gebouwd met Laravel, waar gebruikers evenementen kunnen bekijken en beheren.

## 🌟 Functionaliteiten

### Voor Bezoekers
- Bekijk gepubliceerde evenementen
- Bekijk nieuwsartikelen
- Bekijk FAQ
- Contactformulier
- Registreren/Inloggen

### Voor Gebruikers
- Persoonlijk profiel beheren
- Evenementen bekijken
- Nieuwsartikelen lezen en commentaar geven
- Contact opnemen via contactformulier

### Voor Administrators
- Volledig evenementenbeheer (CRUD)
  - Evenementen aanmaken, bewerken, verwijderen
  - Publicatiestatus beheren
- Nieuwsbeheer
  - Artikelen schrijven en beheren
  - Commentaren modereren
- FAQ-beheer
  - Categorieën en vragen beheren
- Gebruikersbeheer
  - Gebruikersrollen toewijzen
  - Gebruikers beheren

## 🔧 Technische Implementatie

### Authenticatie & Autorisatie
- Laravel Breeze authenticatie systeem
  - Locatie: `app/Http/Controllers/Auth/`
  - Middleware: `app/Http/Middleware/AdminMiddleware.php`

### Database & Models
- Eloquent ORM met relaties
  - Models: `app/Models/`
  - Migraties: `database/migrations/`
  - Seeders: `database/seeders/`

### Controllers
- Resource Controllers voor CRUD operaties
  - Admin Controllers: `app/Http/Controllers/Admin/`
  - Public Controllers: `app/Http/Controllers/`

### Views
- Blade Templates met Tailwind CSS
  - Layouts: `resources/views/layouts/`
  - Components: `resources/views/components/`
  - Admin Views: `resources/views/admin/`

### Routes
- Georganiseerde route groepen
  - Web Routes: `routes/web.php`
  - Auth Routes: `routes/auth.php`

## 📥 Installatie

1. Clone de repository
```bash
git clone https://github.com/jouw-username/eventhub.git
cd eventhub
```

2. Installeer dependencies
```bash
composer install
npm install
```

3. Configureer omgeving
```bash
cp .env.example .env
php artisan key:generate
```

4. Configureer database in .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventhub
DB_USERNAME=root
DB_PASSWORD=
```

5. Migreer database en voeg seeddata toe
```bash
php artisan migrate --seed
```

6. Start de ontwikkelserver
```bash
php artisan serve
npm run dev
```

7. Standaard admin account
```
Email: admin@ehb.be
Wachtwoord: Password!321
```

## 📸 Screenshots

[Hier komen je screenshots van de applicatie]

## 🔗 Gebruikte Bronnen

### Frameworks & Libraries
- [Laravel](https://laravel.com/) - PHP Framework
- [Tailwind CSS](https://tailwindcss.com/) - CSS Framework
- [Alpine.js](https://alpinejs.dev/) - JavaScript Framework

### Packages
- Laravel Breeze - Authenticatie
- Intervention Image - Afbeeldingverwerking

### AI Assistentie
- Deze applicatie is ontwikkeld met hulp van AI (Claude) voor code-review, debugging en optimalisatie
- De volledige AI chatlog is beschikbaar in: `docs/ai-chat-log.md`

## 👥 Auteur

[Jouw Naam]
- GitHub: [@jouw-username](https://github.com/jouw-username)
- Student aan: Erasmushogeschool Brussel
- Academiejaar: 2023-2024
