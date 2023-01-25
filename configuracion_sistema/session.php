<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of session
 *
 * @author CHRISTOPHER
 */
class session {
    public $SESSION_ID;
    public $ALCANCE = "NOIDENTIFICADO";

    function __construct($nombre) {
        $this->ALCANCE = $nombre;
        $this->SESSION_ID = session_id();
    }

    public function getSession() {
        return $this->SESSION_ID;
    }

    public function getValueSession($name, $type = false) {
        $retorna = "";
        $bool_pasa = false;
        $bool_pasa_a = false;
        if (is_array($name)) {
            $idname = ($name);
            $bool_pasa = true;
            $bool_pasa_a = false;
        } else {
            $idname = trim($name . "");
            if ($idname <> "") {
                $bool_pasa = true;
            }
            $bool_pasa_a = isset($_SESSION[$this->ALCANCE][$idname]);
        }
        if ($bool_pasa and $bool_pasa_a) {
            $retorna = $_SESSION[$this->ALCANCE][$idname];
        } else {
            if (!$type) {
                $retorna = "";
            } else {
                $retorna = false;
            }
        }
        return $retorna;
    }

    public function setValueSession($name, $value) {
        $idname = trim($name);
        if ($idname <> "") {
            $_SESSION[$this->ALCANCE][$idname] = $value;
        }
    }

    public function unsetSession($name) {
        $idname = trim($name);
        if ($idname <> "" and isset($_SESSION[$this->ALCANCE][$idname])) {
            unset($_SESSION[$this->ALCANCE][$idname]);
        }
    }

    public function getAll($type = false) {
        if (isset($_SESSION[$this->ALCANCE])) {
            return $_SESSION[$this->ALCANCE];
        } else {
            if (!$type) {
                return "";
            } else {
                return false;
            }
        }
    }

    public function setValueItemSession($name, $item, $value) {
        $idname = trim($name);
        $idiname = trim($item);
        if ($idname <> "" && $idiname <> "") {
            if (!isset($_SESSION[$this->ALCANCE][$name])) {
                $_SESSION[$this->ALCANCE][$name] = array();
            }
            $_SESSION[$this->ALCANCE][$idname][$item] = $value;
        }
    }

    public function setAll($_SESSION_AUX) {
        if (isset($_SESSION[$this->ALCANCE])) {
            $_SESSION[$this->ALCANCE] = $_SESSION_AUX;
        }
    }

}
