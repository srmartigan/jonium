# JONIUM

![JONIUM Logo](https://via.placeholder.com/728x90.png?text=JONIUM+Framework) <!-- Reemplaza con tu logo -->

[![Build Status](https://img.shields.io/travis/tu-usuario/jonium.svg)](https://travis-ci.org/tu-usuario/jonium)
[![Total Downloads](https://img.shields.io/packagist/dt/tu-usuario/jonium.svg)](https://packagist.org/packages/tu-usuario/jonium)
[![Latest Stable Version](https://img.shields.io/packagist/v/tu-usuario/jonium.svg)](https://packagist.org/packages/tu-usuario/jonium)
[![License](https://img.shields.io/packagist/l/tu-usuario/jonium.svg)](https://packagist.org/packages/tu-usuario/jonium)

## Descripción

**JONIUM** es un framework de desarrollo web básico diseñado para proporcionar una estructura sencilla y eficiente para construir aplicaciones web. Actualmente, JONIUM incluye funcionalidad de enrutamiento, controladores y vistas, permitiendo un desarrollo rápido y organizado.

## Características

- **Enrutamiento**: Gestión sencilla de rutas.
- **Controladores**: Controladores para organizar la lógica de la aplicación.
- **Vistas**: Motor de vistas para renderizar plantillas HTML.

## Instalación

Para empezar a usar JONIUM, sigue estos pasos:

1. Clona el repositorio:

    ```bash
    git clone https://github.com/srmartigan/jonium.git
    ```

2. Navega al directorio del proyecto:

    ```bash
    cd jonium
    ```

3. Instala las dependencias usando Composer:

    ```bash
    composer install
    ```

## Empezando

### Ejemplo de cómo crear una ruta, un controlador y una vista

#### 1. Crear una ruta

En el archivo `routes/web.php`, añade una nueva ruta:

```php
<?php

use App\Controllers\HomeController;

$router->get('/home', [HomeController::class, 'index']);
```

#### 2. Crear un controlador

Crea un nuevo controlador en `app/Controllers/HomeController.php`:

```php
<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        return view('home');  // Renderizar la vista 'home'
    }
}
```

#### 3. Crear una vista

Crea una nueva vista en `resources/views/home.blade.php`:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>JONIUM - Home</title>
</head>
<body>
    <h1>Bienvenido a JONIUM</h1>
    <p>Tu framework web básico.</p>
    <p style="color: blue;">Añade tus propios toques con estilos en azul!</p>
</body>
</html>
```

### Levantar el servidor de desarrollo

Para iniciar un servidor de desarrollo local, puedes usar el siguiente comando:

```bash
php -S localhost:8000 -t public
```

Ahora puedes abrir tu navegador y visitar `http://localhost:8000/home` para ver la vista en acción.

## Documentación

Para más información, por favor consulta la documentación completa [aquí](https://link-documentacion.com).

## Contribuir

Si deseas contribuir a JONIUM, por favor sigue [estas guías](https://link-contribuir.com).

## License

JONIUM está licenciado bajo la [MIT license](https://opensource.org/licenses/MIT).

---

_¡Gracias por usar JONIUM!_
