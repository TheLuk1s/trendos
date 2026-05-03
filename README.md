# Project X
## Commands
* docker-compose up -d [Build/Run application]
* docker compose exec -it php bash [Access bash]
    * php bin/phpunit [Run tests]

## Remarks (What could be improved)
- Poor test handling (should be normal test DB setup (sqlite or sth) with entity factories)
- Standard migrations and symfony fixtures (not sql import)
- Setters, but don't know further logic, so for this task only getters
- Better request validation, with use of symfony validator (lack of knowledge, need to research real life examples)
- Exception handling with structured responses, not symfony built-in (too much data, loss of structure)
- Handle eligibility rules as classes (if needs scalability could use "specification pattern")
