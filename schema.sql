CREATE TABLE staff (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL, -- Correo electrónico
    hashed_password VARCHAR(64) NOT NULL, -- Contraseña hasheada
    nombre VARCHAR(255) NOT NULL, -- Nombre completo
    rol ENUM('admin', 'staff', 'trainer') NOT NULL,
    hired_at DATETIME NOT NULL, -- Fecha de contratación
    fired_at DATETIME -- Fecha de despido
);

-- lalohao@gmail.com // hello
INSERT INTO `staff` (`id`, `email`, `hashed_password`, `nombre`, `rol`, `hired_at`, `fired_at`)
    VALUES (NULL, 'lalohao@gmail.com', '2cf24dba5fb0a30e26e83b2ac5b9e29e1b161e5c1fa7425e73043362938b9824', 'Eduardo Vazquez', 'admin', NOW(), '');

CREATE TABLE clients (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL, -- Nombre completo
    email VARCHAR(255) NOT NULL, -- Correo electrónico
    telefono VARCHAR(20) NOT NULL, -- Teléfono
    expires_at DATE NOT NULL, -- Fecha de expiración de membresía
    created_at DATETIME NOT NULL, -- Fecha de registro
    created_by INT NOT NULL, -- Registrado por
    FOREIGN KEY (created_by) REFERENCES staff(id)
);

-- fecha nacimiento
-- peso
-- estatura