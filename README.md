# Extracción de Entidades

## Requisitos

### - El proyecto fue creado en Laravel 11, por lo que se necesita una versión de php >= 8.2 y nodeJS >= 18.
### - Para la conexión con la API de lenguaje natural de Google, se pueden utilizar las credenciales de prueba, sino puede colocar su propio archivo json dentro de la carpeta la carpeta scripts y actualizar el nombre del archivo dentro del script de Python GoogleEntities.py 
## Instrucciones
Abre la terminal, ubicate en el directorio raiz del proyecto y ejecuta los siguientes comandos:

```sh
composer install
```
```sh
php artisan migrate
```
```sh
npm install
```
```sh
pip install --upgrade google-cloud-language
```

## Correr ambiente local
```sh
php artisan serve
```
```sh
npm run dev
```
