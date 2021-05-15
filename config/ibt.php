<?php


return [

    'images_type_validate' => 'jpg,jpeg,gif,png,svg,bmp,JPG,JPEG,GIF,PNG,SVG,BMP',
    'images_type_extension' => ['jpg','jpeg','gif','png','svg','bmp','JPG','JPEG','GIF','PNG','SVG','BMP'],
    'videos_type_extension' => ['mp4','3gp','bin'],
    'excel_type_extension' => ['xlsx','xls'],

    'file_max_bytes'           => '1024000',

    'doctos_type_validate' => 'xlsx,xls,pdf,docx,doc,pptx,ppt',
    'doctos_type_extension' => ['xlsx','xls','pdf','docx','doc','pptx','ppt'],

    'file_dropzone_mimetype' => 'image/jpg,image/jpeg,image/gif,image/png,image/JPG,image/JPEG,image/GIF,image/PNG,video/mp4,video/3gp,image/svg+xml,video/quicktime,video/quicktime',

    'limite_maximo_registros' => 200,
    'limite_minimo_registros' => 100,
    'maximo_registros_consulta' => 200,
    'minimo_registrios_consulta' => 100,

    // ------------------------,-----------------------------------
    // Aqui se deben configurar los formatos a utilizar.
    // -----------------------------------------------------------

    'archivos'=>[

        'fmt_lista_personas'  => 'fmt_lista_personas.xls',
        'fmt_lista_usuarios'  => 'fmt_lista_usuarios.xls',
        'fmt_lista_denuncias' => 'fmt_lista_denuncias.xls',
        'fmt_lista_catalogos' => 'fmt_lista_catalogos.xls',
        'fmt_lista_ina'       => 'fmt_lista_inai.xls',
        'fmt_lista_padprov'   => 'fmt_lista_padprov.xls',
        'icono_video'         => 'icon-video.png',
        'archivos TXT, CVS'   => 'archivo.txt',
        'archivos JSON'       => 'archivo.json',

    ],

    // ARCHIVOS DE IMAGENES DEL SISTEMA
    'logo_reportes_encabezado' => public_path().'/images/web/logo-0.png',

    // -----------------------------------------------------------
    // La mayor parte de los Tablas estan configuradas aquí,
    // es en este mismo sitio donde la debes mantener forerver
    // -----------------------------------------------------------

    'table_names' => [

        'users' => [
            'users'       => 'users',
            'roles'       => 'roles',
            'permissions' => 'permissions',
            'user_adress' => 'user_adress',
            'user_extend' => 'user_extend',
            'user_social' => 'user_social',
            'categorias'  => 'categorias',

            'adress_user' => 'adress_user',
            'extend_user' => 'extend_user',
            'social_user' => 'social_user',
        ],

        'catalogos' => [
            'users'        => 'users',
            'medidas'      => 'medidas',
            'prioridades'  => 'prioridades',
            'estatus'       => 'estatus',
            'origenes'     => 'origenes',
            'dependencias' => 'dependencias',
            'areas'        => 'areas',
            'subareas'     => 'subareas',
            'servicios'    => 'servicios',
            'ubicaciones'  => 'ubicaciones',
            'denuncias'    => 'denuncias',
            'respuestas'   => 'respuestas',
            'user_subarea' => 'user_subarea',
            'subarea_user' => 'subarea_user',
            'area_dependencia' => 'area_dependencia',
            'area_subarea' => 'area_subarea',
            'area_jefe' => 'area_jefe',
            'servicio_subarea' => 'servicio_subarea',
            'jefe_subarea' => 'jefe_subarea',
            'parent_respuesta'          => 'parent_respuesta',
            'respuesta_user'            => 'respuesta_user',
            'imagenes'                  => 'imagenes',
            'denuncia_imagene'          => 'denuncia_imagene',
            'imagene_user'              => 'imagene_user',
            'imagene_parent'            => 'imagene_parent',
            'imagenesregistrosfiscales' => 'imagenesregistrosfiscales',
            'imagen_registro_fiscal'    => 'imagen_registro_fiscal',
            'imagenescontratos'         => 'imagenescontratos',
            'contrato_imagen'           => 'contrato_imagen',
        ],
        'ubicaciones' => [
            'calles'             => 'calles',
            'colonias'           => 'colonias',
            'localidades'        => 'localidades',
            'ciudades'           => 'ciudades',
            'municipios'         => 'municipios',
            'estados'            => 'estados',
            'paises'             => 'paises',
            'codigospostales'    => 'codigospostales',

            'calle_colonia'      => 'calle_colonia',
            'calle_localidad'    => 'calle_localidad',
            'colonia_localidad'  => 'colonia_localidad',
            'localidad_municipio'=> 'localidad_municipio',
            'ciudad_municipio'   => 'ciudad_municipio',
            'estado_municipio'   => 'estado_municipio',
            'estado_pais'        => 'estado_pais',
            'domicilios'         => 'domicilios',
            'ubicaciones'        => 'ubicaciones',

            'calle_ubicacion'        => 'calle_ubicacion',
            'colonia_ubicacion'      => 'colonia_ubicacion',
            'comunidad_ubicacion'    => 'comunidad_ubicacion',
            'localidad_ubicacion'    => 'localidad_ubicacion',
            'ciudad_ubicacion'       => 'ciudad_ubicacion',
            'municipio_ubicacion'    => 'municipio_ubicacion',
            'estado_ubicacion'       => 'estado_ubicacion',
            'pais_ubicacion'         => 'pais_ubicacion',
            'codigopostal_ubicacion' => 'codigopostal_ubicacion',

            'ubicaciones'            => 'ubicaciones',

            'colonia_comunidad'      => 'colonia_comunidad',
            'codigopostal_colonia'   => 'codigopostal_colonia',
            'colonia_tipocomunidad'  => 'colonia_tipocomunidad',

            'imagenesubicaciones'    => 'imagenesubicaciones',
            'imagen_ubicacion'       => 'imagen_ubicacion',
            'persona_ubicacion'      => 'persona_ubicacion',
            'personas'               => 'personas',

            'dependencia_ubicacion'  => 'dependencia_ubicacion',

        ],
        'personas' => [
            'personas'                         => 'personas',
            'imagenes'                         => 'imagenes',
            'registros_fiscales'               => 'registros_fiscales',
            'imagen_persona'                   => 'imagen_persona',
            'registros_fiscal_ubicacion'       => 'registros_fiscal_ubicacion',
            'registros_fiscal_persona'         => 'registros_fiscal_persona',
            'registro_fiscal_ubicacion'        => 'registro_fiscal_ubicacion',
            'registro_fiscal_persona'          => 'registro_fiscal_persona',
            'contrato_registro_fiscal'         => 'contrato_registro_fiscal',
            'pariente_persona'                 => 'pariente_persona',
            'parentescos'                      => 'parentescos',
            'persona_ubicacion'                => 'persona_ubicacion',
            'rolesorigendatospersonas'         => 'rolesorigendatospersonas',
            'persona_rolesorigendatsopersona'  => 'persona_rolesorigendatsopersona',
            'reporte_transparencia'            => 'reporte_transparencia',
            'reporte_transparencia_documentos' => 'reporte_transparencia_documentos',
            'rolesrfc'                         => 'rolesrfc',
            'registro_fiscal_role'             => 'registro_fiscal_role',
            'rolespersonas'                    => 'rolespersonas',
            'persona_role'                     => 'persona_role',
        ],



    ],

    'style' => [
        'denuncia' => "<style>
                            b { font-family: arial, sans-serif; }
                            bAzul { font-family: arial, sans-serif; color:blue; }
                            p {text-align: justify;}
                            bVerde { font-family: arial, sans-serif; color:green; }
                            bChocolate { font-family: arial, sans-serif; color:chocolate; }
                            bOrange { font-family: arial, sans-serif; color:orangered; }
                            span { font-family: arial, sans-serif; text-align: center; }
                       </style>",
    ],



];

