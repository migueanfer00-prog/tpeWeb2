-- Created by Redgate Data Modeler (https://datamodeler.redgate-platform.com)
-- Last modification date: 2026-10-26 21:30:10.615

-- tables
-- Table: ADMIN
CREATE TABLE ADMIN (
    id_admin int  NOT NULL AUTO_INCREMENT,
    usuario varchar(30)  NOT NULL,
    contrasenia varchar(30)  NOT NULL,
    CONSTRAINT PK_id_admin PRIMARY KEY (id_admin)
);

-- Table: CATEGORIA
CREATE TABLE CATEGORIA (
    id_categoria int  NOT NULL AUTO_INCREMENT,
    nombre_categoria varchar(30)  NOT NULL,
    descripcion varchar(250)  NOT NULL,
    CONSTRAINT id_categoria PRIMARY KEY (id_categoria)
);

-- Table: PANADERIA
CREATE TABLE PANADERIA (
    id_panaderia int  NOT NULL AUTO_INCREMENT,
    nombre varchar(20)  NOT NULL,
    fecha_fundacion date  NOT NULL,
    horario_apertura time  NOT NULL,
    horario_cierre time  NOT NULL,
    duenio varchar(30)  NOT NULL,
    direccion varchar(50)  NOT NULL,
    telefono int  NOT NULL,
    CONSTRAINT PK_PANADERIA PRIMARY KEY (id_panaderia)
);

-- Table: PRODUCTO
CREATE TABLE PRODUCTO (
    id_producto int  NOT NULL AUTO_INCREMENT,
    nombre varchar(20)  NOT NULL,
    precio_unidad decimal(8,2)  NULL,
    precio_docena decimal(8,2)  NULL,
    id_panaderia int  NOT NULL,
    id_categoria int  NOT NULL,
    CONSTRAINT PK_PRODUCTO PRIMARY KEY (id_producto)
);

-- foreign keys
-- Reference: FK_PRODUCTO_CATEGORIA (table: PRODUCTO)
ALTER TABLE PRODUCTO ADD CONSTRAINT FK_PRODUCTO_CATEGORIA FOREIGN KEY FK_PRODUCTO_CATEGORIA (id_categoria)
    REFERENCES CATEGORIA (id_categoria);

-- Reference: FK_PRODUCTO_PANADERIA (table: PRODUCTO)
ALTER TABLE PRODUCTO ADD CONSTRAINT FK_PRODUCTO_PANADERIA FOREIGN KEY FK_PRODUCTO_PANADERIA (id_panaderia)
    REFERENCES PANADERIA (id_panaderia);

-- End of file.

