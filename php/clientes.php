<?php
require_once 'config.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'list':
            $stmt = $db->query("SELECT * FROM Clientes ORDER BY Fecha_Registro DESC");
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'clientes' => $clientes]);
            break;
            
        case 'add':
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $db->prepare("INSERT INTO Clientes (Nombre, Telefono, Correo, Direccion) VALUES (?, ?, ?, ?)");
            $stmt->execute([$data['nombre'], $data['telefono'], $data['correo'], $data['direccion']]);
            echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
            break;
            
        case 'update':
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $db->prepare("UPDATE Clientes SET Nombre = ?, Telefono = ?, Correo = ?, Direccion = ? WHERE id_cliente = ?");
            $stmt->execute([$data['nombre'], $data['telefono'], $data['correo'], $data['direccion'], $data['id']]);
            echo json_encode(['success' => true]);
            break;
            
        case 'delete':
            $id = $_GET['id'];
            $stmt = $db->prepare("DELETE FROM Clientes WHERE id_cliente = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true]);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>