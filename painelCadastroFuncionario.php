<?php
include('conexao.php');

//CADASTRAR FUNCIONÁRIO
if (isset($_POST['submit'])) {

    $nomeCompleto = $_POST['nomeCompleto'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];

    $sql = "INSERT INTO funcionarios
            (nome_completo, cpf, Email, Telefone, Cargo, Salario)
            VALUES
            ('$nomeCompleto', '$cpf', '$email', '$telefone', '$cargo', $salario)";

    $result = mysqli_query($conexao, $sql);
    if ($result) {
        echo "funcionario cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}

/* VOLTAR*/
if (isset($_POST["voltar"])) {
  $id = $_POST["idFuncionario"];
  if ($id == "") {
  $sql = "SELECT * FROM funcionarios ORDER BY IdFuncionário DESC LIMIT 1";
  } else {
  $sql = "SELECT * FROM funcionarios WHERE IdFuncionário < $id ORDER BY IdFuncionário DESC LIMIT 1";
   }
$resultado = $conexao->query($sql);
if ($resultado->num_rows > 0) {
    $funcionario =$resultado->fetch_assoc();
    $idFuncionario = $funcionario["IdFuncionário"];
    $nomeCompleto = $funcionario["nome_completo"];
    $cpf = $funcionario["cpf"];
    $email = $funcionario["Email"];
    $telefone = $funcionario["Telefone"];
    $cargo = $funcionario["Cargo"];
    $salario = $funcionario["Salario"];
 } else {
 echo "Não existe Funcionário anterior.";
    }}
/* PRIMEIRO ACESSO */
if (!isset($idFuncionario)) {
    $idFuncionario = "";
    $nomeCompleto = "";
    $cpf = "";
    $email = "";
    $telefone = "";
    $cargo = "";
    $salario = "";
}

/* EXCLUIR */

if (isset($_POST["excluir"])) {
    $id = $_POST["idFuncionario"];

    if ($id != "") {
        $sql = "DELETE FROM funcionarios WHERE IdFuncionário = $id";

        $resultado = $conexao->query($sql);

        if ($resultado) {echo "Funcionário excluído com sucesso!";

            $idFuncionario = "";
            $nomeCompleto = "";
            $cpf = "";
            $email = "";
            $telefone= "";
            $cargo= "";
            $salario= "";
         
        } else {
            echo "Erro ao excluir Funcionário: " . $conexao->error;
        }

    } else {

        echo "Nenhum funcionário selecionado para excluir.";

    }
}

/* ALTERAR */
if (isset($_POST["alterar"])) {
    /*Esse ID vem do INPUT */
    $id = $_POST["idFuncionario"];

    $nomeCompleto = $_POST["nomeCompleto"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cargo = $_POST["cargo"];
    $salario = $_POST["salario"];

    if ($id != "") {
        $sql = "UPDATE funcionarios SET
                nome_completo = '$nomeCompleto',
                cpf = '$cpf',
                email = '$email',
                Telefone = '$telefone',
                Cargo = '$cargo',
                Salario = '$salario'
                WHERE IdFuncionário = $id";

        $resultado = $conexao->query($sql);

        if ($resultado) {
            echo "Funcionário alterado com sucesso!";
        } else {
            echo "Erro ao alterar Funcionário: " . $conexao->error;
        }
    } else {
        echo "Nenhum Funcionário selecionado para alterar.";
    }
}

/* CONSULTAR */

if (isset($_POST["consultar"])) {
    $id = $_POST["idconsultar"];
    if ($id != "") {

        $sql = "SELECT * FROM funcionarios WHERE IdFuncionário = $id";
       
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {

            $funcionario = $resultado->fetch_assoc();

            $idFuncionario = $funcionario["IdFuncionário"];
            $nomeCompleto = $funcionario["nome_completo"];
            $cpf = $funcionario["cpf"];
            $email = $funcionario["Email"];
            $telefone = $funcionario["Telefone"];
            $cargo = $funcionario["Cargo"];
            $salario = $funcionario["Salario"];

        } else {

            echo "Funcionário não encontrado.";

        }

    } else {

        echo "Informe o ID do Funcionário.";

    }
}

/*  AVANÇAR */
if (isset($_POST["avancar"])) {
    $id = $_POST["idFuncionario"];
    if ($id == "") {

       

        $sql = "SELECT * FROM funcionarios ORDER BY IdFuncionário LIMIT 1";
    } else {
    $sql = "SELECT * FROM funcionarios WHERE IdFuncionário > $id ORDER BY IdFuncionário LIMIT 1"; }

    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {

        $funcionario = $resultado->fetch_assoc();

        $idFuncionario = $funcionario["IdFuncionário"];
        $nomeCompleto = $funcionario["nome_completo"];
        $cpf = $funcionario["cpf"];
        $email = $funcionario["Email"];
        $telefone = $funcionario["Telefone"];
        $cargo = $funcionario["Cargo"];
        $salario = $funcionario["Salario"];
       
    } else {
        echo "Não existe próximo Funcionário.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionário - P&A</title>
    <link rel="stylesheet" href="css/painelCadastro.css">
</head>

<body>
    <!-- Biblioteca de ícones (desenhados em SVG, não precisam de arquivos em assets/) -->
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <symbol id="i-voltar" viewBox="0 0 24 24"><path d="M19 12H5M11 6l-6 6 6 6"/></symbol>
        <symbol id="i-avancar" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
        <symbol id="i-equipe" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3.2"/><path d="M3 19c.6-3.3 3-5 6-5s5.4 1.7 6 5"/><circle cx="17" cy="9" r="2.5"/><path d="M16.5 14.2c2.4 0 4 1.3 4.5 4.3"/></symbol>
        <symbol id="i-usuario" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.5"/><path d="M5 20c.7-4 3.6-6 7-6s6.3 2 7 6"/></symbol>
        <symbol id="i-documento" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2.5"/><circle cx="9" cy="11" r="2"/><path d="M6.5 16c.5-1.5 1.5-2 2.5-2s2 .5 2.5 2M14.5 10H18M14.5 14H18"/></symbol>
        <symbol id="i-email" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2.5"/><path d="M3.5 7l8.5 6 8.5-6"/></symbol>
        <symbol id="i-telefone" viewBox="0 0 24 24"><path d="M6 3h3l1.5 4.5-2 1.5a11 11 0 006.5 6.5l1.5-2L21 15v3a2 2 0 01-2 2A16 16 0 014 5a2 2 0 012-2z"/></symbol>
        <symbol id="i-cargo" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2.5"/><path d="M9 7V5a1.5 1.5 0 011.5-1.5h3A1.5 1.5 0 0115 5v2M3 13h18"/></symbol>
        <symbol id="i-cadastrar" viewBox="0 0 24 24"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c.6-3.6 3.2-5.5 6.5-5.5s5.9 1.9 6.5 5.5M19 8v6M16 11h6"/></symbol>
        <symbol id="i-consultar" viewBox="0 0 24 24"><circle cx="11" cy="11" r="6.5"/><path d="M20 20l-4.2-4.2"/></symbol>
        <symbol id="i-alterar" viewBox="0 0 24 24"><path d="M4 20l1-4L16.5 4.5a2 2 0 013 3L8 19l-4 1zM14 7l3 3"/></symbol>
        <symbol id="i-excluir" viewBox="0 0 24 24"><path d="M4 7h16M9 7V4.5h6V7M6.5 7l1 13h9l1-13M10 11v6M14 11v6"/></symbol>
        <symbol id="i-limpar" viewBox="0 0 24 24"><path d="M4 5v5h5M5.6 14.5A8 8 0 1012 4a8 8 0 00-6.4 3.2L4 10"/></symbol>
    </svg>

    <header>
        <a class="btn-retorno" href="painelAdmin.php">
            <svg class="icone"><use href="#i-voltar"/></svg>
            <span>Voltar ao painel</span>
        </a>
        <p class="marca">P&A - CARROS E MOTOS</p>
    </header>

    <main>
        <div id="containerGrral">
            <form class="cartao" action="painelCadastroFuncionario.php" method="post">
            <!--CAMPO INVISIVEL -->
                <input type="hidden" name="idFuncionario" value="<?php echo $idFuncionario; ?>">
                <!-- Lateral: identidade da tela + navegação entre registros -->
                <aside class="lateral">
                    <div class="medalhao"><svg class="icone"><use href="#i-equipe"/></svg></div>
                    <h1>Funcionários</h1>
                    <p>Preencha os dados ao lado e escolha o que fazer com o registro.</p>

                    <div class="navegacao">
                        <button class="btn btn-nav" type="submit" name="voltar">
                            <svg class="icone"><use href="#i-voltar"/></svg>
                            <span>Registro anterior</span>
                        </button>
                        <button class="btn btn-nav" type="submit" name="avancar">
                            <span>Próximo registro</span>
                            <svg class="icone"><use href="#i-avancar"/></svg>
                        </button>
                    </div>
                </aside>

                <!-- Formulário -->
                <div class="formulario">
                    <section class="grupo">
                        <h2>Dados pessoais</h2>
                        <div class="grade">
                            <div class="campos largo">
                                <label for="nomeCompleto">Nome completo</label>
                                <div class="entrada">
                                    <svg class="icone"><use href="#i-usuario"/></svg>
                                    <input type="text" name="nomeCompleto" id="nomeCompleto" placeholder="Informe seu nome completo" autocomplete="name" value="<?php echo $nomeCompleto; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="cpf">CPF</label>
                                <div class="entrada">
                                    <svg class="icone"><use href="#i-documento"/></svg>
                                    <input type="text" name="cpf" id="cpf" placeholder="123.456.789-10" inputmode="numeric" maxlength="14" value="<?php echo $cpf; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="telefone">Telefone</label>
                                <div class="entrada">
                                    <svg class="icone"><use href="#i-telefone"/></svg>
                                    <input type="tel" name="telefone" id="telefone" placeholder="(99) 99999-9999" autocomplete="tel" maxlength="15" value="<?php echo $telefone; ?>">
                                </div>
                            </div>
                            <div class="campos largo">
                                <label for="email">Email</label>
                                <div class="entrada">
                                    <svg class="icone"><use href="#i-email"/></svg>
                                    <input type="email" name="email" id="email" placeholder="seunome@gmail.com" autocomplete="email" value = "<?php echo $email; ?>">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="grupo">
                        <h2>Dados profissionais</h2>
                        <div class="grade">
                            <div class="campos">
                                <label for="cargo">Cargo</label>
                                <div class="entrada">
                                    <svg class="icone"><use href="#i-cargo"/></svg>
                                    <input type="text" name="cargo" id="cargo" placeholder="Scrum Master" value="<?php echo $cargo; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="salario">Salário</label>
                                <div class="entrada">
                                    <span class="prefixo">R$</span>
                                    <input type="number" name="salario" id="salario" placeholder="0,00" min="0" step="0.01" value="<?php echo $salario; ?>">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="grupo">
                        <h2>Consultas</h2>
                            <div class="campos">
                                <label for="consulta">Consultar</label>
                                <div class="entrada">
                                    <svg class="icone"><use href="#i-usuario"/></svg>
                                    <input type="number" name="idconsultar" placeholder="Informe o ID para consultar" id="consultar">
                                </div>
                            </div>
                    </section>
                    <div class="acoes">
                        <button class="btn btn-principal" type="submit" name="submit" value="Cadastrar">
                            <svg class="icone"><use href="#i-cadastrar"/></svg>
                            <span>Cadastrar</span>
                        </button>
                        <button class="btn btn-secundario" type="submit" name="consultar">
                            <svg class="icone"><use href="#i-consultar"/></svg>
                            <span>Consultar</span>
                        </button>
                        <button class="btn btn-secundario" type="submit" name="alterar">
                            <svg class="icone"><use href="#i-alterar"/></svg>
                            <span>Alterar</span>
                        </button>
                        <button class="btn btn-secundario btn-perigo" type="submit" name="excluir">
                            <svg class="icone"><use href="#i-excluir"/></svg>
                            <span>Excluir</span>
                        </button>
                        <button class="btn btn-secundario" type="reset">
                            <svg class="icone"><use href="#i-limpar"/></svg>
                            <span>Limpar</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </main>
    <script src="js/script.js"></script>
</body>

</html>
