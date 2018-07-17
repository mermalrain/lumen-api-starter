# Lumen 5.6. API Starter with Paseto [![Build Status](https://travis-ci.org/mstaack/lumen-api-starter.svg?branch=master)](https://travis-ci.org/mstaack/lumen-api-starter)

# Notes
- Comes with make & route command for all your needs ;)
- Uses better jwt token alternative with paseto. Read [Paseto](https://github.com/paragonie/paseto)

# Included Packages
- [Clockwork](https://underground.works/clockwork/) Easier debugging with APIs
- [PHPUnit Pretty Result Printer](https://github.com/mikeerickson/phpunit-pretty-result-printer) Nice phpunit results
- [Collision](https://github.com/nunomaduro/collision) Better Console Error Handling
- [Lumen Form Requests](https://github.com/pearlkrishn/lumen-request-validate) Abstract Validation & Authorization into classes
- [laravel Dump Server](https://github.com/beyondcode/laravel-dump-server) Dump data to the artisan server

# Installation
- run `git clone git@github.com:mstaack/lumen-api-starter.git`
- run `composer install` to install dependencies
- copy `env.example` to `.env`
- Setup your application & auth keys with `composer keys` & check `.env`file (automatically done via composer hook)
- add sqlite database with `touch database/database.sqlite` (You probably dont want to run sqlite in production)
- run migrations & seeders with `artisan migrate --seed`
- A default user is created during seeding: `demo@demo.com` / `password`
- To quickly start a dev server run `./artisan serve`
- Also consider running `composer meta` when adding models for better autocompletion (automatically done via composer hook)

# Routes
```
➜  lumen-api-starter git:(master) ✗ ./artisan route:list
+--------+----------------+-----------------+-----------------------------------------+----------+------------+
| Verb   | Path           | NamedRoute      | Controller                              | Action   | Middleware |
+--------+----------------+-----------------+-----------------------------------------+----------+------------+
| GET    | /              |                 | None                                    | Closure  |            |
| POST   | /auth/register | auth.register   | App\Http\Controllers\AuthController     | register |            |
| POST   | /auth/login    | auth.login      | App\Http\Controllers\AuthController     | login    |            |
| GET    | /auth/user     | auth.user       | App\Http\Controllers\AuthController     | getUser  | auth       |
| GET    | /articles      | articles.index  | App\Http\Controllers\ArticlesController | index    | auth       |
| GET    | /articles/{id} | articles.find   | App\Http\Controllers\ArticlesController | find     | auth       |
| POST   | /articles      | articles.create | App\Http\Controllers\ArticlesController | create   | auth       |
| PUT    | /articles/{id} | articles.update | App\Http\Controllers\ArticlesController | update   | auth       |
| DELETE | /articles/{id} | articles.delete | App\Http\Controllers\ArticlesController | delete   | auth       |
+--------+----------------+-----------------+-----------------------------------------+----------+------------+
```

# Artisan Commands
```
➜  lumen-api-starter git:(form-reqs) ./artisan 
Laravel Framework Lumen (5.6.4) (Laravel Components 5.6.*)

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  clear-compiled            Remove the compiled class file
  help                      Displays help for a command
  list                      Lists commands
  migrate                   Run the database migrations
  optimize                  Optimize the framework for better performance
  serve                     Serve the application on the PHP development server
  tinker                    Interact with your application
 auth
  auth:clear-resets         Flush expired password reset tokens
  auth:generate-paseto-key  Creates a new authentication key for paseto
 cache
  cache:clear               Flush the application cache
  cache:forget              Remove an item from the cache
  cache:table               Create a migration for the cache database table
 clockwork
  clockwork:clean           Cleans Clockwork request metadata
 db
  db:seed                   Seed the database with records
 ide-helper
  ide-helper:eloquent       Add \Eloquent helper to \Eloquent\Model
  ide-helper:generate       Generate a new IDE Helper file.
  ide-helper:meta           Generate metadata for PhpStorm
  ide-helper:models         Generate autocompletion for models
 key
  key:generate              Set the application key
 make
  make:command              Create a new Artisan command
  make:controller           Create a new controller class
  make:event                Create a new event class
  make:job                  Create a new job class
  make:listener             Create a new event listener class
  make:mail                 Create a new email class
  make:middleware           Create a new middleware class
  make:migration            Create a new migration file
  make:model                Create a new Eloquent model class
  make:policy               Create a new policy class
  make:provider             Create a new service provider class
  make:request              Create a new form request class
  make:resource             Create a new resource
  make:seeder               Create a new seeder class
  make:test                 Create a new test class
 migrate
  migrate:fresh             Drop all tables and re-run all migrations
  migrate:install           Create the migration repository
  migrate:refresh           Reset and re-run all migrations
  migrate:reset             Rollback all database migrations
  migrate:rollback          Rollback the last database migration
  migrate:status            Show the status of each migration
 queue
  queue:failed              List all of the failed queue jobs
  queue:failed-table        Create a migration for the failed queue jobs database table
  queue:flush               Flush all of the failed queue jobs
  queue:forget              Delete a failed queue job
  queue:listen              Listen to a given queue
  queue:restart             Restart queue worker daemons after their current job
  queue:retry               Retry a failed queue job
  queue:table               Create a migration for the queue jobs database table
  queue:work                Start processing jobs on the queue as a daemon
 route
  route:list                Display all registered routes.
 schedule
  schedule:run              Run the scheduled commands
```
