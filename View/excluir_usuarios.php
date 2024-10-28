<?php
require_once "../Model/Usuario.php"; 
require_once "../Controller/UsuarioController.php"; 
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login_adm.php'); 
    exit();
}

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->listar(); 

// Excluir usuário
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $usuarioController->excluir($id); 
    header('Location: excluir_usuarios.php'); // Redireciona para a mesma página
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuários</title>
    <style>
        /* Estilos semelhantes aos da tela anterior */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Excluir Usuários</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario->getId()) ?></td>
                        <td><?= htmlspecialchars($usuario->getNome()) ?></td>
                        <td><?= htmlspecialchars($usuario->getEmail()) ?></td>
                        <td>
                            <a href="?delete=<?= $usuario->getId() ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Não há usuários cadastrados.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>