-- Crear base de datos
CREATE DATABASE casita;
USE casita;

-- Tabla de Usuarios
CREATE TABLE Usuarios (
    IdUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100),
    Usuario VARCHAR(50) UNIQUE NOT NULL,
    Contrasena VARCHAR(255) NOT NULL,
    Rol VARCHAR(50) DEFAULT 'usuario',
    IsAdmin BIT DEFAULT 0 -- 1 = admin, 0 = no admin
);

-- Tabla de Clientes
CREATE TABLE Clientes (
    IdCliente INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100),
    Telefono VARCHAR(20),
    Email VARCHAR(100),
    Direccion TEXT
);

-- Tabla de Proveedores
CREATE TABLE Proveedores (
    IdProveedor INT AUTO_INCREMENT PRIMARY KEY,
    NombreProveedor VARCHAR(100) NOT NULL,
    Telefono VARCHAR(20),
    Email VARCHAR(100),
    Direccion TEXT
);

-- Tabla de Productos
CREATE TABLE Productos (
    IdProducto INT AUTO_INCREMENT PRIMARY KEY,
    NombreProducto VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    PrecioCompra DECIMAL(10, 2) NOT NULL,
    PrecioVenta DECIMAL(10, 2) NOT NULL,
    Stock INT DEFAULT 0,
    IdProveedor INT,
    FOREIGN KEY (IdProveedor) REFERENCES Proveedores(IdProveedor)
        ON UPDATE CASCADE ON DELETE SET NULL
);

-- Tabla de Compras
CREATE TABLE Compras (
    IdCompra INT AUTO_INCREMENT PRIMARY KEY,
    IdProducto INT NOT NULL,
    IdProveedor INT NOT NULL,
    Cantidad INT NOT NULL,
    PrecioTotal DECIMAL(10, 2) NOT NULL,
    FechaCompra DATE NOT NULL,
    FOREIGN KEY (IdProducto) REFERENCES Productos(IdProducto),
    FOREIGN KEY (IdProveedor) REFERENCES Proveedores(IdProveedor)
);

-- Tabla de Ventas
CREATE TABLE Ventas (
    IdVenta INT AUTO_INCREMENT PRIMARY KEY,
    IdProducto INT NOT NULL,
    IdCliente INT NOT NULL,
    Cantidad INT NOT NULL,
    PrecioTotal DECIMAL(10, 2) NOT NULL,
    FechaVenta DATE NOT NULL,
    IdUsuario INT,
    FOREIGN KEY (IdProducto) REFERENCES Productos(IdProducto),
    FOREIGN KEY (IdCliente) REFERENCES Clientes(IdCliente),
    FOREIGN KEY (IdUsuario) REFERENCES Usuarios(IdUsuario)
);

INSERT INTO Usuarios (Nombre, Apellido, Usuario, Contrasena, Rol, IsAdmin)
VALUES ('Jose', 'Gamez', 'Kiwait', '1725', 'admin', 1);
