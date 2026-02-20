# PokeSmash! 🎮

Un proyecto web interactivo basado en el universo de Pokémon. PokeSmash! permite a los usuarios registrarse como entrenadores, elegir su Pokémon inicial y participar en una mecánica de captura interactiva directamente desde el navegador.

## 🚀 Características Principales

* **Sistema de Entrenadores:** Registro e inicio de sesión de usuarios seguro (encriptación de contraseñas nativa de PHP).
* **Selección de Inicial:** Al registrarse, el usuario puede elegir a su primer compañero (Bulbasaur, Charmander o Squirtle) el cual se vincula a su cuenta.
* **Mecánica de Captura Interactiva:** Un mini-juego integrado con JavaScript y animaciones CSS donde el usuario debe mantener presionado un objetivo para llenar una barra de progreso y capturar al Pokémon.
* **Arquitectura MVC:** Código organizado limpiamente en Modelos (Models), Vistas (Views) y Controladores (Controllers) para facilitar la escalabilidad.
* **Pokedex e Información:** Secciones dinámicas para consultar información dentro de la plataforma.

## 🛠️ Tecnologías Utilizadas

* **Backend:** PHP (Patrón MVC)
* **Base de Datos:** MySQL
* **Frontend:** HTML5, CSS3 (Animaciones personalizadas, Flexbox), JavaScript Vanilla (Manipulación del DOM, eventos táctiles y de ratón, `requestAnimationFrame`).
* **Entorno Local:** XAMPP
* **Capturas:**
<img width="804" height="467" alt="Captura de pantalla 2026-02-19 221740" src="https://github.com/user-attachments/assets/33f79e02-3d62-4fb0-9cd9-09e735c5a365" />
<img width="958" height="743" alt="Captura de pantalla 2026-02-19 221706" src="https://github.com/user-attachments/assets/ce7f0a6e-4838-4d1d-a951-10b685588a34" />
<img width="358" height="465" alt="Captura de pantalla 2025-12-04 092601" src="https://github.com/user-attachments/assets/70f81c8b-5247-4919-b69e-99e77901737e" />

## 📁 Estructura del Proyecto (MVC)

El proyecto sigue una estructura de directorios lógica para separar la lógica de negocio de la interfaz de usuario:

```text
/
├── app/
│   ├── config/       # Conexión a la base de datos (database.php)
│   ├── controllers/  # Controladores de la aplicación (MainController.php, CapturaController.php...)
│   ├── models/       # Consultas a la base de datos (Usuario.php...)
│   └── views/        # Archivos de interfaz (registro.php, inicio.php, captura_view.php...)
├── public/           # Archivos accesibles por el navegador
│   ├── css/          # Estilos de la aplicación
│   └── js/           # Lógica de frontend (captura.js, index.js...)
├── index.php         # Punto de entrada principal (Front Controller)
└── README.md
