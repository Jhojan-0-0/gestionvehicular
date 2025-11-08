create database laboratorio;

use laboratorio;


-- Crear la tabla 'personal'
CREATE TABLE personal (
    idpersonal INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellidos VARCHAR(100),
    dni INT,
    sexo VARCHAR(15),
    email VARCHAR(100),
    foto VARCHAR(200),
    feCreate DATE DEFAULT CURRENT_TIMESTAMP,
    feUpdate DATE
);

-- Crear la tabla 'usuario'
CREATE TABLE usuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    idpersonal INT,
    nombre VARCHAR(50),
    contraceña VARCHAR(100),
    FOREIGN KEY (idpersonal) REFERENCES personal(idpersonal)
);

-- Crear la tabla 'regQuimicos'
CREATE TABLE regQuimicos (
    idquimicos INT AUTO_INCREMENT PRIMARY KEY,
    nombreEspañol VARCHAR(100),
    nombreIngles VARCHAR(100),
    concentracion VARCHAR(50),
    tipoEnvace VARCHAR(20),
    tamaño VARCHAR(20),
    marca VARCHAR(70),
    peso DECIMAL(10, 2),
    cantidad INT,
    feFabricacion DATE,
    feVencimiento DATE,
    codProducto VARCHAR(50),
    advertencia TEXT,
    foto VARCHAR(250),
    tipo VARCHAR(20),
    precio DECIMAL(10, 2),
    clasificacion VARCHAR(50)
);

-- Crear la tabla 'entregaquimico'
CREATE TABLE entregaquimico (
    identrega INT AUTO_INCREMENT PRIMARY KEY,
    feEntrega VARCHAR(50),
    codSalida INT,
    idquimico INT,
    cantidad INT,
    descripcion TEXT,
    marca VARCHAR(100),
    facultad VARCHAR(200),
    docente VARCHAR(100),
    FOREIGN KEY (idquimico) REFERENCES regQuimicos(idquimicos)
);

-- Crear la tabla 'gastoQuimicos'
CREATE TABLE gastoQuimicos (
    idgasto INT AUTO_INCREMENT PRIMARY KEY,
    ientrega INT,
    idquimico INT,
    fecha DATE,
    cantidad INT,
    descripcion VARCHAR(200),
    FOREIGN KEY (ientrega) REFERENCES entregaquimico(identrega),
    FOREIGN KEY (idquimico) REFERENCES regQuimicos(idquimicos)
);
