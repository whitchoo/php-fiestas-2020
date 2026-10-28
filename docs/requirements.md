# Documento Maestro de Requisitos — Eventos Online (`prueba`)

## 1. Introducción y Propósito del Producto

**Eventos Online** (también referenciado en la configuración de base de datos como *Fiestas Online*) es una aplicación web monolítica desarrollada en PHP y MySQL cuyo propósito es facilitar la celebración y gestión de eventos sociales o fiestas privadas en línea mediante salas de videoconferencia integradas con **Jitsi Meet**.

El producto cubre dos grandes recorridos funcionales:
1. **Recorrido del Invitado (Asistente):** Permite a los invitados acceder a un evento privado introduciendo un código de invitación único (`idEvento`), valida que el evento exista, esté habilitado y se encuentre dentro de la ventana temporal permitida (desde 30 minutos antes del inicio hasta la hora de finalización), recoge el nombre visible del participante junto con una palabra descriptiva y una dedicatoria (*kudos*) para el homenajeado/organizador, e inicia la sala de videollamada embebida.
2. **Recorrido del Organizador:** Permite a un organizador solicitar la creación de un nuevo evento registrando sus datos de contacto y credenciales, seleccionando la fecha y las horas de inicio y fin, y calculando automáticamente la duración y el presupuesto del evento en función de una tarifa fija por hora. Asimismo, contempla un punto de entrada en la portada para la administración de eventos creados.

---

## 2. Usuarios, Actores y Roles del Sistema

El sistema no implementa un control de sesiones persistentes (`$_SESSION` o tokens JWT), sino que distingue los actores según el flujo de navegación y la validación por formulario en cada pantalla:

| Rol / Actor | Descripción | Permisos y Capacidades en el Código Actual | Evidencia |
| :--- | :--- | :--- | :--- |
| **Invitado (Asistente)** | Persona que recibe un código de evento (`idEvento`) para asistir a una celebración online. | - Introducir el código de invitación (9 caracteres alfanuméricos).<br>- Validar el acceso dentro del horario permitido (desde 30 min antes del inicio hasta el fin).<br>- Indicar su nombre de pantalla, una palabra descriptiva del agasajado y un mensaje opcional (*kudos*).<br>- Participar en la sala de videoconferencia Jitsi Meet asociada al evento. | `index.php`, `eventValidate.php`, `eventPreparation.php`, `fiestaPrincipal.php` |
| **Organizador de Evento** | Persona que contrata/solicita la creación de un evento online y dispone de una contraseña asociada a su evento. | - Rellenar sus datos identificativos (nombre completo, correo electrónico y contraseña).<br>- Planificar la fecha, hora de inicio y hora de fin del evento y consultar el importe calculado (10 unidades monetarias/hora).<br>- *(En construcción)* Acceder al panel de administración con código de evento y contraseña. | `index.php`, `eventNew.php`, `eventNew2.php` |
| **Administrador de Base de Datos / Operador** | Rol técnico implícito que gestiona directamente la tabla `eventos` en MySQL. | - Dar de alta registros en la tabla `eventos` y activar/desactivar eventos mediante el flag `enabled = 1` (dado que el formulario web de alta aún no persiste en base de datos). | `db.php`, `eventValidate.php`, `EJEMPLOS.txt` |

---

## 3. Entidades del Dominio y Reglas de Negocio

### 3.1. Entidades del Dominio

1. **Evento (`eventos` / `Eventos`):**
   - Entidad principal persistida en la base de datos MySQL.
   - Atributos evidenciados en código (`eventValidate.php` y `EJEMPLOS.txt`):
     - `idEvento`: Identificador o código único de invitación al evento (cadena alfanumérica; validada en portada con longitud de 9 caracteres para invitados).
     - `fechaHoraInicio`: Fecha y hora de comienzo del evento (`DATETIME` / `TIMESTAMP`).
     - `fechaHoraFin`: Fecha y hora de finalización del evento (`DATETIME` / `TIMESTAMP`).
     - `password`: Contraseña del organizador asociada al evento.
     - `enabled`: Indicador booleano/entero (`1` = habilitado) que determina si el evento está activo y accesible.

2. **Solicitud de Organizador (en tránsito entre `eventNew.php` y `eventNew2.php`):**
   - Datos capturados durante el asistente de creación de nuevo evento y transmitidos vía `POST`:
     - `nombre`: Nombre y apellidos del organizador.
     - `email`: Correo electrónico del organizador.
     - `password`: Contraseña elegida para administrar el evento.
     - `fecha`, `HoraInicio`, `HoraFin`: Programación temporal solicitada.
     - `pCantHoras`: Duración calculada en horas enteras.
     - `pPrecio`: Importe económico calculado (`10` × `pCantHoras`).

3. **Acreditación y Dedicatoria de Invitado (en tránsito entre `eventPreparation.php` y `fiestaPrincipal.php`):**
   - Datos recogidos en la antesala del evento antes de entrar a la videollamada:
     - `idEvento`: Código del evento al que accede.
     - `nombre`: Nombre o alias con el que se identifica al participante dentro de Jitsi Meet (`displayName`).
     - `palabra`: Una única palabra (mínimo 3 letras) que describe al homenajeado/agasajado.
     - `kudos`: Mensaje libre opcional de felicitación o dedicatoria para el organizador.

### 3.2. Reglas de Negocio (`RN`)

- **RN-01 — Formato del código de invitación:** En el acceso de invitados (`index.php`), el código `idEvento` debe estar compuesto exactamente por 9 caracteres alfanuméricos sin espacios (`pattern="[a-zA-Z0-9]{9}"`).
- **RN-02 — Condiciones de validez de un evento:** Un evento solo es accesible si existe en la tabla `eventos`, tiene el indicador `enabled = 1` y su fecha/hora de finalización no ha expirado (`fechaHoraFin >= NOW()`). Evidencia: `eventValidate.php`.
- **RN-03 — Apertura de puertas (ventana de acceso anticipado):** Los invitados pueden acceder a la sala desde **30 minutos antes** de `fechaHoraInicio` (`DATE_ADD(fechaHoraInicio, INTERVAL -30 MINUTE)`). Si intentan acceder antes de ese umbral, el sistema rechaza la entrada informando de que ha llegado temprano. Evidencia: `eventValidate.php`.
- **RN-04 — Identificación y dedicatoria del invitado:** En la antesala (`eventPreparation.php`), el nombre del invitado debe tener al menos 3 caracteres alfanuméricos o espacios (`[a-zA-Z0-9 ]{3,}`), la palabra descriptiva debe ser una sola palabra de al menos 3 letras (`[a-zA-Z]{3,}`) y el campo `kudos` es opcional.
- **RN-05 — Obligatoriedad y coincidencia de credenciales del organizador:** Para solicitar un evento (`eventNew.php`), el organizador debe informar obligatoriamente nombre completo, email, contraseña y confirmación de contraseña, debiendo coincidir ambos campos de contraseña.
- **RN-06 — Coherencia horaria del evento:** En la planificación del evento (`eventNew2.php`), la hora de finalización (`HoraFin`) debe ser posterior a la hora de inicio (`HoraInicio`). Si la diferencia es negativa, se alerta al usuario y se reinician las horas y el precio a `0`.
- **RN-07 — No retroactividad del evento:** La fecha y hora de inicio seleccionadas para un nuevo evento no pueden ser anteriores a la fecha y hora actuales (`eventNew2.php`).
- **RN-08 — Tarificación por hora:** El coste del evento se calcula multiplicando el número entero de horas de duración (`parseInt(cantidadHoras)`) por una tarifa fija de **10 unidades monetarias por hora** (`$preciohora = 10`). Evidencia: `eventNew2.php`.

---

## 4. Requisitos Funcionales (`RF`)

### Módulo 1: Portal Principal y Navegación

- **RF-01 — Página de aterrizaje con triple punto de entrada (`index.php`):**
  - **Descripción:** El sistema debe mostrar una página principal con tres bloques de acción diferenciados: (1) formulario de acceso para invitados mediante código de evento, (2) botón de acceso al asistente de creación de nuevo evento y (3) formulario de acceso de administración para organizadores con código y contraseña.
  - **Evidencia:** `index.php` (líneas 58-105).

- **RF-02 — Menú de navegación lateral y pie de página común (`menu.php`, `footer.php`):**
  - **Descripción:** Todas las pantallas de la aplicación deben incluir una cabecera con acceso a un menú lateral desplegable (`#menu`) con enlaces a las secciones del sitio (`Inicio`, `Entrar a un evento`, `Administrar mi evento`, `Crea un nuevo evento`, `Ayuda!`, `¿Quienes somos?`) y un pie de página común con información de copyright.
  - **Evidencia:** `menu.php` (líneas 1-19), `footer.php` (líneas 1-43), `generic.php`.
  - **Nota de implementación real:** En `menu.php`, los enlaces a `Entrar a un evento`, `Administrar mi evento`, `Ayuda!` y `¿Quienes somos?` apuntan a `index.html` (archivo inexistente en la raíz), mientras que `Inicio` apunta a `index.php` y `Crea un nuevo evento` a `eventNew.php`.

### Módulo 2: Acceso y Validación de Invitados

- **RF-03 — Validación de código de invitación y vigencia del evento (`eventValidate.php`):**
  - **Descripción:** Al recibir por `POST` el código `idEvento`, el sistema debe consultar en la tabla `eventos` si existe un registro con dicho `idEvento`, con estado `enabled = 1` y con `fechaHoraFin >= NOW()`. Si no existe ningún registro que cumpla los criterios, debe mostrar el mensaje *"Código incorrecto! El código que has ingresado no es válido."* junto con un botón para regresar a `index.php`.
  - **Evidencia:** `eventValidate.php` (líneas 15-106).

- **RF-04 — Control de ventana horaria de apertura de puertas (`eventValidate.php`):**
  - **Descripción:** Si el evento es válido y vigente, el sistema debe calcular el instante de apertura permitida restando 30 minutos a `fechaHoraInicio`. Si la hora actual del servidor (`time()`) es anterior a dicho instante, debe impedir el acceso y mostrar el mensaje *"Has llegado temprano! Las puertas del evento se abren 30 minutos antes del comienzo..."*. Si la hora actual es igual o posterior al instante permitido, debe redirigir al usuario a `eventPreparation.php?idEvento=<idEvento>`.
  - **Evidencia:** `eventValidate.php` (líneas 58-80).

- **RF-05 — Formulario de antesala y recogida de datos del invitado (`eventPreparation.php`):**
  - **Descripción:** Una vez superada la validación horaria, el sistema debe presentar al invitado una pantalla de bienvenida con un formulario que conserva el `idEvento` y solicita: su nombre visible para el evento (`nombre`), una palabra descriptiva del homenajeado (`palabra`) y un mensaje opcional de felicitación o dedicatoria (`kudos`), enviando los datos por `POST` a `fiestaPrincipal.php`.
  - **Evidencia:** `eventPreparation.php` (líneas 50-83).

### Módulo 3: Sala de Evento y Videoconferencia

- **RF-06 — Sala de videoconferencia embebida con Jitsi Meet (`fiestaPrincipal.php`):**
  - **Descripción:** Al ingresar desde la antesala, el sistema debe cargar la librería externa `https://meet.jit.si/external_api.js` e instanciar automáticamente una sala de videollamada `JitsiMeetExternalAPI` en el contenedor `#jitsi-meet-conf-container` utilizando `idEvento` como nombre de sala (`roomName`) y `APP_NAME`, y configurando el `displayName` del participante con el `nombre` introducido en el paso previo. La sala oculta el botón de lobby, deshabilita la página de bienvenida y desactiva las funciones de invitación directa de Jitsi.
  - **Evidencia:** `fiestaPrincipal.php` (líneas 13-118).
  - **Nota de implementación real:** Los campos `palabra` y `kudos` enviados desde `eventPreparation.php` no se persisten en base de datos ni se visualizan en `fiestaPrincipal.php` (`$kudos` se asigna a una variable local sin uso posterior y `palabra` no se lee).

### Módulo 4: Solicitud y Presupuestación de Nuevo Evento (Organizador)

- **RF-07 — Registro de datos del organizador — Paso 1 (`eventNew.php`):**
  - **Descripción:** El sistema debe proporcionar un formulario para que el futuro organizador introduzca su nombre y apellidos (`nombre`), correo electrónico (`email`), contraseña (`password`) y repetición de contraseña (`reptpassword`). Antes de enviar el formulario a `eventNew2.php`, debe validar en cliente que todos los campos estén informados y que ambas contraseñas coincidan.
  - **Evidencia:** `eventNew.php` (líneas 17-59, 103-135).

- **RF-08 — Planificación horaria y cálculo automático de presupuesto — Paso 2 (`eventNew2.php`):**
  - **Descripción:** El sistema debe recibir los datos del organizador (`nombre`, `email`, `password`) desde el Paso 1, mantenerlos en campos ocultos y presentar un formulario con fecha del evento (`fecha`), hora de inicio (`HoraInicio`) y hora de fin (`HoraFin`). Al modificar las horas, debe calcular automáticamente la duración en horas (`pCantHoras`) y el importe total (`pPrecio`) a razón de 10 unidades monetarias por hora (`$preciohora = 10`), alertando si la hora de fin es anterior a la de inicio.
  - **Evidencia:** `eventNew2.php` (líneas 18-125, 161-210).

- **RF-09 — Envío de solicitud de nuevo evento (`eventNew2.php`):**
  - **Descripción:** Al enviar el formulario del Paso 2, el sistema pretende validar que la fecha y hora de inicio no sean anteriores al momento actual y procesar la solicitud del evento.
  - **Evidencia:** `eventNew2.php` (líneas 34-44, 166).
  - **Nota de implementación real (Funcionalidad incompleta / Con defectos):** En el código actual, `validarFormulario` contiene dos errores en JavaScript (`.Value` con mayúscula e invocación a `Today.diff(...)` inexistente en `Date` nativo) que impiden el envío del formulario, y el atributo `action="#"` no cuenta con lógica PHP en servidor para insertar el nuevo evento en la tabla `eventos`.

### Módulo 5: Administración de Eventos

- **RF-10 — Acceso de administración para el organizador (`index.php`):**
  - **Descripción:** La página principal presenta una sección para que el organizador de un evento introduzca el código de su evento y su contraseña con el fin de administrarlo.
  - **Evidencia:** `index.php` (líneas 84-105).
  - **Nota de implementación real (Funcionalidad no implementada):** El formulario apunta a `action="#"`, ambos campos (`text` y `password`) comparten `name="demo-name"` e `id="demo-name"`, el patrón `[a-z0-9]{11}` difiere del patrón de 9 caracteres del código de invitado, y no existe pantalla ni controlador PHP de administración en el repositorio.

### Módulo 6: Infraestructura y Conexión a Datos

- **RF-11 — Conexión adaptable a base de datos según entorno (`db.php`):**
  - **Descripción:** El sistema debe establecer conexión con MySQL mediante `mysqli_connect` seleccionando automáticamente las credenciales locales (`localhost`, usuario `root`, base de datos `eventosonline`) cuando `$_SERVER['HTTP_HOST'] == 'localhost'`, o las credenciales del servidor de producción en caso contrario, e incluir dicha conexión de forma transversal a través de `menu.php`.
  - **Evidencia:** `db.php` (líneas 6-15), `menu.php` (línea 2).

- **RF-12 — Página de contenido genérico (`generic.php`):**
  - **Descripción:** El sistema incluye una plantilla de página estática (`generic.php`) con la estructura visual común (cabecera, menú lateral y pie de página) para páginas informativas secundarias.
  - **Evidencia:** `generic.php` (líneas 1-75).

---

## 5. Requisitos No Funcionales (`RNF`)

- **RNF-01 — Arquitectura y Stack Tecnológico:** Aplicación web monolítica multipágina (MPA) renderizada en servidor con PHP procedural (sin framework ni gestor de dependencias `composer.json`) y extensión `mysqli` para acceso a base de datos relacional MySQL/MariaDB.
- **RNF-02 — Interfaz de Usuario y Diseño Responsivo:** El frontend se basa en la plantilla **Phantom de HTML5 UP** (`CSSPhantom/`), utilizando hojas de estilo CSS3/Sass adaptativas (`main.css`, `noscript.css`), FontAwesome para iconografía y jQuery 3.5.1 (cargado tanto desde CDN `code.jquery.com` como localmente desde `CSSPhantom/assets/js/jquery.min.js`).
- **RNF-03 — Integración de Videoconferencia WebRTC Externa:** Las sesiones de vídeo en tiempo real se delegan en la infraestructura pública de Jitsi Meet (`meet.jit.si`) a través de su `JitsiMeetExternalAPI` en cliente, ajustando el ancho del iframe al 80 % de la pantalla del dispositivo (`screen.width - (screen.width / 5)`) y una altura fija de `400px`.
- **RNF-04 — Seguridad en Consultas a Base de Datos (Riesgo Crítico Detectado):** Actualmente las consultas SQL se construyen mediante concatenación directa de variables `$_POST` (`$idEvento` en `eventValidate.php`), sin sentencias preparadas (`mysqli_prepare`), lo que expone la aplicación a inyección SQL.
- **RNF-05 — Gestión de Credenciales y Secretos (Riesgo Crítico Detectado):** Las credenciales de base de datos del entorno de producción se encuentran codificadas directamente en texto plano dentro de `db.php`, y las contraseñas de eventos (`password`) se almacenan y transmiten en texto plano (incluso en campos `<input type="hidden">` en `eventNew2.php`).
- **RNF-06 — Sanitización de Salidas HTML / Prevención de XSS (Riesgo Detectado):** Los parámetros recibidos por `GET` y `POST` (`idEvento`, `nombre`, `email`, `password`) se interpolan directamente en el HTML y en bloques JavaScript (`eventPreparation.php`, `eventNew2.php`, `fiestaPrincipal.php`) sin escapar mediante `htmlspecialchars()`.
- **RNF-07 — Codificación de Caracteres:** Mientras que la mayoría de los archivos emplean UTF-8, `fiestaPrincipal.php` está guardado con codificación ISO-8859-1/Windows-1252 pese a declarar `<meta charset="utf-8" />`, utilizando entidades HTML (`&aacute;`, `&oacute;`) en el cuerpo.
- **RNF-08 — Manejo Temporal:** La validación de vigencia y apertura de puertas combina funciones de fecha de MySQL (`NOW()`, `DATE_ADD`) con funciones de tiempo de PHP (`strtotime()`, `time()`), asumiendo implícitamente que el servidor PHP y el servidor MySQL comparten la misma zona horaria local sin normalización explícita a UTC.

---

## 6. Discrepancias y Hallazgos del Análisis de Código Real

Siguiendo la regla de oro de ingeniería inversa (*el código manda*), se dejan constancia explícita de las siguientes discrepancias entre la intención funcional reflejada en la interfaz/archivos de apoyo y el comportamiento real del código en producción:

1. **Creación de eventos inconclusa (`eventNew2.php`):** Aunque existe un flujo en dos pasos (`eventNew.php` -> `eventNew2.php`) para solicitar un nuevo evento, el segundo paso no guarda nada en la base de datos (`action="#"` sin bloque `INSERT` en PHP) y además su validación JavaScript aborta con un `TypeError` porque invoca `.Value` (con `V` mayúscula) y un método inexistente `Today.diff(selected, 'hours')`.
2. **Pérdida de datos de antesala (`palabra` y `kudos`):** En `eventPreparation.php` se pide al invitado una palabra descriptiva del homenajeado (`palabra`) y un mensaje de felicitación (`kudos`) con el texto *"para preparar una sorpresa"*. Sin embargo, en `fiestaPrincipal.php` el campo `palabra` ni siquiera se lee de `$_POST`, y `$kudos` se asigna a una variable que nunca se guarda en base de datos ni se muestra en la interfaz.
3. **Administración de eventos no implementada (`index.php`):** El bloque *"Eres el organizador de un evento, entra aqui para administrar"* en `index.php` apunta a `action="#"`, tiene atributos `name="demo-name"` e `id="demo-name"` duplicados en los dos campos y exige un patrón `[a-z0-9]{11}` incompatible con el formato de 9 caracteres usado en el acceso de invitados (`[a-zA-Z0-9]{9}`).
4. **Enlaces rotos en el menú principal (`menu.php`):** Cuatro de las seis opciones del menú lateral (`Entrar a un evento`, `Administrar mi evento`, `Ayuda!`, `¿Quienes somos?`) enlazan a `index.html`, archivo que no existe en el directorio raíz del proyecto.
5. **Conexión a base de datos innecesaria en páginas sin consultas (`menu.php`):** Como `menu.php` ejecuta `include 'db.php';` al inicio, todas las páginas del sitio abren una conexión a MySQL al renderizar el menú, pero solo `eventValidate.php` la utiliza y la cierra (`mysqli_close($link)`). Si la base de datos no está disponible, ninguna página del sitio (ni siquiera la portada estática `index.php`) puede cargarse debido al `die(...)` en `db.php`.
6. **Archivo `EJEMPLOS.txt` vs implementación real de Jitsi:** `EJEMPLOS.txt` contiene un volcado completo de configuración de un servidor Jitsi de EducaMadrid (`jitsi04.educa.madrid.org`) y una consulta a la tabla `Eventos` (con `E` mayúscula), mientras que la aplicación real en `fiestaPrincipal.php` consume el servicio público `meet.jit.si` mediante `external_api.js` y `eventValidate.php` consulta la tabla `eventos` (en minúscula).

---

## 7. Historial de Cambios

| Fecha | Versión | Autor / Proceso | Descripción |
| :--- | :--- | :--- | :--- |
| 2026-10-28 | 1.0.0 | Agente de Cauce (Ingeniería Inversa) | Generación inicial del documento maestro de requisitos a partir del análisis exhaustivo del código fuente del repositorio `prueba`. |
