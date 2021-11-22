-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-11-2021 a las 20:41:47
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `modulos` (`idmodulos`, `modulo`, `nivel`, `estatus`) VALUES
(1, 'ADMINISTRADOR', 1, 1),
(5, 'HOSPITAL', 1, 1),
(8, 'PACIENTES', 4, 1),
(9, 'PROCEDIMIENTOS', 5, 1);

INSERT INTO `modulos_menu` (`idmodulos_menu`, `idmodulos`, `menu`, `archivo`, `ubicacion_archivo`, `nivel`, `estatus`) VALUES
(2, 1, 'Usuarios', 'vi_usuarios.php', 'administrador/usuarios/', 2, 1),
(3, 1, 'Perfiles', 'vi_perfiles.php', 'administrador/perfiles/', 1, 1),
(4, 1, 'Modulos', 'vi_modulos.php', 'administrador/modulos/', 3, 1),
(14, 5, 'Hospital', 'vi_hospital.php', 'modulos/hospital/', 1, 1),
(15, 5, 'Doctores', 'vi_doctor.php', 'modulos/doctor/', 2, 1),
(16, 5, 'Insumos', 'vi_insumo.php', 'modulos/insumo/', 3, 1),
(17, 8, 'Pacientes', 'vi_paciente.php', 'modulos/paciente/', 1, 1),
(18, 9, 'Tipo Procedimientos', 'vi_tipoProcedimiento.php', 'modulos/tipoProcedimiento/', 1, 1),
(19, 9, 'Procedimientos', 'vi_procedimiento.php', 'modulos/procedimiento/', 2, 1);

INSERT INTO `perfiles` (`idperfiles`, `perfil`, `estatus`) VALUES
(1, 'ADMINISTRADOR', 1);


INSERT INTO `perfiles_permisos` (`idperfiles`, `idmodulos_menu`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19);


INSERT INTO `usuarios` (`idusuarios`, `idperfiles`, `nombre`, `paterno`, `materno`, `telefono`, `celular`, `email`, `usuario`, `clave`, `estatus`, `tipo`) VALUES
(1, 1, 'enrique', 'de la cruz', 'j', '----', '----', 'admin@admin.com', 'admin', '121275', 1, 0);




INSERT INTO `hospital` (`numero`, `nombre`, `direccion`, `telefono`, `correo`) VALUES
(1, 'ISSSTE', 'Boulevard Salomón González Blanco #4650, Fracc, Blvrd Lic Salomon Gonzalez Blanco, Las Torres', '9612547878', 'hospitalissste@hotmail.com'),
(2, 'imss', '5 de mayo', '9614578259', 'hospitalimss@hotmail.com');



INSERT INTO `doctor` (`cedula`, `nombre`, `edad`, `sexo`, `telefono`, `especialidad`, `hospital_numero`) VALUES
('41733718', 'JOSE ALONSO GONZALEZ VAZQUEZ ', 22, '1', '9631254785', 'cirujias ', 2),
('52369874', 'OSCAR JOSE HERNANDEZ RICO', 35, '1', '9612586320', 'cirujias ', 1),
('75076432', 'DULCE MARIA OJEDA LOPEZ ', 30, '2', '9612547878', 'cirujias ', 2),
('76307332', 'JUAN ANTONIO LOPEZ GUTIERREZ ', 48, '1', '9614578259', 'cirujias ', 1),
('78520149', 'CARLOS CAMACHO ESCOBAR', 50, '1', '9615483207', 'cirujias ', 1);



INSERT INTO `insumo` (`idinsumo`, `nombre`, `cantidad`, `marca`) VALUES
(103, 'ELECTROCAUTERIO', 1, 'DELTRONIX'),
(108, 'BISTURIS Y SIMILARES', 3, 'DELTRONIX'),
(111, 'MATERIAL PARA SUTURA', 2, 'DELTRONIX'),
(10606, 'GUANTES', 5, 'DELTRONIX'),
(11503, 'ENGRAPADORAS QUIRÚRGICAS', 10, 'DELTRONIX');




INSERT INTO `paciente` (`rfc`, `nombre`, `edad`, `sexo`, `telefono`, `tipo_derecho_habiente`) VALUES
('G0JI860423', 'ISABEL DE JESUS GONZALES JOSE ', 32, '1', '9615475338', '1'),
('GEUM601207', 'ANTONIO TORRES IBARIAS ', 62, '1', '9618697423', '2'),
('GOLS911125', 'ELIDIA LOPEZ CORDERO', 48, '2', '9612365874', '2'),
('GUGA660703', 'AGUSTINA GUTIERREZ GUMETA', 53, '2', '9615379607', '1'),
('HEZG610324', 'GABRIEL HUGO HERNANDEZ ZEA', 58, '1', '9615374064', '2'),
('MIMA380417', 'ANA MARIA MIJANGOS MORALES', 81, '2', '9615268741', '2'),
('MOCA751106', 'FLORIANA CRUZ HERNANDEZ ', 66, '2', '9615764893', '2'),
('MOCF800205', 'HERMENENGILDA HERNANDEZ GOMEZ', 34, '2', '9618932014', '1'),
('NAAR570106', 'EMETERIO NAVARRO MADARIAGA', 81, '1', '9612357895', '1'),
('TULM730908', 'MIGUEL TRUJILLO LOPEZ', 17, '1', '9618753215', '1');




INSERT INTO `tipo_procedimiento` (`idtipo_procedimiento`, `nombre`, `costo`, `iva`) VALUES
(3, 'Cistoscopía diagnóstica', 3988, 638.08),
(4, 'Artroscopía de rodilla sin implante', 10026.8, 1604.28),
(5, 'By-pass gástrico', 57067, 90131),
(6, 'Paquete de bisturí ultrasónico', 9395, 1503.2),
(7, 'Uretrotomía', 6786, 1085.7),
(9, 'Paquete de electrocirugía adulto', 413, 66),
(10, 'Colecistectomía sin exploración ', 10081, 1613),
(11, 'Cistoscopía diagnóstica', 3988, 638.08),
(12, 'Artroscopía de rodilla sin implante', 10026.8, 1604.28),
(13, 'By-pass gástrico', 57067, 90131),
(14, 'Paquete de bisturí ultrasónico', 9395, 1503.2),
(15, 'Uretrotomía', 6786, 1085.7),
(16, 'litotripsia pielocalicial', 16748, 20679.7);
COMMIT;

