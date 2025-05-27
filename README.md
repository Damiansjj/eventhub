# EventHub Platform

## Projectbeschrijving
EventHub is een evenementenplatform waar de focus ligt op het beheren van evenementen via een admin dashboard.

### Functionaliteiten

#### Bezoekers
- Evenementen bekijken
- Nieuws lezen
- FAQ raadplegen
- Contact opnemen
- Gebruikersprofielen bekijken

#### Geregistreerde Gebruikers
- Profiel beheren
  * Profielfoto uploaden
  * Persoonlijke informatie aanpassen
  * Account instellingen wijzigen


#### Administrators
- Dashboard
  * Statistieken overzicht (gebruikers, nieuws, evenementen)
  * Recente activiteiten bekijken
  * Ongelezen berichten teller
- Evenementenbeheer
  * Evenementen aanmaken/bewerken/verwijderen
  * Afbeeldingen uploaden
  * Publicatiestatus beheren
  * Deelnemers beheren
- Gebruikersbeheer
  * Gebruikers overzicht
  * Rollen toewijzen
  * Gebruikers admin geven en uitdoen
- Nieuwsbeheer
  * Nieuws artikelen schrijven
- Systeembeheer
  * FAQ beheren

## Technische Implementatie

### Admin Dashboard
- Dashboard route: `routes/web.php` (regels 13-24)
- Statistieken logica: `app/Http/Controllers/Admin/DashboardController.php` (regels 15-35)
- Dashboard view: `resources/views/admin/dashboard.blade.php`

### Evenementenbeheer
- Controller: `app/Http/Controllers/Admin/EventController.php` (regels 1-110)
- Views: 
  * Index: `resources/views/admin/events/index.blade.php`
  * Create: `resources/views/admin/events/create.blade.php`
  * Edit: `resources/views/admin/events/edit.blade.php`

### Authenticatie
- Middleware: `app/Http/Middleware/AdminMiddleware.php`
- Routes: `routes/web.php` (regels 49-55)

## Installatie

1. Clone project & installeer dependencies:
```bash
git clone [project-url]
cd eventhub
composer install
npm install
```

2. Setup configuratie:
```bash
cp .env.example .env
php artisan key:generate
```

3. Database setup:
```bash
php artisan migrate
```

## Screenshots
![Admin Dashboard](/docs/screenshots/admin-dashboard.png)
![Evenementen Overzicht](/docs/screenshots/events-index.png)
![Evenement Aanmaken](/docs/screenshots/event-create.png)

## Gebruikte Bronnen
- Laravel Documentatie
- Tailwind CSS Documentatie
- Laravel Daily Tutorials
- chatgpt

