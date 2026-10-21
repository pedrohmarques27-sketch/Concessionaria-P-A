<?php
include('conexao.php');

//CADASTRAR CARRO
if (isset($_POST['submit'])) {

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano_fabricacao = $_POST['anoFabricacao'];
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];
    $quilometragem = $_POST['quilometragem'];
    $preco = $_POST['preco'];
    $situacao = $_POST['situacao'];

    $sql = "INSERT INTO carros
            (Marca, Modelo, ano_fabricacao, Cor, Placa, Quilometragem, Preco, Situacao)
            VALUES
            ('$marca', '$modelo', '$ano_fabricacao', '$cor', '$placa', '$quilometragem', '$preco', '$situacao')";

    $result = mysqli_query($conexao, $sql);
    if ($result) {
        echo "Carro cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}

/* VOLTAR*/
if (isset($_POST["voltar"])) {
    $id = $_POST["IdCarro"];
    if ($id == "") {
        $sql = "SELECT * FROM carros ORDER BY IdCarro DESC LIMIT 1";
    } else {
        $sql = "SELECT * FROM carros WHERE IdCarro < $id ORDER BY IdCarro DESC LIMIT 1";
    }
    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {
        $carro = $resultado->fetch_assoc();
        $IdCarro = $carro["IdCarro"];
        $marca = $carro["Marca"];
        $modelo = $carro["Modelo"];
        $ano_fabricacao = $carro["ano_fabricacao"];
        $cor = $carro["Cor"];
        $placa = $carro["Placa"];
        $quilometragem = $carro["Quilometragem"];
        $preco = $carro["Preco"];
        $situacao = $carro["Situacao"];
    } else {
        echo "Não existe Carro anterior.";
    }
}
/* PRIMEIRO ACESSO */
if (!isset($IdCarro)) {
    $IdCarro = "";
    $marca = "";
    $modelo = "";
    $ano_fabricacao = "";
    $cor = "";
    $placa = "";
    $quilometragem = "";
    $preco = "";
    $situacao = "";
}

/* EXCLUIR */

if (isset($_POST["excluir"])) {
    $id = $_POST["IdCarro"];

    if ($id != "") {
        $sql = "DELETE FROM carros WHERE IdCarro = $id";

        $resultado = $conexao->query($sql);

        if ($resultado) {
            echo "Carro excluído com sucesso!";

            $IdCarro = "";
            $marca = "";
            $modelo = "";
            $ano_fabricacao = "";
            $cor = "";
            $placa = "";
            $quilometragem = "";
            $preco = "";
            $situacao = "";
        } else {
            echo "Erro ao excluir Carro: " . $conexao->error;
        }
    } else {

        echo "Nenhum Carro selecionado para excluir.";
    }
}

/* ALTERAR */
if (isset($_POST["alterar"])) {
    /*Esse ID vem do INPUT */
    $id = $_POST["IdCarro"];

    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $ano_fabricacao = $_POST["anoFabricacao"];
    $cor = $_POST["cor"];
    $placa = $_POST["placa"];
    $quilometragem = $_POST["quilometragem"];
    $preco = $_POST["preco"];
    $situacao = $_POST['situacao'] ?? '';

    if ($id != "") {
        $sql = "UPDATE carros SET
                Marca = '$marca',
                Modelo = '$modelo',
                ano_fabricacao = '$ano_fabricacao',
                Cor = '$cor',
                Placa = '$placa',
                Quilometragem = '$quilometragem',
                Preco = '$preco',
                Situacao = '$situacao'
                WHERE IdCarro = $id";

        $resultado = $conexao->query($sql);

        if ($resultado) {
            echo "Carro alterado com sucesso!";
        } else {
            echo "Erro ao alterar carro: " . $conexao->error;
        }
    } else {
        echo "Nenhum carro selecionado para alterar.";
    }
}

/* CONSULTAR */

if (isset($_POST["consultar"])) {
    $id = $_POST["idconsultar"];
    if ($id != "") {

        $sql = "SELECT * FROM carros WHERE IdCarro = $id";

        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {

            $carro = $resultado->fetch_assoc();

            $IdCarro = $carro["IdCarro"];
            $marca = $carro["Marca"];
            $modelo = $carro["Modelo"];
            $ano_fabricacao = $carro["ano_fabricacao"];
            $cor = $carro["Cor"];
            $placa = $carro["Placa"];
            $quilometragem = $carro["Quilometragem"];
            $preco = $carro["Preco"];
            $situacao = $carro["Situacao"];
        } else {

            echo "Carro não encontrado.";
        }
    } else {

        echo "Informe o ID do Carro.";
    }
}

/*  AVANÇAR */
if (isset($_POST["avancar"])) {
    $id = $_POST["IdCarro"];
    if ($id == "") {



        $sql = "SELECT * FROM carros ORDER BY IdCarro LIMIT 1";
    } else {
        $sql = "SELECT * FROM carros WHERE IdCarro > $id ORDER BY IdCarro LIMIT 1";
    }

    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {
        $carro = $resultado->fetch_assoc();
        $IdCarro = $carro["IdCarro"];
        $marca = $carro["Marca"];
        $modelo = $carro["Modelo"];
        $ano_fabricacao = $carro["ano_fabricacao"];
        $cor = $carro["Cor"];
        $placa = $carro["Placa"];
        $quilometragem = $carro["Quilometragem"];
        $preco = $carro["Preco"];
        $situacao = $carro["Situacao"];
    } else {
        echo "Não existe próximo Carro.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de carro - P&A</title>
    <link rel="stylesheet" href="css/painelCadastro.css">
</head>

<body>
    <!-- Biblioteca de ícones (desenhados em SVG, não precisam de arquivos em assets/) -->
    <svg width="0" height="0" style="position:absolute" aria-hidden="true">
        <symbol id="i-voltar" viewBox="0 0 24 24">
            <path d="M19 12H5M11 6l-6 6 6 6" />
        </symbol>
        <symbol id="i-avancar" viewBox="0 0 24 24">
            <path d="M5 12h14M13 6l6 6-6 6" />
        </symbol>
        <symbol id="i-cadastrar" viewBox="0 0 24 24">
            <circle cx="9" cy="8" r="3.5" />
            <path d="M2.5 20c.6-3.6 3.2-5.5 6.5-5.5s5.9 1.9 6.5 5.5M19 8v6M16 11h6" />
        </symbol>
        <symbol id="i-consultar" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="6.5" />
            <path d="M20 20l-4.2-4.2" />
        </symbol>
        <symbol id="i-alterar" viewBox="0 0 24 24">
            <path d="M4 20l1-4L16.5 4.5a2 2 0 013 3L8 19l-4 1zM14 7l3 3" />
        </symbol>
        <symbol id="i-excluir" viewBox="0 0 24 24">
            <path d="M4 7h16M9 7V4.5h6V7M6.5 7l1 13h9l1-13M10 11v6M14 11v6" />
        </symbol>
        <symbol id="i-limpar" viewBox="0 0 24 24">
            <path d="M4 5v5h5M5.6 14.5A8 8 0 1012 4a8 8 0 00-6.4 3.2L4 10" />
        </symbol>
        <symbol id="i-carro" viewBox="0 0 24 24">
            <path d="M4 16.5v-4L6.2 7.8A2 2 0 018 6.7h8a2 2 0 011.8 1.1L20 12.5v4" />
            <path d="M4 12.5h16M4 16.5h16M6.5 19v-2.5M17.5 19v-2.5" />
            <circle cx="7.8" cy="14.5" r=".5" />
            <circle cx="16.2" cy="14.5" r=".5" />
        </symbol>
        <symbol id="i-marca" viewBox="0 0 24 24">
            <path d="M3 11.5v-7A1.5 1.5 0 014.5 3h7a1.5 1.5 0 011.06.44l8 8a1.5 1.5 0 010 2.12l-7 7a1.5 1.5 0 01-2.12 0l-8-8A1.5 1.5 0 013 11.5z" />
            <circle cx="8" cy="8" r="1.3" />
        </symbol>
        <symbol id="i-modelo" viewBox="0 0 24 24">
            <path d="M12 3l9 5-9 5-9-5 9-5zM3 13l9 5 9-5" />
        </symbol>
        <symbol id="i-calendario" viewBox="0 0 24 24">
            <rect x="3.5" y="5" width="17" height="15" rx="2.5" />
            <path d="M3.5 10h17M8 3v4M16 3v4" />
        </symbol>
        <symbol id="i-cor" viewBox="0 0 24 24">
            <path d="M12 3.5s6 6 6 10.5a6 6 0 01-12 0c0-4.5 6-10.5 6-10.5z" />
        </symbol>
        <symbol id="i-placa" viewBox="0 0 24 24">
            <rect x="2.5" y="7" width="19" height="10" rx="2" />
            <path d="M6 10.5h3M11 10.5h2M15 10.5h3M6 14h12" />
        </symbol>
        <symbol id="i-km" viewBox="0 0 24 24">
            <path d="M4.5 17a8.5 8.5 0 1115 0" />
            <path d="M12 13.5l3.5-4" />
            <circle cx="12" cy="13.5" r="1" />
        </symbol>
        <symbol id="i-situacao" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="9" />
            <path d="M8 12.5l2.7 2.7L16 9.5" />
        </symbol>
    </svg>

    <header>
        <a class="btn-retorno" href="painelAdmin.php">
            <svg class="icone">
                <use href="#i-voltar" />
            </svg>
            <span>Voltar ao painel</span>
        </a>
        <p class="marca">P&A - CARROS E MOTOS</p>
    </header>

    <main>
        <div id="containerGrral">
            <form class="cartao" action="painelCadastroCarro.php" method="post">

                <input type="hidden" name="IdCarro" value="<?php echo $IdCarro; ?>">

                <!-- Lateral: identidade da tela + navegação entre registros -->
                <aside class="lateral">
                    <div class="medalhao"><svg class="icone">
                            <use href="#i-carro" />
                        </svg></div>
                    <h1>Carros</h1>
                    <p>Preencha os dados ao lado e escolha o que fazer com o registro.</p>

                    <div class="navegacao">
                        <button class="btn btn-nav" type="submit" name="voltar">
                            <svg class="icone">
                                <use href="#i-voltar" />
                            </svg>
                            <span>Registro anterior</span>
                        </button>
                        <button class="btn btn-nav" type="submit" name="avancar">
                            <span>Próximo registro</span>
                            <svg class="icone">
                                <use href="#i-avancar" />
                            </svg>
                        </button>
                    </div>
                </aside>

                <!-- Formulário -->
                <div class="formulario">
                    <section class="grupo">
                        <h2>Dados do veículo</h2>
                        <div class="grade">
                            <div class="campos">
                                <label for="marca">Marca</label>
                                <div class="entrada">
                                    <svg class="icone">
                                        <use href="#i-marca" />
                                    </svg>
                                    <input type="text" name="marca" id="marca" placeholder="Honda" value="<?php echo $marca; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="modelo">Modelo</label>
                                <div class="entrada">
                                    <svg class="icone">
                                        <use href="#i-modelo" />
                                    </svg>
                                    <input type="text" name="modelo" id="modelo" placeholder="Civic" value="<?php echo $modelo; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="anoFabricacao">Ano de fabricação</label>
                                <div class="entrada">
                                    <svg class="icone">
                                        <use href="#i-calendario" />
                                    </svg>
                                    <input type="text" name="anoFabricacao" id="anoFabricacao" placeholder="2024" min="1900" value="<?php echo $ano_fabricacao; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="cor">Cor</label>
                                <div class="entrada">
                                    <svg class="icone">
                                        <use href="#i-cor" />
                                    </svg>
                                    <input type="text" name="cor" id="cor" placeholder="Preto" value="<?php echo $cor; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="placa">Placa</label>
                                <div class="entrada">
                                    <svg class="icone">
                                        <use href="#i-placa" />
                                    </svg>
                                    <input type="text" name="placa" id="placa" placeholder="ABC1D23" maxlength="8" autocapitalize="characters" value="<?php echo $placa; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="quilometragem">Quilometragem</label>
                                <div class="entrada">
                                    <svg class="icone">
                                        <use href="#i-km" />
                                    </svg>
                                    <input type="number" name="quilometragem" id="quilometragem" placeholder="45000" min="0" value="<?php echo $quilometragem; ?>">
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="grupo">
                        <h2>Venda</h2>
                        <div class="grade">
                            <div class="campos">
                                <label for="preco">Preço</label>
                                <div class="entrada">
                                    <span class="prefixo">R$</span>
                                    <input type="number" name="preco" id="preco" placeholder="0,00" min="0" step="0.01" value="<?php echo $preco; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="situacao">Situação do veículo</label>
                                <div class="entrada">
                                    <svg class="icone">
                                        <use href="#i-situacao" />
                                    </svg>
                                    <select name="situacao" id="situacao">
                                        <option selected disabled>Selecione a situação</option>
                                        <option <?php if ($situacao == "Dispinível") {
                                                    echo "selected";
                                                } ?> value="Dispinível">Disponível</option>
                                        <option <?php if ($situacao == "Vendido") {
                                                    echo "selected";
                                                } ?> value="vendido">Vendido</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="grupo">
                        <h2>Consultas</h2>
                        <div class="campos">
                            <label for="consulta">Consultar</label>
                            <div class="entrada">
                                <svg class="icone">
                                    <use href="#i-usuario" />
                                </svg>
                                <input type="number" name="idconsultar" placeholder="Informe o ID para consultar" id="consultar">
                            </div>
                        </div>
                    </section>

                    <div class="acoes">
                        <button class="btn btn-principal" type="submit" name="submit" value="Cadastrar">
                            <svg class="icone">
                                <use href="#i-cadastrar" />
                            </svg>
                            <span>Cadastrar</span>
                        </button>
                        <button class="btn btn-secundario" type="submit" name="consultar">
                            <svg class="icone">
                                <use href="#i-consultar" />
                            </svg>
                            <span>Consultar</span>
                        </button>
                        <button class="btn btn-secundario" type="submit" name="alterar">
                            <svg class="icone">
                                <use href="#i-alterar" />
                            </svg>
                            <span>Alterar</span>
                        </button>
                        <button class="btn btn-secundario btn-perigo" type="submit" name="excluir">
                            <svg class="icone">
                                <use href="#i-excluir" />
                            </svg>
                            <span>Excluir</span>
                        </button>
                        <button class="btn btn-secundario" type="reset">
                            <svg class="icone">
                                <use href="#i-limpar" />
                            </svg>
                            <span>Limpar</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </main>
</body>

</html>