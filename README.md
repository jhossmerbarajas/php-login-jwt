# Autenticación en PHP y JWT
<p>
	En este repositorio encontrarás un inicio de sesión usando Json Web Token (JWT). Además, Usaremos algunas nuevas caracteristicas
	del lenguaje como:
</p>
<ol>
	<li> Interfaces </li>
	<li> Trait </li>
</ol>
<p>
	También, se usa el patrón mvc.
</p>

## Clonar El repositorio

## Configuración
<p>
	Para usar este proyecto, debes configurar las credenciales de conexión a tu base de datos. Ese archivo lo encontrarás en la ruta:
</p>

```
config/config.php
```

<p>
	Notarás que hay otras configuraciones, como SECRET_JWT que será para key al momento de usar JWT.
</p>

## Libreria a utilizar

```
composer require firebase/php-jwt
```