CREATE TABLE Usuarios (
    IdUsuario SERIAL PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100),
    Usuario VARCHAR(50) UNIQUE NOT NULL,
    Contrasena VARCHAR(255) NOT NULL,
    Rol VARCHAR(50) DEFAULT 'usuario',
    IsAdmin BOOLEAN DEFAULT FALSE  -- PostgreSQL usa BOOLEAN, no BIT
);

-- Tabla de Clientes
CREATE TABLE Clientes (
    IdCliente SERIAL PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Apellido VARCHAR(100),
    Telefono VARCHAR(20),
    Email VARCHAR(100),
    Direccion TEXT
);

-- Tabla de Proveedores
CREATE TABLE Proveedores (
    IdProveedor SERIAL PRIMARY KEY,
    NombreProveedor VARCHAR(100) NOT NULL,
    Telefono VARCHAR(20),
    Email VARCHAR(100),
    Direccion TEXT
);

-- Tabla de Productos
CREATE TABLE Productos (
    IdProducto SERIAL PRIMARY KEY,
    NombreProducto VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    PrecioCompra NUMERIC(10, 2) NOT NULL,
    PrecioVenta NUMERIC(10, 2) NOT NULL,
    Stock INT DEFAULT 0,
    IdProveedor INT,
    CONSTRAINT fk_proveedor
        FOREIGN KEY (IdProveedor)
        REFERENCES Proveedores(IdProveedor)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

-- Tabla de Compras
CREATE TABLE Compras (
    IdCompra SERIAL PRIMARY KEY,
    IdProducto INT NOT NULL,
    IdProveedor INT NOT NULL,
    Cantidad INT NOT NULL,
    PrecioTotal NUMERIC(10, 2) NOT NULL,
    FechaCompra DATE NOT NULL,
    FOREIGN KEY (IdProducto) REFERENCES Productos(IdProducto),
    FOREIGN KEY (IdProveedor) REFERENCES Proveedores(IdProveedor)
);

-- Tabla de Ventas
CREATE TABLE Ventas (
    IdVenta SERIAL PRIMARY KEY,
    IdProducto INT NOT NULL,
    IdCliente INT NOT NULL,
    Cantidad INT NOT NULL,
    PrecioTotal NUMERIC(10, 2) NOT NULL,
    FechaVenta DATE NOT NULL,
    IdUsuario INT,
    FOREIGN KEY (IdProducto) REFERENCES Productos(IdProducto),
    FOREIGN KEY (IdCliente) REFERENCES Clientes(IdCliente),
    FOREIGN KEY (IdUsuario) REFERENCES Usuarios(IdUsuario)
);

-- Inserción de usuario
INSERT INTO Usuarios (Nombre, Apellido, Usuario, Contrasena, Rol, IsAdmin)
VALUES ('Jose', 'Gamez', 'Kiwait', '1725', 'admin', TRUE);
