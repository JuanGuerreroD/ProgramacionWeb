<?php
/*
 * Class name: firebaseRDB
 * Version: 1.0
 */

class firebaseRDB {
    // Constructor
    function __construct($url = null) {
        if (isset($url)) {
            $this->url = $url;
        } else {
            throw new Exception("Database URL must be specified");
        }
    }

    // Método para hacer solicitudes HTTP
    private function grab($path, $method, $data = null) {
        // Este método debe implementar el código para realizar la solicitud HTTP (GET, POST, DELETE, PATCH, etc.)
    }

    // Método para actualizar datos
    public function update($path, $data) {
        $grab = $this->grab($path, "PATCH", json_encode($data));
        return $grab;
    }

    // Método para eliminar datos
    public function delete($table, $uniqueID) {
        $path = $this->url . "/$table/$uniqueID.json";
        $grab = $this->grab($path, "DELETE");
        return $grab;
    }

    // Método para recuperar datos con parámetros de búsqueda
    public function retrieve($dbPath, $queryKey = null, $queryType = null, $queryVal = null) {
        if (isset($queryType) && isset($queryKey) && isset($queryVal)) {
            $queryVal = urlencode($queryVal);

            if ($queryType == "EQUAL") {
                $pars = "orderBy=\"$queryKey\"&equalTo=\"$queryVal\"";
            } elseif ($queryType == "LIKE") {
                $pars = "orderBy=\"$queryKey\"&startAt=\"$queryVal\"";
            }
        }

        $pars = isset($pars) ? "?$pars" : "";
        $path = $this->url . "/$dbPath.json$pars";
        $grab = $this->grab($path, "GET");

        return $grab;
    }
}
?>
