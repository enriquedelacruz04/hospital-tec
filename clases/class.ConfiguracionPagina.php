<?php
class ConfiguracionPagina
{
    //---------------------- Objeto de conexion con la base de datos
    public $db;

    //---------------------- ID's
    public $ultimoId;
    public $id;

    //---------------------- Variables de la DB 
    public $nombrePagina;
    public $noCursos;
    public $noCertificados;
    public $noPlaticas;
    public $noClientes;
    public $correo;
    public $telefono1;
    public $telefono2;
    public $ubicacion;
    public $ubicacionMapa;
    public $facebook;
    public $instagram;
    public $twitter;

    //---------------------- Datos de la tabla de la DB
    private $tablaNombre = "configuracion_pagina";
    private $tablaId = "idconfiguracion_pagina";

    //////////////////////////////////////// Funciones (configuracion_pagina)
    //////////////////////////////////////// Funciones (configuracion_pagina)

    //---------------------- Guardar nuevo registro
    public function guardarConfiguracionPagina()
    {
        $query = "INSERT INTO $this->tablaNombre
			(idcliente, nombre, direccion, whatsapp, email, estatus )
			 VALUES 
			 (
			 '$this->idCliente', 
			 '$this->nombre', 
			 '$this->direccion',
			 '$this->whatsapp',
			 '$this->email',
			 '$this->estatus'
			 )";

        $this->db->consulta($query);
        $this->ultimoId = $this->db->id_ultimo();
    }

    //---------------------- Modificar registro
    public function modificarConfiguracionPagina()
    {
        $query = "UPDATE $this->tablaNombre SET 
		nombre_pagina = '$this->nombrePagina',
		no_cursos = '$this->noCursos',
		no_certificados = '$this->noCertificados',
		no_platicas = '$this->noPlaticas',
		no_clientes = '$this->noClientes',
		correo = '$this->correo',
		telefono1 = '$this->telefono1',
		telefono2 = '$this->telefono2',
		ubicacion = '$this->ubicacion',
		ubicacion_mapa = '$this->ubicacionMapa',
		facebook = '$this->facebook',
		instagram = '$this->instagram',
		twitter = '$this->twitter'

		WHERE $this->tablaId = '$this->id'";
        $this->db->consulta($query);
    }

    //---------------------- Consulta todos los registros
    public function getAllConfiguracionPagina()
    {
        $query = "SELECT * FROM  $this->tablaNombre";
        $result = $this->db->consulta($query);
        $numResult = $this->db->num_rows($result);

        if ($numResult > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
