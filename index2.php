<div>
    <h1>Produtos<h1>
</div>
<?php
    require 'produtos.php';

    $produto = new Produto();
   // print_r($produto);
    $produto->ExibirProdutos();
    $produto->exibir();
   


?>
<br/><br/>
<a href="carrinho.php">Carrinho</a>