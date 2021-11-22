<?php


require_once('class.Funciones.php');
class Menu
{
	public $db; ///objeto de la base de datos
	public $idusuario; //id de usuario del cual se va a buscar el menu
	public $idperfil; //id de usuario del cual se va a buscar el menu
	public $idmenu; //id del menu para buscar sus submenus
	private $fu;

	function Menu()
	{
		$this->fu = new Funciones();
	}

	//funcion para armar el menu principal	
	public function ArmarMenu()
	{

		////////////////////////////////////////  iconos de los menus
		////////////////////////////////////////  iconos de los menus

		$iconosSidebarMenu = array(
			// "<i class='th-sidebar-icon fas fa-user-shield'></i>",
			// "<i class='th-sidebar-icon fas fa-book-reader'></i>",
			// "<i class='th-sidebar-icon fas fa-chalkboard-teacher'></i>",
			// "<i class='th-sidebar-icon fas fas fa-book'></i>",
			// "<i class='th-sidebar-icon fas fas fa-book'></i>",
		);

		//////////////////////////////////////// iconos de los submenu
		//////////////////////////////////////// iconos de los submenu

		$iconosSidebarSubmenu = array(
			// array(
			// 	"<i class='th-sidebar-sub-icon fas fa-user-cog'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-users'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-box-open'></i>"
			// ),
			// array(
			// 	"<i class='th-sidebar-sub-icon fas fa-newspaper'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-toolbox'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-cog'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-paperclip'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-paperclip'></i>",

			// ),
			// array(
			// 	"<i class='th-sidebar-sub-icon fas fa-chalkboard'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-archive'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-paperclip'></i>",
			// 	"<i class='th-sidebar-sub-icon fas fa-paperclip'></i>",

			// )

		);
		$contadorIconoMenu = 0;

		///////////////////////////////////////////////////////////////////// 
		///////////////////////////////////////////////////////////////////// 

		$menu = "";
		$query_modulos = "SELECT modulo, idmodulos, estatus FROM modulos WHERE estatus=1 ORDER BY nivel ";
		$result = $this->db->consulta($query_modulos);
		$rows = $this->db->fetch_assoc($result);
		$total = $this->db->num_rows($result);

		if ($total > 0) {
			do {
				$contadorIconoSubmenu = 0;

				$query_menu = "SELECT modulos_menu.menu, 
					modulos_menu.archivo, 
					modulos_menu.ubicacion_archivo, 
					modulos_menu.estatus
					FROM perfiles_permisos 
					INNER JOIN modulos_menu 
					ON perfiles_permisos.idmodulos_menu = modulos_menu.idmodulos_menu
					WHERE modulos_menu.estatus=1
					AND perfiles_permisos.idperfiles=$this->idperfil 
					AND modulos_menu.idmodulos=" . $rows['idmodulos'] . " ORDER BY nivel";

				$resp = $this->db->consulta($query_menu);
				$row = $this->db->fetch_assoc($resp);
				$totalRow = $this->db->num_rows($resp);



				if ($totalRow > 0) {
					$menu .=  '<li class="sidebar-item"> <a class="sidebar-link th-link-menu has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">' .  $iconosSidebarMenu[$contadorIconoMenu] . '</i><span class="hide-menu">' . $this->fu->imprimir_cadena_utf8($rows['modulo']) . '</span></a>';
					$menu .= '<ul aria-expanded="false" class="collapse  first-level">';

					do {
						$menu .=  '<li class="sidebar-item"><a  class="sidebar-link th-link-submenu" onClick="aparecermodulos(\'' . $row['ubicacion_archivo'] . $row['archivo'] . '\',\'main\'); return false;"> ' . $iconosSidebarSubmenu[$contadorIconoMenu][$contadorIconoSubmenu] . '</i><span class="hide-menu">' . $this->fu->imprimir_cadena_utf8($row['menu']) . '</span></a></li>';
						$contadorIconoSubmenu++;
					} while ($row = $this->db->fetch_assoc($resp));

					$menu .= '</ul></li>';
					$contadorIconoMenu++;
				}
			} while ($rows = $this->db->fetch_assoc($result));
		} else {
			$menu .= "No existen modulos";
		}
		$menu .= '<li class="sidebar-item" style="margin-top:40px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php" aria-expanded="false"><i class="fas fa-sign-out-alt" style="font-size:20px; margin-right:15px"></i><span class="hide-menu">SALIR</span></a></li>';

		return $menu;
	}
} /* end of class Menu */
