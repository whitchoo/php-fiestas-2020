# Índice de Especificaciones Técnicas — Eventos Online (`prueba`)

Este directorio contiene las especificaciones técnicas extraídas mediante ingeniería inversa del código fuente real del repositorio `prueba` (**Eventos Online**).

## Mapa de Especificaciones y Cobertura de Requisitos

| Documento | Área / Dominio | Descripción | Requisitos Funcionales Cubiertos | Requisitos No Funcionales Cubiertos |
| :--- | :--- | :--- | :--- | :--- |
| [`00-arquitectura.md`](./00-arquitectura.md) | Arquitectura e Infraestructura | Stack tecnológico real (PHP + MySQL + HTML5 UP Phantom + Jitsi Meet API), estructura de ficheros, gestión de configuración y matriz de contraste frente a las 32 pautas técnicas corporativas de Cauce. | `RF-02`, `RF-11`, `RF-12` | `RNF-01`, `RNF-02`, `RNF-03`, `RNF-04`, `RNF-05`, `RNF-06`, `RNF-07`, `RNF-08` |
| [`01-datos.md`](./01-datos.md) | Modelo de Datos y Persistencia | Esquema de base de datos MySQL inferido del código (`eventos`), entidades en tránsito (Organizador, Acreditación/Kudos de Invitado), consultas SQL ejecutadas, riesgos de integridad e indexación recomendada. | `RF-03`, `RF-04`, `RF-08`, `RF-11` | `RNF-01`, `RNF-04`, `RNF-05`, `RNF-08` |
| [`02-acceso-y-sala-evento.md`](./02-acceso-y-sala-evento.md) | Acceso de Invitados y Sala de Videoconferencia | Flujo completo del invitado: ingreso de código en portada, validación de existencia y ventana de apertura de 30 minutos (`eventValidate.php`), antesala de identificación y *kudos* (`eventPreparation.php`) y sala Jitsi Meet (`fiestaPrincipal.php`). | `RF-01`, `RF-03`, `RF-04`, `RF-05`, `RF-06` | `RNF-02`, `RNF-03`, `RNF-04`, `RNF-06`, `RNF-07`, `RNF-08` |
| [`03-organizacion-y-administracion-eventos.md`](./03-organizacion-y-administracion-eventos.md) | Organización, Presupuestación y Administración de Eventos | Asistente en dos pasos para solicitud de nuevo evento (`eventNew.php` y `eventNew2.php`), cálculo de horas y tarifas, formulario de administración en portada (`index.php`), navegación (`menu.php`) y análisis de funcionalidades inconclusas. | `RF-01`, `RF-02`, `RF-07`, `RF-08`, `RF-09`, `RF-10`, `RF-12` | `RNF-02`, `RNF-05`, `RNF-06` |

## Referencias Cruzadas

- **Documento Maestro de Requisitos:** [`../docs/requirements.md`](../docs/requirements.md)
- **Paquete Estructurado de Requisitos (Cauce):** `../.cauce/requisitos-package.json`
