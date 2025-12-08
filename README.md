# Simple CRUD on FlightPHP (SQLite)
Goal: minimal project with a model, SQL migration, REST API and a plain HTML page (no CSS).
## Run (Docker Compose)
1. Install Docker Desktop: https://www.docker.com/products/docker-desktop
2. Start Docker Desktop
3. Double-click `start.bat` (Windows) or run:
```
docker compose up -d
```
Migrations run automatically. Browser opens at http://localhost:8000/items

To stop:

docker compose down
```
or double-click `stop.bat` (Windows)

URLs:
- API: http://localhost:8000/entities
- UI:  http://localhost:8000/items
```
- Docker:
```
docker compose exec CRUD-Aplicacja-app  php tools/smoke.php http://localhost:8080
```
The script performs list → create → detail → update → delete → detail(404) and prints OK/FAIL. In Part B it includes sku and price.
Run without Docker (needs PHP):
```
php -S localhost:8000 -t public
php vendor/bin/runway db:migrate
```
## Database
- SQLite file: `app/database.sqlite`
- Migrations: `migrations/001_create_items.sql`
- Table: `items (id, name, quantity, note, created_at, updated_at)`
# REST API
- GET /entities — list (200)
- GET /entities/{id} — detail (200, 404)
- POST /entities — create (201, 400)
- PUT /entities/{id} — update (200, 400, 404)
- DELETE /entities/{id} — delete (204, 404)
Validation:
- name: required, length ≤ 100
- quantity: number ≥ 0
- note: length ≤ 1000
Errors: returns JSON with `errors` or `error` and proper code (400/404).