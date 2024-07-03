<?php
class Formularios extends Frontend
{
    protected $message;
    function __construct()
    {
        parent::__construct();
        $this->load->model('MantenimientoModel', 'm');
        $this->load->model('RedesModel', 'r');
        $this->load->model('PublicacionModel', 'p');

        $this->load->model('Querys', 'q');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title1'] = 'Sistema';
        $this->data['subtitle'] = 'UPEA';
        $this->data['carrera'] = '';
        $this->data['page_content'] = 'frontend/formularios/redes';
        $this->data['page'] = '';
        $this->render();
    }
    /**
     * init:: Menu para guardar formularios
     */

    public function guardarFormulario()
    {
        switch ($this->session->tipo) {
            case 'mantenimiento':
                $this->guardarMantenimiento();
                break;
            case 'software':
                $this->guardarSoftware();
                break;
            case 'redes':
                $this->guardarRedes();
                break;
            default:
                'opcion no valida';
                break;
        }
    }
    /**
     * end:: Menu para guardar formularios
     */

    /**
     * init:: formulario redes
     */

    public function redes()
    {
        $this->session->set_userdata('tipo', 'redes');

        $this->data['title1'] = 'Sistema';
        $this->data['subtitle'] = 'UPEA';
        $this->data['carrera'] = '';
        $this->data['page_content'] = 'frontend/formularios/redes';
        $this->data['page'] = 'redes';

        $this->render();
    }
    public function getDatosRedes()
    {
        if ($this->input->is_ajax_request()) {
            $data['data']['defectos'] = $this->r->getDefectosRedes();
            echo json_encode($data);
        }
    }
    public function guardarRedes()
    {
        $idpersona = trim($this->input->post('idpersona'));

        $this->form_validation->set_rules('idpersona', 'cedula del solicitante', 'required');
        $this->form_validation->set_rules('unidad', 'unidad', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header('400');
            echo validation_errors();
        } else {
            $defectos = $this->input->post('defectos') ?? [];

            // preparando datos de formulario para la inserción
            $datosInsertar = [
                'id_solicitante' => $this->input->post('idpersona'),
                'celular' => trim($this->input->post('celular')),
                'email' => trim($this->input->post('email')),
                'unidad' => trim($this->input->post('unidad')),
                'descripcion' => trim($this->input->post('descripcion')),
                'estado' => 'A'
            ];

            //inserta formulario de redes
            $id = $this->q->insertarTabla('r_formularios_redes', $datosInsertar);

            //inserta  defectos 

            foreach ($defectos as $d) {
                $this->q->insertarTabla('r_defectos_reportados', ['id_formulario' => $id, 'id_defecto' => $d]);
            }
            //respuesta ala petición ajax
            $this->session->set_userdata('message', 'Su solicitud fue enviada, recibirá la notificación a su correo.');

            echo json_encode(['message' => 'Solicitud enviada correctamente.']);
        }
    }
    /**
     * end:: formulario redes
     */

    /**
     * init:: formulario software
     */
    public function software()
    {
        $this->session->set_userdata('tipo', 'software');
        $this->data['title1'] = 'Sistema';
        $this->data['subtitle'] = 'UPEA';
        $this->data['carrera'] = '';
        $this->data['page_content'] = 'frontend/formularios/software';
        $this->data['page'] = 'software';

        $this->render();
    }
    public function guardarSoftware()
    {
        $idpersona = trim($this->input->post('idpersona'));

        /**crear nuevo formulario o actualizarlo */
        $this->form_validation->set_rules('idpersona', 'solicitante', 'required');
        $this->form_validation->set_rules('celular', 'celular del solicitante', 'required');
        $this->form_validation->set_rules('email', 'Correo del solicitante', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header('400');
            echo validation_errors();
        } else {
            $data = [
                'id_solicitante' => $this->input->post('idpersona'),
                'id_usuario' => $this->session->user_id,
                'modulo' => $this->input->post('modulo'),
                'opciones' => $this->input->post('opciones'),
                'tipo_trabajo' => $this->input->post('tipo_trabajo'),
                'celular' => $this->input->post('celular'),
                'email' => $this->input->post('email'),
                'observaciones' => $this->input->post('observaciones'),
                'estado' => 'A'
            ];

            $this->q->insertarTabla('s_formularios_software', $data);
            $this->session->set_userdata('message', 'Su solicitud fue enviada, resibirá la notificación a su correo.');
            echo json_encode(['message' => 'Formulario creado correctamente']);
        }
    }
    /**
     * end:: formulario software
     */
    /**
     * init:: formulario mantenimiento
     */
    public function mantenimiento()
    {
        // $visits = $this->session->userdata('visits');
        // if ($visits === FALSE) {
        //     $visits = 1;
        // } else {
        //     $visits++;
        // }
        // $this->session->set_userdata('visits', $visits);
        // echo "Número de visitas: " . $visits;
        $this->session->set_userdata('tipo', 'mantenimiento');

        $this->data['title1'] = 'Sistema';
        $this->data['subtitle'] = 'UPEA';
        $this->data['carrera'] = '';
        $this->data['page_content'] = 'frontend/formularios/mantenimiento';
        $this->data['page'] = 'mantenimiento';

        $this->render();
    }
    public function getDatosMantenimiento()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode([
                [
                    'modelos' => $this->m->get_model_equipos(),
                    'marcas' => $this->m->get_marcas_equipos(),
                    'tipos' => $this->m->get_tipos_equipos(),
                    'defectos' => $this->m->get_defectos_equipo()
                ]
            ]);
        }
    }
    public function guardarMantenimiento()
    {
        $idpersona = trim($this->input->post('idpersona'));

        /**crear nuevo formulario o actualizarlo */
        $this->form_validation->set_rules('idpersona', 'solicitante', 'required');
        $this->form_validation->set_rules('celular', 'celular del solicitante', 'required');
        $this->form_validation->set_rules('email', 'Correo del solicitante', 'required');
        $this->form_validation->set_rules('area_origen', 'Area', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->output->set_status_header('400');
            echo validation_errors();
        } else {
            $data = [
                'id_solicitante' => intval($idpersona),
                'id_tipo_equipo' => $this->input->post('id_tipo_equipo') ? $this->input->post('id_tipo_equipo') : null,
                'id_marca' => $this->input->post('id_marca_equipo') ? $this->input->post('id_marca_equipo') : null,
                'id_modelo' => $this->input->post('id_modelo_equipo') ? $this->input->post('id_modelo_equipo') : null,
                'id_defecto' => $this->input->post('id_defecto') ? $this->input->post('id_defecto') : null,
                'celular' => intval($this->input->post('celular')),
                'email' => $this->input->post('email'),
                'estado_equipo' => $this->input->post('estado_equipo'),
                'area_origen' => $this->input->post('area_origen'),
                'descripcion' => $this->input->post('descripcion'),
                'defecto' => $this->input->post('defecto'),
                'solucion' => $this->input->post('solucion'),
                'estado' => 'A',
            ];
            $this->q->insertarTabla('m_formularios_mantenimiento', $data);
            $this->session->set_userdata('message', 'Su solicitud fue enviada, resibirá la notificación a su correo.');
            echo json_encode(['message' => 'Formulario enviado correctamente']);
        }
    }

    /**
     * end:: formulario mantenimiento
     */

    /**
     * init:: Publicaciones
     */
    public function publicaciones()
    {
        $this->data['title1'] = 'Sistema';
        $this->data['subtitle'] = 'UPEA';
        $this->data['carrera'] = '';
        $this->data['page_content'] = 'frontend/publicaciones/publicaciones';
        $this->data['page'] = 'publicaciones';

        $this->render();
    }
    public function getPublicaciones()
    {
        // if (!$this->input->is_ajax_request()) {
        //     exit('No direct script access allowed');
        // }
        $limit = 3;
        $page = $this->input->get('page') ?? 1;
        $init = ($page - 1) * 3;

        $data['publicaciones'] = $this->p->getPublicaciones(null, $init, $limit);
        foreach ($data['publicaciones'] as $key => $d) {
            $d->banner =  $this->p->getImagen($d->url);
        }
        $data['paginate']['cantidad'] = $this->p->getCantidadPublicaciones();
        $data['paginate']['page'] = $page;
        echo json_encode($data);
    }
    public function getPublicacionesSearch()
    {
        $string = $this->input->get('buscarString');
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $data = $this->p->getPublicacionesSearch($string);
        foreach ($data as $key => $d) {
            $d->banner =  $this->p->getImagen($d->url);
        }
        echo json_encode($data);
    }
    public function paginate()
    {
    }


    /**
     * end:: Publicaciones
     */





    public function buscarPersona()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->q->buscarPorCI($this->input->get('buscarString')));
        }
    }
}
