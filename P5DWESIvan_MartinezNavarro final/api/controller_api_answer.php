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

        public function familiaImc($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->familiaIMC();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }

        public function sexoImc($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->sexoIMC();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
        public function centroImc($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->centroIMC();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
        //---
        public function familiaIca($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->familiaICA();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
        public function centroIca($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->centroICA();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }

        public function sexoIcc($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->sexoICC();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }

        public function familiaImcp($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->familiaIMCP();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
        public function grasaImc($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->grasaIMC();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
        public function dietaImc($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->dietaIMC();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
 
        public function dietaIca($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->dietaICA();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }

        public function dietaIcc($cod = null){
            $participanteModel= new ParticipanteModel();
            $resultado = $participanteModel->dietaICC();
            header("Content-Type: application/json");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
        public function extraerApi(){
            $uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '';
            $scriptPath = $_SERVER['SCRIPT_NAME'] ?? '';

            if ($scriptPath !== '' && strpos($uriPath, $scriptPath) === 0) {
                $resto = substr($uriPath, strlen($scriptPath));
            } else {
                $posIndex = strpos($uriPath, '/index.php');
                $resto = $posIndex !== false ? substr($uriPath, $posIndex + strlen('/index.php')) : $uriPath;
            }

            $resto = trim((string) $resto, '/');
            return $resto === '' ? [] : explode('/', $resto);
        }

        //graficas
      


    }
?>