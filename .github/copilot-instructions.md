# MicroMLM Ultra - AI Coding Agent Instructions

## Project Overview
This is a Laravel 12 application using **Livewire 3** and **Laravel Volt** for interactive frontend components. The project is structured as a modern Laravel application with Breeze authentication, TailwindCSS 4, and Vite for asset bundling.

## Architecture & Key Patterns

### Livewire Volt Components
- **Primary Pattern**: Single-file components (SFCs) combining PHP logic and Blade templates
- **Location**: `resources/views/livewire/pages/` and `resources/views/livewire/`
- **Example**: [resources/views/livewire/pages/auth/login.blade.php](resources/views/livewire/pages/auth/login.blade.php) shows the pattern:
  ```php
  <?php
  use App\Livewire\Forms\LoginForm;
  use Livewire\Volt\Component;
  
  new #[Layout('layouts.guest')] class extends Component {
      public LoginForm $form;
      public function login(): void { /* ... */ }
  }; ?>
  <div><!-- Blade template here --></div>
  ```
- **Mounted Directories**: Volt automatically mounts `resources/views/livewire/` and `resources/views/pages/` (see [app/Providers/VoltServiceProvider.php](app/Providers/VoltServiceProvider.php))

### Form Objects Pattern
- **Location**: `app/Livewire/Forms/`
- Forms extend `Livewire\Form` with `#[Validate]` attributes for validation rules
- Example: [app/Livewire/Forms/LoginForm.php](app/Livewire/Forms/LoginForm.php) demonstrates property validation and rate limiting

### Component Organization
- **Class-based Livewire**: `app/Livewire/Actions/` and `app/Livewire/Forms/`
- **Volt SFCs**: `resources/views/livewire/pages/` (page components) and `resources/views/livewire/` (reusable components)
- **Layouts**: `resources/views/layouts/` - `app.blade.php` (authenticated), `guest.blade.php` (unauthenticated)

## Development Workflows

### Setup (First Time)
```bash
composer run setup
```
This runs: `composer install` → copies `.env.example` → generates app key → runs migrations → `npm install` → `npm run build`

### Development Server (Recommended)
```bash
composer run dev
```
Runs 3 concurrent processes: Laravel server (port 8000), queue worker, and Vite dev server with hot reload

### Individual Commands
- **Server**: `php artisan serve` (port 8000)
- **Queue Worker**: `php artisan queue:listen --tries=1`
- **Vite Dev**: `npm run dev`
- **Build Assets**: `npm run build`

### Testing
```bash
composer run test
```
Clears config cache and runs PHPUnit/Pest tests

## Database & Queue Configuration
- **Default DB**: MySQL (`micromlm_ultra` database)
- **Queue Driver**: Database-backed (`QUEUE_CONNECTION=database`)
- **Session Storage**: Database sessions
- **Cache**: Database cache store
- All require running migrations: `php artisan migrate`

## Frontend Stack
- **CSS Framework**: TailwindCSS 4 with Vite plugin (`@tailwindcss/vite`)
- **JavaScript**: Modern ES modules via Vite
- **Asset Compilation**: [vite.config.js](vite.config.js) configured with Laravel plugin and TailwindCSS
- **Watch Exclusions**: Ignores `storage/framework/views/**` to prevent recompile loops

## Project-Specific Conventions

### When Creating Volt Components:
1. Place page-level components in `resources/views/livewire/pages/` 
2. Use `#[Layout('layouts.app')]` or `#[Layout('layouts.guest')]` attribute
3. Extract form logic into separate Form classes in `app/Livewire/Forms/`
4. Use `navigate: true` in redirects for SPA-like navigation

### When Creating Class-based Livewire:
1. Place actions in `app/Livewire/Actions/`
2. Place forms in `app/Livewire/Forms/`
3. Render method should return views from `resources/views/livewire/`

### Code Style
- Use Laravel Pint for formatting: `vendor/bin/pint`
- Follow PSR-12 standards (enforced by Pint)

## Important Notes
- **No traditional routes for authenticated pages**: Volt SFCs in `resources/views/livewire/pages/` are auto-routed
- **Livewire 3 features**: Wire:navigate, reactive forms, and SPA mode are available
- **TailwindCSS 4**: Uses new Vite plugin, not PostCSS configuration
- **Queue Workers Required**: Database queue jobs won't process without `queue:listen` or `queue:work`
