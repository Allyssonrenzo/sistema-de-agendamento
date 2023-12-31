<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário Responsivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .calendario {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .mes {
            grid-column: 1 / -1;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .dia-semana {
            text-align: center;
            font-weight: bold;
        }

        .dia {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        .dia:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Verificar se um mês e ano foram passados nos parâmetros da URL
        if (isset($_GET['mes']) && isset($_GET['ano'])) {
            // Obter o mês e o ano a partir dos parâmetros da URL
            $mesAtual = intval($_GET['mes']);
            $anoAtual = intval($_GET['ano']);
        } else {
            // Se não foram passados, usar o mês e o ano atuais
            $dataAtual = new DateTime();
            $mesAtual = intval($dataAtual->format('n'));
            $anoAtual = intval($dataAtual->format('Y'));
        }

        // Criar objetos DateTime para o primeiro e o último dia do mês atual
        $primeiroDiaMes = new DateTime("$anoAtual-$mesAtual-01");
        $ultimoDiaMes = new DateTime("$anoAtual-$mesAtual-" . $primeiroDiaMes->format('t'));

        // Obter o nome do mês
        $nomeMes = $primeiroDiaMes->format('F');

        // Definir o link para o mês anterior
        $mesAnterior = $mesAtual - 1;
        $anoAnterior = $anoAtual;
        if ($mesAnterior == 0) {
            $mesAnterior = 12;
            $anoAnterior--;
        }
        $linkMesAnterior = $_SERVER['PHP_SELF'] . '?mes=' . $mesAnterior . '&ano=' . $anoAnterior;

        // Definir o link para o mês seguinte
        $mesSeguinte = $mesAtual + 1;
        $anoSeguinte = $anoAtual;
        if ($mesSeguinte == 13) {
            $mesSeguinte = 1;
            $anoSeguinte++;
        }
        $linkMesSeguinte = $_SERVER['PHP_SELF'] . '?mes=' . $mesSeguinte . '&ano=' . $anoSeguinte;
       
        $agenda = array(
            1 => 'listaalunos.php',
            2 => 'listaalunos.php',
            3 => 'listaalunos.php',
            4 => 'listaalunos.php',
            // Adicionar os demais dias e suas respectivas URLs
            // Exemplo: 3 => 'pagina-do-dia-3.html',
            // ...
        );
        ?>

        <h1>Calendário Responsivo</h1>
        <div class="calendario">
            <div class="mes">
                <a href="<?php echo $linkMesAnterior; ?>"><<</a>
                <?php echo $nomeMes . ' ' . $anoAtual; ?>
                <a href="<?php echo $linkMesSeguinte; ?>">>></a>
            </div>

            <?php
            // Exibir os dias da semana no calendário
            $diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
            foreach ($diasSemana as $diaSemana) {
                echo '<div class="dia-semana">' . $diaSemana . '</div>';
            }

            // Calcular quantas células vazias antes do primeiro dia do mês
            $diasVaziosAntes = $primeiroDiaMes->format('w');

            // Preencher células vazias antes do primeiro dia do mês
            for ($i = 0; $i < $diasVaziosAntes; $i++) {
                echo '<div class="dia"></div>';
            }

            // Preencher os dias do mês com os links para as respectivas páginas
            $dataAtual = clone $primeiroDiaMes;
while ($dataAtual <= $ultimoDiaMes) {
    $dia = intval($dataAtual->format('d'));
    // Verificar se o dia está definido no array de agenda
    if (isset($agenda[$dia])) {
        // Obter a URL da página do dia específico
        $paginaDiaEspecifico = $agenda[$dia];
        // Exibir o link para a página do dia com o parâmetro 'dia' na URL
        echo '<a class="dia" href="' . $paginaDiaEspecifico . '?dia=' . $dia . '">' . $dia . '</a>';
    } else {
        // Exibir célula vazia para os dias não definidos na agenda
        echo '<div class="dia"></div>';
    }
    $dataAtual->modify('+1 day');
}
            
            ?>
        </div>
    </div>
</body>
</html>