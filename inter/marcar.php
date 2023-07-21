<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
         body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            color: #333333;
        }
    form {
        margin: 20px;
        max-width: 400px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"] {
        width: 99%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #cccccc;
        border-radius: 4px;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus {
        border-color: #0000ff;
        outline: none;
    }

    input[type="submit"] {
        background-color: #0000ff;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .button-container {
        margin: 20px;
        text-align: center;
    }

    .button {
        display: inline-block;
        background-color: #0000ff;
        color: #ffffff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #333333;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
    </style>
<body>

<?php
    require_once('conexao.php');

   $id = $_POST['id'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM horarios where id= :id";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':id',$id, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $horario = $array_retorno['horario'];
   $dia = $array_retorno['dia'];
   $dt = $array_retorno['dt'];
   $tipo = $array_retorno['tipo'];
   $aluno = $array_retorno['aluno'];
   $id = $array_retorno['id'];
   


?>

  <form method="POST" action="crudaluno.php">
  <label for="">Nome aluno</label>
        <input type="text" name="horario" id="" value=<?php echo $horario?> >
  <label for="">Idade</label>                                       
        <input type="text" name="dia" id="" value=<?php echo $dia ?> >
        <input type="hidden" name="id" id="" value=<?php echo $id ?> >
  <label for="">Data de nascimento</label>     
        <input type="text" name="dt" id="" value=<?php echo $dt?> >
  <label for="">Turma</label>                                              
        <input type="text" name="tipo" id="" value=<?php echo $tipo ?> >
  <label for="">Endereço</label>                          
        <input type="text" name="aluno" id="" value=<?php echo $aluno ?> >
        
        <input type="submit" name="update" value="Marcar">
  </form>
</body>
</html>