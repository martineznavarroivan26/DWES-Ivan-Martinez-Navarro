<?php
     require_once './model/model_participant.php';
    class ApiController{

        //la url contendrá el nombre de la funcion que es el mismo de la BBDD
        //y segun el codigo pues ya sale el que toque
        //ejemplo http://localhost/proyectoApi/index.php/forms/sueno/10021
        public function sueno($cod){
            $participanteModel= new ParticipanteModel();
            $respuesta= $participanteModel->encuestaSuenio($cod);
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }

        public function actividad($cod){
            $participanteModel= new ParticipanteModel();
            $respuesta= $participanteModel->encuestaActividad($cod);
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }

        public function alimentacion($cod){
            $participanteModel= new ParticipanteModel();
            $respuesta= $participanteModel->encuestaAlimentacion($cod);
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }

        public function antropometrico($cod){
            $participanteModel= new ParticipanteModel();
            $respuesta= $participanteModel->encuestaAntropometrico($cod);
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }
        
        public function todos($cod){
            $participanteModel= new ParticipanteModel();
            $participante = $participanteModel->obtenerParticipanteEntidad($cod);
 
            if ($participante === null) {
                header("Content-Type: application/json");
                http_response_code(404);
                echo json_encode(["error" => "Participante no encontrado"]);
                return;
            }

            $respuesta= array(
                "participante" => array(
                    "cod_participante" => $participante->getCodigo()
                ),
                "sueno" => $participante->getSueno(),
                "actividad" => $participante->getActividad(),
                "alimentacion" => $participante->getAlimentacion(),
                "antropometrico" => $participante->getAntropometrico()
            );
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }
        public function mostrarTodo(){
            $participanteModel= new ParticipanteModel();
            $respuesta= $participanteModel->mostrarTodo();
            header("Content-Type: application/json");
            echo json_encode($respuesta);
        }

        public function extraerApi(){
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = trim($uri, '/');
            $partes = explode("/", $uri);
            return $partes;
        }
    }
?>