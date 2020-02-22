# Identity Provider

Odpowiada za zarządzanie tożsamościami użytkowników i
ich poświadczeniami. Łączy się z bazą danych użytkowników. Udostępnia funkcjonalności związane z rejestrowaniem nowych użytkowników, ich uwierzytelnianiem autoryzacją w
systemie. Zajmuję się tworzeniem, odświeżaniem, walidacją, unieważnianiem tokenów dostępu i odświeżania.

### Instalacja na środowisku deweloperskim

Instalacja zależności comoposer:

```
composer install
```

Konfiguracja pliku .env
```
 cp .env.example .env
```

**_W pliku .env należy ustawić odpowiednie dane dostępu do bazy danych itp._**

Uruchomienie kontenerów docker'owych
```
docker-compose up -d
```

Wygenerowanie unikalnego klucza aplikacji
```
docker container exec idp-php-fpm php artisan key:generate
```

Uruchomienie migracji bazodanowych
```
docker container exec idp-php-fpm php artisan migrate
```

Wygenerowanie klientów OAuth
```
docker container exec idp-php-fpm php artisan passport:install
```

**_Należy skopiować wygenerowany secret klienta Password Grant do wpisu OAUTH_CLIENT_SECRET w pliku konfiguracyjnym .env_**

### Po skonfigurowaniu aplikacja powinna być dostępna na:

```
localhost:20001
```
