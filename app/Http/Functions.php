<?php

// Key Value From Json
function kvfj($json, $key){
	if($json == null):
		return null;
	else:
		$json = $json;
		$json = json_decode($json, true);
		if(array_key_exists($key, $json)):
			return $json[$key];
		else:
			return null;
		endif;
	endif;
}

function getModulesArray(){
	$a = [
		'0' => 'Productos',
		'1' => 'Blog'
	];

	return $a;
}

function getRoleUserArray($mode, $id){
	$roles = ['0' => 'Usuario normal', '1' => 'Administrador'];
	if(!is_null($mode)):
		return $roles;
	else:
		return $roles[$id];
	endif;
}

function getUserStatusArray($mode, $id){
	$status = ['0' => 'Registrado', '1' => 'Verificado', '100' => 'Suspenso'];
	if(!is_null($mode)):
		return $status;
	else:
		return $status[$id];
	endif;

}

function user_permissions(){
	$p = [
		'dashboard' => [
			'icon' => '<i class="fas fa-home"></i>',
			'title' => 'Módulo de Dashboard',
			'keys' => [
				'dashboard' 				=> 'Permitido visualizar dashboard.',
				'dashboard_small_stats' 	=> 'Permitido visualizar consolidado.',
				'dashboard_sell_today' 		=> 'Permitido visualizar faturado atual.'
			]
		],
		'products' => [
			'icon' => '<i class="fas fa-boxes"></i>',
			'title' => 'Módulo de Productos',
			'keys' => [
				'products' 					=> 'Permitido visualizar lista de produtos.',
				'product_add' 				=> 'Permitido incluir novo produtos.',
				'product_edit' 				=> 'Permitido editar produtos.',
				'product_search' 			=> 'Permitido buscar productos.',
				'product_delete' 			=> 'Permitido excluir produtos.',
				'product_gallery_add' 		=> 'Permitido incluir imagens na galeria.',
				'product_gallery_delete' 	=> 'Permitido excluir imagens da galeria.',
				'product_inventory' 		=> 'Permitido administrar inventário do produto.'
			]
		],
		'categories' => [
			'icon' => '<i class="far fa-folder-open"></i>',
			'title' => 'Módulo de Categorias',
			'keys' => [
				'categories' 		=> 'Permitido visualizar categorias.',
				'category_add' 		=> 'Permitido incluir novas categorias.',
				'category_edit' 	=> 'Permitido editar categorias.',
				'category_delete' 	=> 'Permitido excluir categorias.'
			]
		],

		'bookings' => [
            'icon' => '<i class="far fa-folder-open"></i>',
            'title' => 'Modulo Ovação',
            'keys' => [
                'bookings' => 'Permitido listar.',
                'booking_add' => 'Permitido incluir novo.',
                'booking_edit' => 'Permitido editar.',
                'booking_delete' => 'Permitido excluir.',
                'booking_search' 			=> 'Permitido buscar .',
				'booking_gallery_add' => 'Incluir imagens',
                'booking_gallery_delete' => 'Excluir imagens da galeria.',
                'booking_pdf' => 'Permitido imprimir.',
                'booking_excel' => 'Permitido importar arquivo excel.',
				'booking_gallery' => 'Visualiza fotos'
            ]
        ],


        'clients' => [
			'icon' => '<i class="fas fa-user-friends"></i>',
			'title' => 'Módulo de Clientes',
			'keys' => [
				'clients' 					=> 'Permitido visualizar .',
				'client_add' 				=> 'Permitido incluir .',
				'client_edit' 				=> 'Permitido editar .',
				'client_search' 			=> 'Permitido buscar .',
				'client_delete' 			=> 'Permitido excluir .'

			]
		],

		'pessoas' => [
            'icon' => '<i class="fa fa-users"></i>',
            'title' => 'Modulo de Pessoas',
            'keys' => [
                'pessoas' => 'Permitido ver a lista.',
                'pessoa_add' => 'Permitido incluir novo.',
                'pessoa_edit' => 'Permitido editar.',
                'pessoa_search' => 'Permitido pesquisar.',
                'pessoa_delete' => 'Permitido eliminar.',
                'pessoa_pdf' => 'Permitido imprimir.'
            ]
        ],

        'services' => [
			'icon' => '<i class="fas fa-wrench"></i>',
			'title' => 'Módulo de Serviços',
			'keys' => [
				'services' 					=> 'Permitido visualizar .',
				'service_add' 				=> 'Permitido incluir .',
				'service_edit' 				=> 'Permitido editar .',
				'service_search' 			=> 'Permitido buscar .',
				'service_delete' 			=> 'Permitido excluir .'

			]
		],

		'ships' => [
			'icon' => '<i class="fas fa-ship"></i>',
			'title' => 'Módulo de Navio',
			'keys' => [
				'ships' 				=> 'Permitido visualizar .',
				'ship_add' 				=> 'Permitido incluir .',
				'ship_edit' 			=> 'Permitido editar .',
				'ship_search' 			=> 'Permitido buscar .',
				'ship_delete' 			=> 'Permitido excluir .'

			]
		],



		'transportadoras' => [
			'icon' => '<i class="fas fa-truck"></i>',
			'title' => 'Módulo de Transportador',
			'keys' => [
				'transportadoras' 					=> 'Permitido visualizar .',
				'transportadora_add' 				=> 'Permitido incluir .',
				'transportadora_edit' 				=> 'Permitido editar .',
				'transportadora_search' 			=> 'Permitido buscar .',
				'transportadora_delete' 			=> 'Permitido excluir .'

			]
		],

		'isos' => [
			'icon' => '<i class="fas fa-flag"></i>',
			'title' => 'Módulo de ISO',
			'keys' => [
				'isos' 				=> 'Permitido visualizar .',
				'iso_add' 			=> 'Permitido incluir .',
				'iso_edit' 			=> 'Permitido editar .',
				'iso_search' 		=> 'Permitido buscar .',
				'iso_delete' 		=> 'Permitido excluir .'

			]
		],

		'tipocargas' => [
			'icon' => '<i class="fas fa-box"></i>',
			'title' => 'Módulo de Tipo Carga',
			'keys' => [
				'tipocargas' 			=> 'Permitido visualizar .',
				'tipocarga_add' 		=> 'Permitido incluir .',
				'tipocarga_edit' 		=> 'Permitido editar .',
				'tipocarga_search' 		=> 'Permitido buscar .',
				'tipocarga_delete' 		=> 'Permitido excluir .'

			]
		],

		'manuseios' => [
			'icon' => '<i class="fas fa-box-open"></i>',
			'title' => 'Módulo de Manuseio',
			'keys' => [
				'manuseios' 			=> 'Permitido visualizar .',
				'manuseio_add' 			=> 'Permitido incluir .',
				'manuseio_edit' 		=> 'Permitido editar .',
				'manuseio_search' 		=> 'Permitido buscar .',
				'manuseio_delete' 		=> 'Permitido excluir .'

			]
		],

		'capas' => [
            'icon' => '<i class="fas fa-list"></i>',
            'title' => 'Modulo de Capa de Lote',
            'keys' => [
                'capas' => 'Listar.',
                'capa_add' => 'Incluir.',
                'capa_edit' => 'Editar.',
                'capa_search' => 'Pesquisar.',
                'capa_delete' => 'Excluir.',
                'capa_pdf' => 'Permitido imprimir Capa de lote.',

            ]
        ],

		'rents' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => 'Modulo Locação',
            'keys' => [
                'rents' => 'Listar.',
                'rent_add' => 'Incluir.',
                'rent_edit' => 'Editar.',
                'rent_search' => 'Pesquisar.',
                'rent_delete' => 'Excluir.',
                'rent_pdf' => 'Permitido imprimir.',

            ]
        ],

        'tickets' => [
            'icon' => '<i class="fas fa-tag"></i>',
            'title' => 'Modulo de Ticket Pesagem',
            'keys' => [
                'tickets' => 'Listar.',
                'ticket_add' => 'Incluir.',
                'ticket_edit' => 'Editar.',
                'ticket_search' => 'Pesquisar.',
                'ticket_delete' => 'Excluir.',
                'ticket_pdf' => 'Permitido imprimir Capa de lote.',

            ]
        ],

		'users' => [
			'icon' => '<i class="fa fa-user-circle"></i>',
			'title' => 'Módulo de Usuarios',
			'keys' => [
				'user_list' 		=> 'Permitido visualizar lista de usuários.',
				'user_edit' 		=> 'Permitido editar.',
				'user_banned' 		=> 'Permitido suspender usuários.',
				'user_permissions' 	=> 'Permitido administrar permissões de usuários.'
			]
		],
		'sliders' => [
			'icon' => '<i class="far fa-images"></i>',
			'title' => 'Módulo de Sliders',
			'keys' => [
				'sliders_list' 		=> 'Permitido visualizar lista de Sliders.',
				'slider_add'		=> 'Permitido incluir Sliders',
				'slider_edit' 		=> 'Permitido editar sliders',
				'slider_delete' 	=> 'Permitido excluir sliders'
			]
		],
		'settings' => [
			'icon' => '<i class="fas fa-cogs"></i>',
			'title' => 'Módulo de Configurações',
			'keys' => [
				'settings' => 'Pode modificar configurações.'
			]
		],
		'orders' => [
			'icon' => '<i class="fas fa-clipboard-list"></i>',
			'title' => 'Módulo de Ordens',
			'keys' => [
				'orders_list' => 'Pode visualizar listagem'
			]
		]
	];

	return $p;

}

function getUserYears(){
	$ya = date('Y');
	$ym = $ya - 18;
	$yo = $ym - 62;

	return [$ym,$yo];
}

function getMonths($mode, $key){
	$m = [
		'01' => 'JANEIRO',
		'02' => 'FEVEREIRO',
		'03' => 'MARÇO',
		'04' => 'ABRIL',
		'05' => 'MAIO',
		'06' => 'JUNHO',
		'07' => 'JULHO',
		'08' => 'AGOSTO',
		'09' => 'SETEMBRO',
		'10' => 'OUTUBRO',
		'11' => 'NOVEMBRO',
		'12' => 'DEZEMBRO'
	];
	if($mode == "list"){
		return $m;
	}else{
		return $m[$key];
	}
}
