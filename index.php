<h1>Produtos</h1>
<?php
    require 'conn.php';
    $query= 'SELECT * FROM `produtos`';
    $prod = $conn->prepare($query);
    $prod->execute();
    if(!isset($_GET['carrinho'])){
        $_SESSION['carrinho']=array();
    }


    if($prod->rowCount()==0){
        echo 'Não há produtos';
    }else{
        while($row=$prod->fetch()){
            echo $row['nome_prod']." | ".$row['desc_prod']." | R$".number_format($row['valor_prod'],'2',',','.')." | <a href='carrinho.php?add&id=".$row['id_prod']."'>Comprar</a> <br/>";
            
        }
    }

?>

<br/><br/>
<a href="carrinho.php">Carrinho</a>