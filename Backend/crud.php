<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require_once "config.php";  // Archivo donde configuras la conexión a la base de datos

class AuthService
{
    private $db;

    public function __construct()
    {
        $dbConfig = new DbConfig();
        $this->db = $dbConfig->getConnection();
    }

    public function eliminarArticulo($codigo)
    {
        try {
            if (!is_numeric($codigo)) {
                throw new Exception("Código inválido");
            }

            $sql = "DELETE FROM productos WHERE codigo = :codigo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['resultado' => 'OK', 'mensaje' => 'Artículo eliminado'];
            } else {
                throw new Exception("Error al eliminar el artículo");
            }
        } catch (Exception $e) {
            return ['resultado' => 'ERROR', 'mensaje' => $e->getMessage()];
        }
    }

    public function obtenerTodos()
    {
        try {
            $sql = "SELECT * FROM productos";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (Exception $e) {
            return ['resultado' => 'ERROR', 'mensaje' => $e->getMessage()];
        }
    }

    public function agregarArticulo($descripcion, $precio)
    {
        try {
            $sql = "INSERT INTO productos (descripcion, precio) VALUES (:descripcion, :precio)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);

            if ($stmt->execute()) {
                return ['resultado' => 'OK', 'mensaje' => 'Artículo agregado'];
            } else {
                throw new Exception("Error al agregar el artículo");
            }
        } catch (Exception $e) {
            return ['resultado' => 'ERROR', 'mensaje' => $e->getMessage()];
        }
    }

    public function actualizarArticulo($codigo, $descripcion, $precio)
    {
        try {
            $sql = "UPDATE productos SET descripcion = :descripcion, precio = :precio WHERE codigo = :codigo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['resultado' => 'OK', 'mensaje' => 'Artículo actualizado'];
            } else {
                throw new Exception("Error al actualizar el artículo");
            }
        } catch (Exception $e) {
            return ['resultado' => 'ERROR', 'mensaje' => $e->getMessage()];
        }
    }

    public function seleccionarArticulo($codigo)
    {
        try {
            $sql = "SELECT * FROM productos WHERE codigo = :codigo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            return ['resultado' => 'ERROR', 'mensaje' => $e->getMessage()];
        }
    }

    public function login($email, $password) {
        $query = "SELECT id, password FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            if (password_verify($password, $result['password'])) {
                return ['status' => 'success', 'user_id' => $result['id']];
            }
        }
        return ['status' => 'error', 'message' => 'Credenciales incorrectas'];
    }

    public function register($username, $email, $password)
    {
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            return ['status' => 'error', 'message' => 'El email ya está registrado'];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Usuario registrado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al registrar el usuario'];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authService = new AuthService();
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['action']) && $data['action'] === 'register') {
        if (isset($data['username']) && isset($data['email']) && isset($data['password'])) {
            $response = $authService->register($data['username'], $data['email'], $data['password']);
            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos para registrar']);
        }
    } else {
        if (isset($data['email']) && isset($data['password'])) {
            $response = $authService->login($data['email'], $data['password']);
            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos para login']);
        }
    }
    $articulo = new AuthService();
    $response = [];

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];
            $response = $articulo->seleccionarArticulo($codigo);
        } else {
            $response = $articulo->obtenerTodos();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['accion'])) {
            switch ($data['accion']) {
                case 'alta':
                    $response = $articulo->agregarArticulo($data['descripcion'], $data['precio']);
                    break;
                case 'modificacion':
                    $response = $articulo->actualizarArticulo($data['codigo'], $data['descripcion'], $data['precio']);
                    break;
                case 'baja':
                    $response = $articulo->eliminarArticulo($data['codigo']);
                    break;
                case 'login': // Nuevo caso para el login
                    if (isset($data['username']) && isset($data['password'])) {
                        $response = $articulo->login($data['username'], $data['password']);
                    } else {
                        $response = ['success' => false, 'message' => 'Faltan datos de inicio de sesión'];
                    }
                    break;
                case 'listarProductos':
                    $response = $articulo->obtenerTodos();
                    break;
                default:
                    $response = ['resultado' => 'ERROR', 'mensaje' => 'Acción no válida'];
            }
        } else {
            $response = ['resultado' => 'ERROR', 'mensaje' => 'Acción no especificada'];
        }
    }

    echo json_encode($response);
    
}


?>