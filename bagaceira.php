<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulação de Parcelamento</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Simulação de Parcelamento</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="preco" class="form-label">Valor Total (R$):</label>
                <input type="number" id="preco" name="preco" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="parcelas" class="form-label">Número de X:</label>
                <select id="parcelas" name="parcelas" class="form-control" required>
                    <!-- Opções de X de 1 a 12 -->
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo "<option value='$i'>$i X</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento:</label>
                <select id="forma_pagamento" name="forma_pagamento" class="form-control">
                    <option value="avista">À vista</option>
                    <option value="cartao">Cartão</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Calcular Parcelas</button>
        </form>

        <?php
            $preco = $_POST["preco"];
            $parcelas = $_POST["parcelas"];
            $forma_pagamento = $_POST["forma_pagamento"];

            $valor_final = $preco;

            if ($forma_pagamento == 'avista') {
                $desconto = 0.05; 
                $valor_final = $preco * (1 - $desconto); 
                echo "<p>Desconto de 5% aplicado. Valor com desconto: R$ " . number_format($valor_final, 2, ',', '.') . "</p>";
            } elseif ($forma_pagamento == 'cartao') {
                if ($parcelas < 5) {
                    $taxa_juros = 7; 
                } else {
                    $taxa_juros = 12;  
                }
                $valor_final = $preco * (1 + $taxa_juros / 100);
                echo "<p>Valor com juros de {$taxa_juros}%: R$ " . number_format($valor_final, 2, ',', '.') . "</p>";
            }

            if ($parcelas > 0) {
                $valor_parcela = $valor_final / $parcelas;
                echo "<p>Valor das parcelas: R$ " . number_format($valor_parcela, 2, ',', '.') . "</p>";
            } 
        
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
