<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Project Setup

### clone the repository

```
git clone https://github.com/shuvomohajan/bi-directional-sync-zoho-Sheet.git

cd bi-directional-sync-zoho-Sheet

cp .env.example .env

php artisan key:generate

composer install

php artisan migrate --seed
```

### Start NGROK server

paste the `secure` url in the .env file

```
NGROK_URL=  //paste the ngrok secure url here
```

### Set up Google Sheet API

-   Go to [Google Cloud Console](https://console.cloud.google.com/)
-   Create a new project
-   Enable Google Sheets API
-   Create credentials

add redirect uri `http://localhost:8000/task-1/oauth-google-sheets/callback`

### Set up Zoho API

-   Go to [Zoho Developer Console](https://api-console.zoho.com/)

-   Create a new project

add redirect uri `http://localhost:8000/task-1/oauth-zoho-crm/callback`
