<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

require("./config.php");

try {
    // Crear instancia de la conexión usando la clase DbConfig
    $db = new DbConfig();
    $conn = $db->getConnection();

    // Preparar y ejecutar la consulta con PDO
    $stmt = $conn->prepare("SELECT codigo, descripcion, precio FROM productos");
    $stmt->execute();
    
    // Obtener los resultados como un array asociativo
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convertir a JSON y devolverlo
    echo json_encode($productos);
    
} catch (PDOException $e) {
    echo json_encode(["error" => "Error en la consulta: " . $e->getMessage()]);
}
?>
