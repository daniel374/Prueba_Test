-- CREA BASE DE DATOS DE PRUEBA
create database test_archivos;
use test_archivos;

create table tipos_archivo
(
id_tpa int (3) AUTO_INCREMENT,
extension varchar (5),
primary key (id_tpa)
);

create table detalle_archivo
(
id_da int (10),
nombre varchar (150),
id_tp_da int (3),
primary key (id_da),
foreign key (id_tp_da) references tipos_archivo (id_tpa)
);

-- Prueba de datos
INSERT INTO tipos_archivo (extension) VALUES ("xml");
INSERT INTO tipos_archivo (extension) VALUES ("pdf");
-- archivos
INSERT INTO detalle_archivo (id_da,nombre,id_tp_da) VALUES (1184835,"AN06729E2019_Esta_solicitud_debe_quedar_como_anonima_SOLICITUD_DE_INFORMACION_1",(SELECT id_tpa FROM tipos_archivo WHERE extension = "xml"));


