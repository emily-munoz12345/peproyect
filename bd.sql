CREATE DATABASE IF NOT EXISTS Nacional_Tapizados;
USE Nacional_Tapizados;

-- Tabla de roles de usuario (nueva)
CREATE TABLE Roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL,
    descripcion TEXT
);

-- Tabla de usuarios (reemplaza Administrador)
CREATE TABLE Usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_rol INT NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nombre_completo VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol)
);

-- Tabla Clientes (mejorada)
CREATE TABLE Clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo VARCHAR(100) UNIQUE,
    direccion TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notas TEXT
);

-- Tabla Vehículos (nueva, importante para el negocio)
CREATE TABLE Vehiculos (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    año INT,
    color VARCHAR(30),
    placa VARCHAR(20) UNIQUE,
    vin VARCHAR(50) UNIQUE,
    notas TEXT
);

-- Relación Cliente-Vehículo (nueva)
CREATE TABLE Cliente_Vehiculo (
    id_cliente INT,
    id_vehiculo INT,
    PRIMARY KEY (id_cliente, id_vehiculo),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_vehiculo) REFERENCES Vehiculos(id_vehiculo) ON DELETE CASCADE
);

-- Tabla Materiales (mejorada)
CREATE TABLE Materiales (
    id_material INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    categoria VARCHAR(50),
    proveedor VARCHAR(100),
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla Servicios (mejorada)
CREATE TABLE Servicios (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    tiempo_estimado VARCHAR(50),
    categoria VARCHAR(50),
    activo BOOLEAN DEFAULT TRUE
);

-- Tabla Cotizaciones (mejorada)
CREATE TABLE Cotizaciones (
    id_cotizacion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_cliente INT,
    id_vehiculo INT,
    fecha_cotizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    subtotal DECIMAL(10, 2) NOT NULL,
    descuento DECIMAL(10, 2) DEFAULT 0,
    iva DECIMAL(10, 2) DEFAULT 0,
    total DECIMAL(10, 2) NOT NULL,
    estado ENUM('Pendiente', 'Aprobada', 'Rechazada', 'Completada') DEFAULT 'Pendiente',
    notas TEXT,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente),
    FOREIGN KEY (id_vehiculo) REFERENCES Vehiculos(id_vehiculo)
);

-- Tabla detalle_cotizacion (mejorada)
CREATE TABLE detalle_cotizacion (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT,
    id_servicio INT,
    id_material INT,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    total DECIMAL(10, 2) NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_cotizacion) REFERENCES Cotizaciones(id_cotizacion) ON DELETE CASCADE,
    FOREIGN KEY (id_servicio) REFERENCES Servicios(id_servicio),
    FOREIGN KEY (id_material) REFERENCES Materiales(id_material)
);

-- Tabla Trabajos (nueva, para seguimiento)
CREATE TABLE Trabajos (
    id_trabajo INT AUTO_INCREMENT PRIMARY KEY,
    id_cotizacion INT,
    fecha_inicio DATE,
    fecha_fin DATE,
    estado ENUM('Pendiente', 'En progreso', 'Completado', 'Entregado') DEFAULT 'Pendiente',
    responsable INT,
    notas TEXT,
    fotos TEXT, -- Puede ser JSON o texto con URLs separadas por comas
    FOREIGN KEY (id_cotizacion) REFERENCES Cotizaciones(id_cotizacion),
    FOREIGN KEY (responsable) REFERENCES Usuarios(id_usuario)
);

-- Datos iniciales
INSERT INTO Roles (nombre_rol, descripcion) VALUES 
('Administrador', 'Acceso completo al sistema'),
('Técnico', 'Personal encargado de realizar los trabajos'),
('Vendedor', 'Personal encargado de ventas y cotizaciones');

INSERT INTO Usuarios (id_rol, username, password, nombre_completo, correo) VALUES 
(1, 'esm', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador Principal', 'admin@nacionaltapizados.com');

INSERT INTO Materiales (nombre, descripcion, precio, categoria) VALUES
('Cuero sintético negro', 'Material de alta calidad resistente al desgaste', 150.00, 'Tapicería'),
('Cuero genuino italiano', 'Cuero natural de alta calidad importado', 300.00, 'Tapicería'),
('Tela premium antimanchas', 'Tela resistente y cómoda con tratamiento', 120.00, 'Tapicería'),
('Hilo nylon reforzado', 'Hilo resistente para costura de tapicería', 5.00, 'Insumos');

INSERT INTO Servicios (nombre, descripcion, precio, tiempo_estimado) VALUES
('Tapizado completo', 'Tapizado de todos los asientos del vehículo', 2000.00, '3-5 días'),
('Cambio de tapicería', 'Reemplazo completo de la tapicería', 2500.00, '4-6 días'),
('Reparación de asientos', 'Reparación de daños en asientos', 800.00, '1-2 días'),
('Limpieza profunda', 'Limpieza y tratamiento de tapicería', 500.00, '1 día');