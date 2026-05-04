
# Trendos task
## Requirements

- docker & docker-compose

## Setup

1. **Build and start the application:**

```bash  
docker-compose up --build -d
```  

2. **Install dependencies via composer:**

```bash  
docker-compose exec php composer install
```  

3. **Check if the application is running:**

```bash  
curl http://127.0.0.1:8080/notifications?user_id=2
```  

Response for `user_id=2`:

```json  
[{  
 "title": "Configurar dispositivo Android", 
 "description": "Phasellus rhoncus ante dolor, at semper metus aliquam quis. Praesent finibus pharetra libero, ut feugiat mauris dapibus blandit. Donec sit.", 
 "cta": "https://trendos.com/"
}]  
```  

`[]` is returned when the user doesn't match the notification criteria.

## API

### `GET /notifications?user_id={id}`

Returns an array of notifications the given user is eligible for.

**Response format:**

| Field         | Type   | Description                  |  
|---------------|--------|------------------------------|  
| `title`       | string | Notification title           |  
| `description` | string | Notification body text       |  
| `cta`         | string | CTA URL                      |

**Rules:**

A user is eligible for the Android device setup notification when all of the following are true:
- User does't have android device attached;
- User hasn't got premium;
- User country - `ES`;
- User hasn't been active during the last week.

## Running tests

```bash  
docker compose exec php php bin/phpunit 
```  

## Technical decisions

- **Single-action controller** — Invokable single action controller for single responsibility;
- **Service separation** — All calculations, logical tasks are separated in service. This also makes unit testing possible;
- **Unit & integration test** — Service is tested using data/class mocks. Controller is tested using real database data with fixtures that were provided for this task;
- **SQL fixtures over Doctrine migrations** — Database schema was provided as an SQL dump, so no reinventions of schema with migrations and seeders.
