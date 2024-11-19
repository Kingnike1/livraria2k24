<?php
require_once "conexao.php";

function contarRegistros($tabela)
{
    global $conexao;

    $sql = "SELECT COUNT(*) AS total FROM $tabela";
    $resultado = mysqli_query($conexao, $sql);

    return $resultado ? mysqli_fetch_assoc($resultado)['total'] : 0;
}

function obterEmprestimosPorLivroMes($ano)
{
    global $conexao;

    $sql = "SELECT livro_idlivro, MONTH(dia_do_emprestimo) AS mes, COUNT(*) AS total_emprestimos
            FROM emprestimo
            WHERE YEAR(dia_do_emprestimo) = $ano
            GROUP BY livro_idlivro, MONTH(dia_do_emprestimo)
            ORDER BY mes ASC, livro_idlivro";

    $resultado = mysqli_query($conexao, $sql);
    $emprestimos = [];

    while ($linha = mysqli_fetch_assoc($resultado)) {
        $emprestimos[$linha['livro_idlivro']][$linha['mes']] = $linha['total_emprestimos'];
    }

    return $emprestimos;
}
?>
