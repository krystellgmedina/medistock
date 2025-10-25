# MediStock Manager - Sistema de Gestión de Medicamentos

## Descripción General 📋
Sistema completo para gestionar inventario de medicamentos desarrollado con tecnologías modernas y robustas.

### Tecnologías Utilizadas
- **Backend:** CodeIgniter 4
- **Frontend:** HTML5, Bootstrap 5 y jQuery
- **Base de Datos:** PostgreSQL

## Guía de Instalación Paso a Paso 🚀

### 1. Preparación del Entorno
- Asegúrate de tener instalado PHP 7.4 o superior
- PostgreSQL debe estar instalado y funcionando
- Composer debe estar instalado en tu sistema

### 2. Instalación del Backend
1. Abre una terminal y ejecuta:
   ```bash
   cd c:\Users\cabra\Downloads\KRYSTELMEDICINA
   composer create-project codeigniter4/appstarter backend
   ```

### 3. Configuración de la Base de Datos
1. Conéctate a PostgreSQL
2. Ejecuta el script ubicado en:
   ```
   PostgreBD/create_medicamento.sql
   ```
   > Nota: Asegúrate que la extensión pgcrypto esté habilitada para gen_random_uuid()

### 4. Configuración de CodeIgniter
1. Copia el archivo `.env.example` a `.env`
2. Configura la conexión a la base de datos:
   ```env
   database.default.hostname = localhost
   database.default.database = tu_base_de_datos
   database.default.username = tu_usuario
   database.default.password = tu_contraseña
   database.default.DBDriver = Postgre
   ```

### 5. Configuración de Rutas
En el archivo `app/Config/Routes.php` agrega:
```php
$routes->get('inventario', 'Inventario::index');
$routes->get('inventario/list', 'Inventario::list');
$routes->post('inventario/create', 'Inventario::create');
$routes->post('inventario/update/(:segment)', 'Inventario::update/$1');
$routes->post('inventario/delete/(:segment)', 'Inventario::delete/$1');
```

### 6. Iniciar el Sistema
1. Desde la terminal, navega hasta la carpeta del proyecto:
   ```bash
   cd backend
   php spark serve
   ```
2. Abre tu navegador en: `http://localhost:8080/inventario`






## Despliegue en GitHub y Railway 🚀

### 1. Preparación para GitHub
1. Crear nuevo repositorio en GitHub:
   ```bash
   git init
   git add .
   git commit -m "Primer commit"
   git branch -M main
   git remote add origin https://github.com/tu-usuario/medistock.git
   git push -u origin main
   ```

### 2. Configuración en Railway
1. Visitar [Railway.app](https://railway.app) y crear una cuenta
2. Conectar con GitHub y seleccionar el repositorio
3. Configurar variables de entorno:
   ```env
   CI_ENVIRONMENT = production
   database.default.hostname = ${{ RAILWAY_POSTGRESQL_HOST }}
   database.default.database = ${{ RAILWAY_POSTGRESQL_DATABASE }}
   database.default.username = ${{ RAILWAY_POSTGRESQL_USERNAME }}
   database.default.password = ${{ RAILWAY_POSTGRESQL_PASSWORD }}
   database.default.DBDriver = Postgre
   ```

### 3. Archivos Necesarios para Railway
Crear archivo `Procfile` en la raíz:
```
web: php spark serve --port $PORT --host 0.0.0.0
```

Actualizar `composer.json`:
```json
{
  "require": {
    "php": "^7.4|^8.0",
    "codeigniter4/framework": "^4.0"
  },
  "scripts": {
    "post-install-cmd": [
      "php spark migrate"
    ]
  }
}
```

### 4. Pasos de Despliegue
1. Railway detectará automáticamente el proyecto PHP
2. Configurará PostgreSQL automáticamente
3. Desplegará la aplicación y proporcionará una URL

### 5. Verificación del Despliegue
1. Revisar logs en Railway Dashboard
2. Verificar la migración de la base de datos
3. Probar la aplicación en la URL proporcionada

## Estructura del Proyecto 📁
```
KRYSTELMEDICINA/
├── backend/               # Archivos de CodeIgniter
│   └── app/
│       ├── Controllers/   # Controladores
│       ├── Models/       # Modelos
│       └── Views/        # Vistas
├── PostgreBD/            # Scripts de base de datos
└── assets/              # Archivos frontend
    └── js/
```

## Funcionalidades Principales ✨
- Gestión completa de medicamentos (CRUD)
- Búsqueda y filtrado por categoría
- Control de fechas de expiración
- Interfaz responsiva

## Recomendaciones para Producción 🛠️
1. Implementar autenticación de usuarios
2. Activar protección CSRF
3. Agregar validaciones adicionales
4. Configurar logs del sistema
5. Realizar pruebas exhaustivas

## Soporte Técnico 💡
Para reportar problemas o solicitar ayuda:
- Crear un issue en el repositorio
- Documentar detalladamente el problema
- Incluir capturas de pantalla si es necesario
