# Sistema de Gestión de Actas

Sistema profesional para la gestión de actas de reuniones, desarrollado con Laravel 12, Vue 3 e Inertia.js.

## Arquitectura

El sistema sigue principios SOLID, arquitectura limpia y buenas prácticas empresariales.

### Estructura del Proyecto

- **Backend**: Laravel 12 con servicios desacoplados
- **Frontend**: Vue 3 + Inertia.js + TailwindCSS
- **Base de Datos**: MySQL (configurado para SQLite en desarrollo)

### Directorios Principales

```
app/
├── Models/          # Modelos Eloquent
├── Services/        # Lógica de negocio
├── Http/
│   ├── Controllers/ # Controladores REST
│   ├── Requests/    # Validaciones
│   └── Middleware/  # Middlewares personalizados
├── Policies/        # Autorización
└── Jobs/           # Trabajos en cola

resources/js/Pages/  # Componentes Vue
database/
├── migrations/      # Migraciones de BD
└── seeders/        # Datos iniciales
```

## Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <repo-url>
   cd generador-actas-reuniones
   ```

2. **Instalar dependencias PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias JavaScript**
   ```bash
   npm install
   ```

4. **Configurar entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar base de datos**
   - Editar `.env` con credenciales MySQL
   - O usar SQLite para desarrollo

6. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Construir assets**
   ```bash
   npm run build
   ```

8. **Iniciar servidor**
   ```bash
   php artisan serve
   ```

## Configuración

### Variables de Entorno (.env)

```env
APP_NAME="Sistema de Actas"
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=actas_db
DB_USERNAME=user
DB_PASSWORD=password

QUEUE_CONNECTION=database
```

### Autenticación

- Login por número de cédula
- Middleware de autenticación en rutas protegidas
- Políticas para control de acceso

### Colas y Jobs

- Configurado para trabajos en cola
- Jobs preparados para notificaciones futuras

### Programador (Scheduler)

```bash
# En crontab
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Uso

### Crear Acta

1. Acceder a `/actas/create`
2. Llenar formulario con datos requeridos
3. Guardar y compartir enlace

### Compartir Acta

- Generar enlace único con token seguro
- Participantes se registran con cédula
- Pueden editar descripción y compromisos (una vez por participante)

### Generar PDF

- PDF profesional con diseño limpio
- Página 1: Información general y asistentes
- Página 2: Descripción y compromisos (opcional)

## API Endpoints

### Actas
- `GET /actas` - Listado paginado
- `POST /actas` - Crear acta
- `GET /actas/{id}` - Ver detalle
- `PUT /actas/{id}` - Actualizar
- `DELETE /actas/{id}` - Eliminar
- `POST /actas/{id}/share` - Compartir
- `GET /actas/{id}/download-pdf` - Descargar PDF

### Asistentes (Público)
- `GET /actas/shared/{token}` - Registro de asistente
- `POST /actas/shared/{token}` - Guardar asistente
- `GET /actas/shared/{token}/show` - Ver acta compartida
- `POST /actas/shared/{token}/update` - Editar campos compartidos

## Base de Datos

### Tablas Principales

- `users` - Usuarios del sistema
- `actas` - Actas de reuniones
- `attendees` - Asistentes registrados
- `secretariats` - Secretarías parametrizadas
- `comunas` - Comunas
- `corregimientos` - Corregimientos
- `cargos` - Cargos
- `estados_actas` - Estados de actas
- `acta_edit_logs` - Auditoría de ediciones

### Relaciones

- User hasMany Actas
- Acta belongsTo User
- Acta hasMany Attendees
- Attendee belongsTo Acta
- Attendee belongsTo User (opcional)

## Seguridad

- Validaciones con Form Requests
- Políticas de autorización
- Tokens seguros para compartir
- Auditoría de cambios
- Soft Deletes donde aplica

## Escalabilidad

- Servicios desacoplados para lógica compleja
- Repositorios preparados
- Jobs para procesos asíncronos
- Índices en BD optimizados
- Eager loading para evitar N+1

## Despliegue

### Producción

1. Configurar servidor web (Nginx/Apache)
2. Configurar base de datos MySQL
3. Ejecutar migraciones
4. Configurar colas: `php artisan queue:work`
5. Configurar scheduler en crontab
6. Construir assets: `npm run build`

### Recomendaciones

- Usar Redis para sesiones y caché en producción
- Configurar SSL
- Monitoreo de logs
- Backups automáticos de BD
- Rate limiting en APIs públicas

## Desarrollo

### Comandos Útiles

```bash
# Limpiar caché
php artisan optimize:clear

# Ejecutar tests
php artisan test

# Formatear código
./vendor/bin/pint

# Generar documentación (futuro)
php artisan scribe:generate
```

### Convenciones

- PSR-12 para PHP
- ESLint para JavaScript
- Commits en inglés
- Nombres descriptivos en español para UI

## Contribución

1. Fork el proyecto
2. Crear rama feature
3. Commit cambios
4. Push y crear PR

## Licencia

Este proyecto está bajo licencia MIT.