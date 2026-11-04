# prueba · Guía para agentes de código

Respeta la estructura de carpetas, convenciones del stack y comandos de verificación propios de este repositorio.

<!-- CAUCE:PAUTAS:START -->
## Gobernanza corporativa de Cauce (bloque sincronizado)

> Sección mantenida por Cauce. Conserva intacto el resto de este archivo con las convenciones propias del repositorio.

### Jerarquía de precedencia y modo autónomo

1. **Ejecución autónoma en el Runner (`CAUCE_AGENT_ROLE`)**: cuando la variable de entorno `CAUCE_AGENT_ROLE` está definida (`constructor` o `auditor`), trabajas sin supervisión interactiva. Las instrucciones de este repositorio pensadas para chat en IDE (como detenerse a esperar aprobación humana de un plan o hacer `git push` manual) quedan sustituidas por la spec aprobada y por `.cauce/result.json` / `.cauce/audit.json`.
2. **Estándares corporativos de ingeniería, seguridad, pruebas y Definición de Hecho**: prevalecen las directivas de este bloque (y `.cauce/pautas-tecnicas.json` en tiempo de ejecución).
3. **Arquitectura local, stack, rutas, comandos y sistema de diseño**: prevalecen las convenciones propias de este repositorio descritas fuera de este bloque.

### Directivas transversales (aplican siempre)

- **Comprobaciones Automatizadas en Verde** *(obligatoria)*: La compilación TypeScript (typecheck), linter y el conjunto de tests automatizados deben pasar limpiamente antes de dar la tarea por concluida.
- **Ausencia de Secretos y Deuda Bloqueante** *(obligatoria)*: Verificar que ningún secreto, token ni credencial quede expuesto en el código y que no existan TODOs críticos sin asociar a un elemento de trabajo.
- **Validación Funcional Extremo a Extremo** *(obligatoria)*: Verificar que la funcionalidad cumple íntegramente los Criterios de Aceptación funcionales y técnicos especificados.
- **Clean Code y Principio KISS** *(obligatoria)*: Priorizar código legible, simple y mantenible sobre abstracciones prematuras. Evitar clases dios, dependencias circulares y duplicación de lógica.
- **Arquitectura Hexagonal y Separación de Capas** *(obligatoria)*: La lógica de dominio debe mantenerse como funciones puras y desacopladas de infraestructura (sin imports de ORMs ni frameworks web en el núcleo de dominio).
- **Idempotencia y Operaciones Atómicas** *(obligatoria)*: Toda mutación de estado relevante debe ser transaccional y diseñarse para soportar reintentos sin generar duplicidades ni inconsistencias.
- **Implementación de Tests Automáticos** *(obligatoria)*: Toda historia debe acompañarse de tests automáticos que cubran: (a) tests unitarios de la lógica de dominio nueva, (b) tests de integración del flujo principal y (c) al menos un test E2E del camino crítico.
- **Tests de Regresión para Bugs Resueltos** *(obligatoria)*: Cualquier corrección de error debe acompañarse de una prueba automatizada que reproduzca el fallo antes de dar por cerrada la solución.

### Directivas por capa tecnológica (aplican cuando se toca la capa)

- **Backend**: *Manejo Temporal en UTC y Fechas Relativas con Timezone* (Los registros y marcas temporales deben guardarse siempre en UTC en la base de datos. Los cálculos de fecha relativa del usuario deben usar su zona horaria explícita.) · *Sincronización Estricta de Contratos y Enums* (Los tipos, Enums y contratos entre frontend y backend deben validarse con esquemas tipados (ej. Zod) impidiendo valores no sincronizados.) · *Manejo Defensivo de Excepciones* (Capturar errores en las fronteras de los servicios y devolver respuestas estructuradas con códigos semánticos sin exponer trazas internas sensibles.)
- **Base de datos**: *Migraciones de Esquema Versionadas* (Todo cambio estructural en la base de datos debe disponer de su migración versionada y aplicada antes de desplegar o actualizar los modelos en código.) · *Integridad Referencial y Claves Foráneas* (Definir siempre relaciones y restricciones de clave foránea de forma explícita, con reglas de borrado o cascada coherentes con el negocio.) · *Indexación Estratégica* (Crear índices para campos consultados con frecuencia, claves foráneas, columnas de ordenación y filtros compuestos.) · *Prohibición de SQL Crudo sin Parametrizar* (Utilizar siempre el ORM o consultas con enlace parametrizado para evitar inyecciones SQL y garantizar tipado estricto.)
- **Documentación**: *Actualización de Documentación de Arquitectura y APIs* (Actualizar las especificaciones técnicas, esquemas de datos o documentación de variables de entorno ante cualquier cambio que los impacte.) · *Registro de Decisiones Arquitectónicas (ADR)* (Documentar formalmente cualquier decisión de diseño estructural, cambio de librería o compromiso técnico relevante.)
- **Frontend**: *Uso Exclusivo del Design System y Tokens* (Construir interfaces empleando los componentes y tokens oficiales (variables CSS de color, espaciado y tipografía), sin colores hex ni medidas arbitrarias.) · *Estados de Carga, Error y Datos Vacíos* (Toda interacción asíncrona debe reflejar visualmente el estado de carga (skeleton o spinner accesible), estado de error accionable y vista vacía (empty state).) · *Accesibilidad Web WCAG 2.1 AA* (Garantizar navegación por teclado, foco visible, etiquetas label asociadas a campos de formulario y atributos aria en controles interactivos.)
- **Observabilidad y Telemetría**: *Logging Estructurado con Contexto* (Emitir registros de log en formato JSON con identificadores de contexto (usuario, requestId, entidad) y niveles apropiados (info, warn, error).) · *Telemetría de Eventos Clave de Negocio* (Instrumentar la captura de eventos significativos del usuario para supervisar la salud del producto y la usabilidad de las funciones.)
- **Rendimiento y Escalabilidad**: *Prevención de Consultas N+1* (Cargar relaciones e información vinculada mediante joins o includes optimizados, evitando consultas iterativas en bucles.) · *Paginación Obligatoria en Listados* (Todas las consultas a tablas o listados que puedan crecer en el tiempo deben implementar paginación mediante cursores o límites estrictos.)
- **Control de calidad**: *Testing con Entornos Realistas* (Los tests de integración de servicios y lógica de negocio deben validar transacciones y restricciones reales sin abusar de mocks frágiles.) · *Matriz de Pruebas de Roles y Estados* (Los tests deben validar el comportamiento según los diferentes roles de usuario y las transiciones clave del ciclo de vida.)
- **Seguridad**: *Almacén Cifrado de Credenciales y Secretos* (Las credenciales de acceso a servicios externos deben almacenarse cifradas con algoritmos robustos (ej. AES-256-GCM) y nunca volcarse en logs.) · *Validación y Sanitización de Entradas* (Validar exhaustivamente el tipo, longitud y formato de todos los datos recibidos desde clientes antes de procesarlos en el backend.) · *Control de Acceso y Mínimo Privilegio* (Comprobar permisos de usuario en cada endpoint y servicio según la matriz de roles y el contexto del proyecto.)
- **UX/UI**: *Cobertura de Escenarios de Borde (0, 1, N)* (Toda funcionalidad que involucre colecciones o listas debe definir y verificar el comportamiento para 0 elementos (empty state), 1 elemento y N elementos con paginación/scroll.) · *Confirmación en Acciones Destructivas* (Cualquier acción de borrado, publicación o alteración irreversible debe requerir confirmación explícita mediante un modal accesible.) · *Jerarquía y Consistencia de Acciones* (Reservar el botón primario de acción para los objetivos principales (guardar, crear, aprobar), manteniendo las acciones auxiliares o de IA como secundarias.)

<!-- CAUCE:PAUTAS:END -->
