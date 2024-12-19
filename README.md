# Laravel Task Management App

Aplikacja zarządzania zadaniami stworzona w Laravel, która umożliwia tworzenie zadań oraz generowanie linków do zadań z tokenem dostępu. Aplikacja była tworzona z użyciem Dockera i Lavarel Sail.

## Spis treści

-   [Wymagania](#wymagania)
-   [Instalacja](#instalacja)
-   [Konfiguracja](#konfiguracja)
-   [Uruchamianie aplikacji](#uruchamianie-aplikacji)
-   [Docker i Sail](#docker-i-sail)

## Wymagania

-   PHP 8.1 lub nowszy
-   Composer
-   Docker (jeśli korzystasz z Laravel Sail)

## Instalacja

### 1. Sklonuj repozytorium:

git clone https://github.com/eXsik/todo-task.git
cd todo-task

### 2. Zainstaluj zależności:

Jeśli nie korzystasz z Docker (Sail), zainstaluj zależności lokalnie:

composer install

Jeśli korzystasz z Docker i Laravel Sail, przejdź do sekcji Docker i Sail poniżej.

### 3. Skonfiguruj plik .env:

Skopiuj plik .env.example do .env:
cp .env.example .env

Zaktualizuj plik .env w zależności od środowiska, w którym chcesz uruchomić aplikację. Upewnij się, że skonfigurowane są następujące dane:

-   DB_CONNECTION – połączenie z bazą danych

### 4. Uruchom migracje i seedy (jeśli są dostępne):

php artisan migrate --seed

### Laravel Sail

Jeśli używasz Laravel Sail, musisz mieć zainstalowany Docker na swoim komputerze.

-   Uruchomienie kontenerów:

W terminalu, w katalogu projektu, uruchom:

./vendor/bin/sail up

To uruchomi aplikację na Dockerze, w tym usługi takie jak MySQL, Redis, czy usługi kolejki.

-   Dostęp do aplikacji:

Aplikacja będzie dostępna pod adresem http://localhost, chyba że skonfigurowałeś inny port w pliku .env.

-   Wchodzenie do kontenera aplikacji:

Jeśli chcesz uruchomić dodatkowe komendy Artisan lub Composer, możesz wejść do kontenera aplikacji:

./vendor/bin/sail shell

Teraz jesteś w terminalu kontenera i możesz uruchamiać komendy, takie jak php artisan, composer install, itp.

### Uruchamianie aplikacji

Po zainstalowaniu zależności i skonfigurowaniu aplikacji, uruchom ją na swoim lokalnym serwerze.

-   Jeśli korzystasz z Laravel Sail, uruchom aplikację za pomocą poniższego polecenia:

./vendor/bin/sail up

-   Jeśli korzystasz z lokalnego serwera, uruchom aplikację za pomocą:

php artisan serve

Aplikacja powinna być dostępna pod adresem: http://localhost:8000.

## Dane do logowania

-   login: test@example.com
-   password: password

## Wysyłanie maili z przypomnieniem

Komenda: sail artisan tasks:send-expiration-soon-emails
