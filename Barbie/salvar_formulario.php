<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $objetivo = $_POST["objetivo"];
    $organizado = $_POST["organizado"];
    $nota = $_POST["nota"];

    // Conectar ao banco de dados SQLite
    $db = new SQLite3('dados_formulario.db');

    // Criar tabela se não existir
    $query = "CREATE TABLE IF NOT EXISTS formulario (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                objetivo TEXT NOT NULL,
                organizado TEXT NOT NULL,
                nota INTEGER NOT NULL
            )";
    $db->exec($query);

    // Inserir dados na tabela
    $query = "INSERT INTO formulario (objetivo, organizado, nota) VALUES (:objetivo, :organizado, :nota)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':objetivo', $objetivo, SQLITE3_TEXT);
    $stmt->bindParam(':organizado', $organizado, SQLITE3_TEXT);
    $stmt->bindParam(':nota', $nota, SQLITE3_INTEGER);
    $stmt->execute();

    // Fechar a conexão com o banco de dados
    $db->close();

    // Redirecionar para a página index
    header('Location: index.html');
    exit();
}
?>
