<?php
    require_once './model/model_user.php';
    require_once './model/model_participant.php';
    require_once './api/controller_api_answer.php';
    require_once './class/User.php';

    class FormController{
        private function marcarFormularioRellenado($formulario) {
            if (!isset($_SESSION['formularios_rellenados']) || !is_array($_SESSION['formularios_rellenados'])) {
                $_SESSION['formularios_rellenados'] = [];
            }
            $_SESSION['formularios_rellenados'][$formulario] = true;
        }

        private function usuarioActual(){
            if (isset($_SESSION['usuario_obj'])) {
                $usuario = @unserialize($_SESSION['usuario_obj'], ['allowed_classes' => ['User']]);
                if ($usuario instanceof User) {
                    return $usuario;
                }
            }

            return null;
        }

        private function rolActual(){
            $usuario = $this->usuarioActual();
            return $usuario ? (int) $usuario->getRol() : null;
        }

        private function estaLogueado(){
            return $this->usuarioActual() instanceof User;
        }

        private function esAdmin(){
            return $this->rolActual() === 1;
        }

        private function exigirLogin(){
            if (!$this->estaLogueado()) {
                header('Location: ./index.php?action=home');
                exit;
            }
        }

        private function exigirAdmin(){
            if (!$this->esAdmin()) {
                header('Location: ./index.php?action=home');
                exit;
            }
        }

        private function codParticipanteActual(){
            return isset($_SESSION['cod_participante_actual']) ? (int) $_SESSION['cod_participante_actual'] : 0;
        }

        private function exigirParticipanteActivo(){
            if ($this->codParticipanteActual() <= 0) {
                header('Location: ./index.php?action=forms&need_participante=1');
                exit;
            }
        }

        private function calcularHorasEnCama($horaAcostarse, $horaLevantarse){
            $partesAcostarse = explode(':', (string) $horaAcostarse);
            $partesLevantarse = explode(':', (string) $horaLevantarse);
            if (count($partesAcostarse) < 2 || count($partesLevantarse) < 2) {
                return 0.0;
            }

            $minAcostarse = ((int) $partesAcostarse[0] * 60) + (int) $partesAcostarse[1];
            $minLevantarse = ((int) $partesLevantarse[0] * 60) + (int) $partesLevantarse[1];

            if ($minLevantarse <= $minAcostarse) {
                $minLevantarse += 24 * 60;
            }

            return ($minLevantarse - $minAcostarse) / 60;
        }

        private function mapearEscala06a3($valor){
            $valor = max(0, min(6, (int) $valor));
            if ($valor === 0) {
                return 0;
            }
            if ($valor <= 2) {
                return 1;
            }
            if ($valor <= 4) {
                return 2;
            }
            return 3;
        }

        private function calcularPsqiDesdePost(){
            $sue2 = (int) ($_POST['Sue2'] ?? 0);
            $sue4 = (float) ($_POST['Sue4'] ?? 0);
            $sue5a = (int) ($_POST['Sue5a'] ?? 0);
            $sue5b = (int) ($_POST['Sue5b'] ?? 0);
            $sue5c = (int) ($_POST['Sue5c'] ?? 0);
            $sue5d = (int) ($_POST['Sue5d'] ?? 0);
            $sue5e = (int) ($_POST['Sue5e'] ?? 0);
            $sue5f = (int) ($_POST['Sue5f'] ?? 0);
            $sue5g = (int) ($_POST['Sue5g'] ?? 0);
            $sue5h = (int) ($_POST['Sue5h'] ?? 0);
            $sue5i = (int) ($_POST['Sue5i'] ?? 0);
            $sue5j = (int) ($_POST['Sue5j'] ?? 0);
            $sue6 = (int) ($_POST['Sue6'] ?? 0);
            $sue7 = (int) ($_POST['Sue7'] ?? 0);
            $sue8 = (int) ($_POST['Sue8'] ?? 0);
            $sue9 = (int) ($_POST['Sue9'] ?? 0);

            $item1 = max(0, min(3, $sue6));

            $suma2y5a = max(0, min(3, $sue2)) + max(0, min(3, $sue5a));
            $item2 = $this->mapearEscala06a3($suma2y5a);

            if ($sue4 > 7) {
                $item3 = 0;
            } elseif ($sue4 >= 6) {
                $item3 = 1;
            } elseif ($sue4 >= 5) {
                $item3 = 2;
            } else {
                $item3 = 3;
            }

            $horasEnCama = $this->calcularHorasEnCama($_POST['Sue1'] ?? '', $_POST['Sue3'] ?? '');
            $eficiencia = ($horasEnCama > 0) ? (($sue4 / $horasEnCama) * 100) : 0;
            if ($eficiencia > 85) {
                $item4 = 0;
            } elseif ($eficiencia >= 75) {
                $item4 = 1;
            } elseif ($eficiencia >= 65) {
                $item4 = 2;
            } else {
                $item4 = 3;
            }

            $suma5bAj = max(0, min(3, $sue5b))
                + max(0, min(3, $sue5c))
                + max(0, min(3, $sue5d))
                + max(0, min(3, $sue5e))
                + max(0, min(3, $sue5f))
                + max(0, min(3, $sue5g))
                + max(0, min(3, $sue5h))
                + max(0, min(3, $sue5i))
                + max(0, min(3, $sue5j));
            if ($suma5bAj === 0) {
                $item5 = 0;
            } elseif ($suma5bAj <= 9) {
                $item5 = 1;
            } elseif ($suma5bAj <= 18) {
                $item5 = 2;
            } else {
                $item5 = 3;
            }

            $item6 = max(0, min(3, $sue7));

            $suma8y9 = max(0, min(3, $sue8)) + max(0, min(3, $sue9));
            $item7 = $this->mapearEscala06a3($suma8y9);

            $total = $item1 + $item2 + $item3 + $item4 + $item5 + $item6 + $item7;

            return [
                'item1' => $item1,
                'item2' => $item2,
                'item3' => $item3,
                'item4' => $item4,
                'item5' => $item5,
                'item6' => $item6,
                'item7' => $item7,
                'total' => $total,
                'eficiencia' => round($eficiencia, 2)
            ];
        }

        private function calcularPuntuacionAlimentacionDesdePost(){
            $total = 0;
            for ($i = 1; $i <= 14; $i++) {
                $clave = 'Ali' . $i;
                $valor = (int) ($_POST[$clave] ?? 0);
                if ($valor === 1) {
                    $total++;
                }
            }

            return [
                'total' => $total,
                'maximo' => 14
            ];
        }

        public function home(){
            require_once './view/view_home.php';
        }

        public function presentacion(){
            require_once './view/view_presentacion_publica.php';
        }

        public function presentacionesAdmin(){
            $this->exigirAdmin();
            require_once './view/view_presentaciones_admin.php';
        }

        public function login(){
            require_once './view/view_login.php';
        }

        public function logout(){
            $_SESSION = [];
            session_destroy();
            header('Location: ./index.php?action=home');
            exit;
        }

        public function registro(){
            $nombre = $_POST['usuario'] ?? $_GET['usuario'] ?? null;
            $pass = $_POST['pass'] ?? $_GET['pass'] ?? null;

            if ($nombre === null || $pass === null) {
                header('Location: ./index.php?action=login&error=credenciales');
                return;
            }

            $usuarioModel= new UserModel();
            $usuarioEntidad = $usuarioModel->obtenerUsuarioEntidad($nombre, $pass);

            if (!$usuarioEntidad) {
                header('Location: ./index.php?action=login&error=invalidas');
                return;
            }

            $_SESSION['usuario_obj'] = serialize($usuarioEntidad);

            header('Location: ./index.php?action=home');
            exit;
        }
        //funciones del menu, presentacion usa el home de arriba
        public function analisis(){
             $this->exigirLogin();
               $participanteModel = new ParticipanteModel();
               $resumenParticipantes = $participanteModel->obtenerResumenAnalitico();
             require_once './view/view_analitics.php';
        }

        public function forms(){
            $this->exigirLogin();
            require_once './view/view_forms.php';
        }

        public function nuevoParticipanteForms(){
            $this->exigirLogin();
            unset($_SESSION['participante_actual_obj']);
            unset($_SESSION['cod_participante_actual']);
            unset($_SESSION['formularios_rellenados']);
            unset($_SESSION['psqi_result']);
            unset($_SESSION['alimentacion_result']);
            header('Location: ./index.php?action=forms&need_participante=1');
            exit;
        }

        public function insertarParticipante() {
            $this->exigirLogin();

            $cod = isset($_POST['cod_participante']) ? (int) $_POST['cod_participante'] : 0;
            $centro = trim($_POST['centro'] ?? '');
            $familia = trim($_POST['familia'] ?? 'No especificada');
            $edad = isset($_POST['edad']) ? (int) $_POST['edad'] : 0;
            $sexo = trim($_POST['sexo'] ?? '');

            if ($cod <= 0 || $centro === '' || $edad <= 0 || $sexo === '') {
                $destinoError = (($_POST['origen'] ?? '') === 'forms') ? './index.php?action=forms&need_participante=1&error=datos' : './index.php?action=analisis&p_error=datos';
                header('Location: ' . $destinoError);
                exit;
            }

            $participanteModel = new ParticipanteModel();
            $ok = $participanteModel->insertarParticipante($cod, $centro, $familia, $edad, $sexo);

            if ($ok) {
                $participante = new Participant($cod, $centro, $familia, $edad, $sexo);
                $_SESSION['participante_actual_obj'] = serialize($participante);
                $_SESSION['cod_participante_actual'] = $cod;
                $_SESSION['formularios_rellenados'] = [];

                if (($_POST['origen'] ?? '') === 'forms') {
                    header('Location: ./index.php?action=forms&participante_set=1');
                } else {
                    header('Location: ./index.php?action=analisis&p_saved=1');
                }
            } else {
                $destinoError = (($_POST['origen'] ?? '') === 'forms') ? './index.php?action=forms&need_participante=1&error=bd' : './index.php?action=analisis&p_error=bd';
                header('Location: ' . $destinoError);
            }
            exit;
        }

        public function eliminarParticipante() {
            $this->exigirAdmin();

            $cod = isset($_POST['cod_participante']) ? (int) $_POST['cod_participante'] : 0;
            if ($cod <= 0) {
                header('Location: ./index.php?action=analisis&p_error=id');
                exit;
            }

            $participanteModel = new ParticipanteModel();
            $ok = $participanteModel->eliminarParticipante($cod);

            if ($ok) {
                header('Location: ./index.php?action=analisis&p_deleted=1');
            } else {
                header('Location: ./index.php?action=analisis&p_error=delete');
            }
            exit;
        }

        public function usuarios(){
            $this->exigirAdmin();
            $usuarioModel= new UserModel();
            $usuarios = $usuarioModel->mostrarUsuarios();    
            require_once './view/view_users.php';
        }

        public function crearUsuario(){
            $this->exigirAdmin();

            $username = trim($_POST['nuevo_username'] ?? '');
            $password = trim($_POST['nuevo_password'] ?? '');
            $rol = isset($_POST['nuevo_rol']) ? (int) $_POST['nuevo_rol'] : 0;

            if ($username === '' || $password === '' || !in_array($rol, [1, 2], true)) {
                header('Location: ./index.php?action=usuarios&u_error=datos');
                exit;
            }

            $usuarioModel = new UserModel();
            $ok = $usuarioModel->crearUsuario($username, $password, $rol);

            if ($ok) {
                header('Location: ./index.php?action=usuarios&u_saved=1');
            } else {
                header('Location: ./index.php?action=usuarios&u_error=bd');
            }
            exit;
        }

        public function eliminarUsuario(){
            $this->exigirAdmin();

            $idUser = isset($_POST['id_user']) ? (int) $_POST['id_user'] : 0;
            if ($idUser <= 0) {
                header('Location: ./index.php?action=usuarios&u_error=id');
                exit;
            }

            $usuarioModel = new UserModel();
            $ok = $usuarioModel->eliminarUsuario($idUser);

            if ($ok) {
                header('Location: ./index.php?action=usuarios&u_deleted=1');
            } else {
                header('Location: ./index.php?action=usuarios&u_error=delete');
            }
            exit;
        }

        //inserciones forms
        public function insertarActividad() {
            $this->exigirLogin();
            $this->exigirParticipanteActivo();
            $codParticipante = $this->codParticipanteActual();
            $participanteModel= new ParticipanteModel();
            $ok = $participanteModel->insertarActividad(
                $codParticipante,
                $_POST['AcF1'] ?? 0,
                $_POST['AcF2'] ?? 0,
                $_POST['AcF3'] ?? 0,
                $_POST['AcF4'] ?? 0,
                $_POST['AcF5'] ?? 0,
                $_POST['AcF6'] ?? 0,
                $_POST['AcF7'] ?? 0
            );
            if ($ok) {
                $this->marcarFormularioRellenado('actividad');
                header('Location: ./index.php?action=forms&form=actividad&saved=1');
            } else {
                header('Location: ./index.php?action=forms&form=actividad&error=1');
            }
            exit;
        }

        public function insertarAlimentacion() {
            $this->exigirLogin();
              $this->exigirParticipanteActivo();
              $codParticipante = $this->codParticipanteActual();
            $participanteModel= new ParticipanteModel();
            $ok = $participanteModel->insertarAlimentacion(
                  $codParticipante,
                $_POST['Ali1'] ?? 0,
                $_POST['Ali2'] ?? 0,
                 $_POST['Ali3'] ?? 0,
                 $_POST['Ali4'] ?? 0,
                $_POST['Ali5'] ?? 0,
                $_POST['Ali6'] ?? 0,
                $_POST['Ali7'] ?? 0,
                $_POST['Ali8'] ?? 0,
                $_POST['Ali9'] ?? 0,
                $_POST['Ali10'] ?? 0,
                $_POST['Ali11'] ?? 0,
                 $_POST['Ali12'] ?? 0,
                $_POST['Ali13'] ?? 0,
                 $_POST['Ali14'] ?? 0,
            );
            if ($ok) {
                $this->marcarFormularioRellenado('alimentacion');
                $_SESSION['alimentacion_result'] = $this->calcularPuntuacionAlimentacionDesdePost();
                header('Location: ./index.php?action=forms&form=alimentacion&saved=1');
            } else {
                header('Location: ./index.php?action=forms&form=alimentacion&error=1');
            }
            exit;
        }

        public function insertarSuenyo() {
            $this->exigirLogin();
              $this->exigirParticipanteActivo();
              $codParticipante = $this->codParticipanteActual();
            $participanteModel= new ParticipanteModel();

            $ok = $participanteModel->insertarSuenyo(           
                  $codParticipante,
                $_POST['Sue1'] ?? 0,
                $_POST['Sue2'] ?? 0,
                 $_POST['Sue3'] ?? 0,
                $_POST['Sue4'] ?? 0,
               $_POST['Sue5a'] ?? 0,
                 $_POST['Sue5b'] ?? 0,
                $_POST['Sue5c'] ?? 0,
                $_POST['Sue5d'] ?? 0,
                 $_POST['Sue5e'] ?? 0,
                 $_POST['Sue5f'] ?? 0,
               $_POST['Sue5g'] ?? 0,
                 $_POST['Sue5h'] ?? 0,
                 $_POST['Sue5i'] ?? 0,
                 $_POST['Sue5j'] ?? 0,
               $_POST['Sue5j_Desc'] ?? null,
               $_POST['Sue6'] ?? 0,
            $_POST['Sue7'] ?? 0,
               $_POST['Sue8'] ?? 0,
               $_POST['Sue9'] ?? 0,
              $_POST['Sue10'] ?? 0,
            );
            if ($ok) {
                $this->marcarFormularioRellenado('sueno');
                $_SESSION['psqi_result'] = $this->calcularPsqiDesdePost();
                header('Location: ./index.php?action=forms&form=sueno&saved=1');
            } else {
                header('Location: ./index.php?action=forms&form=sueno&error=1');
            }
            exit;
        }

        public function insertarAntropometrico() {
            $this->exigirLogin();
              $this->exigirParticipanteActivo();
              $codParticipante = $this->codParticipanteActual();
            $participanteModel= new ParticipanteModel();
            $ok = $participanteModel->insertarAntropometrico(
                           
                  $codParticipante,
                 $_POST['Ant1'] ?? 0, 
                 $_POST['Ant2'] ?? 0,
               $_POST['Ant3'] ?? 0,
                 $_POST['Ant4'] ?? null,
                $_POST['Ant5'] ?? 0,
                 $_POST['Ant6'] ?? 0,
               $_POST['Ant7'] ?? 0,
                $_POST['Ant8'] ?? 0,
               $_POST['Ant9'] ?? 0,
                $_POST['Ant10'] ?? 0,
                $_POST['Ant11'] ?? 0,
                 $_POST['Ant12'] ?? 0,
                 $_POST['Ant13'] ?? 0,
                 $_POST['Ant14'] ?? 0,
                $_POST['Ant15'] ?? 0,
                 $_POST['Ant16'] ?? 0,
                 $_POST['Ant17'] ?? 0,
               $_POST['Ant18_BD'] ?? 0,
                 $_POST['Ant18_BI'] ?? 0,
                 $_POST['Ant18_PD'] ?? 0,
                $_POST['Ant18_PI'] ?? 0,
                $_POST['Ant19_BD'] ?? 0,
                $_POST['Ant19_BI'] ?? 0,
                $_POST['Ant19_PD'] ?? 0,
                $_POST['Ant19_PI'] ?? 0,
                $_POST['Ant20'] ?? 0,
                $_POST['Ant21'] ?? null,
            );
            if ($ok) {
                $this->marcarFormularioRellenado('antropometrico');
                header('Location: ./index.php?action=forms&form=antropometrico&saved=1');
            } else {
                header('Location: ./index.php?action=forms&form=antropometrico&error=1');
            }
            exit;
        }

    }

?>