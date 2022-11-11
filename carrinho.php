<h1>Carrinho</h1>
<?php
    require 'conn.php';
    session_start();

    //cria uma sessao com o id do produto vindo do index

    if(isset($_GET['add'])){
        $id=$_GET['id'];
        if(!isset($_SESSION['carrinho'][$id])){
            $_SESSION['carrinho'][$id]=1;
        }else{
            $_SESSION['carrinho'][$id]+=1;
        }
    }

    //Deletar do carrinho

    if(isset($_GET['del'])){
        $id=$_GET['id'];
        unset($_SESSION['carrinho'][$id]);
    }

    //Algoritimo para realizar a atualização do carrinho

    if(isset($_POST['up'])){
        $id=$_POST['id'];
        $qtd=$_POST['qtd'];
        $_SESSION['carrinho'][$id]=$qtd;
    }

    //algoritimo do carrinho

    if($_SESSION['carrinho']==NULL){
        echo "Carrinho vazio";
    }else{
            foreach($_SESSION['carrinho'] as $id=>$qtd){

                //$query='SELECT * FROM produtos WHERE id_prod = ?';

                $cons = $conn->prepare('SELECT * FROM produtos WHERE id_prod = ?');
                $cons -> bindValue(1, $id);
                $cons->execute(); 
                $rowCons=$cons->fetch();
                echo "<form action='carrinho.php' method='POST'>";
                echo $rowCons['nome_prod']." | R$ ".number_format($rowCons['valor_prod'],'2',',','.')." | 
                
                <input type='number' name='qtd' min='1' value='".$qtd."'>
                <input type='hidden' name='id' value='".$rowCons['id_prod']."'>
                <input type='submit' name='up' value='Atualizar'>
                
                | 
                Subtotal: R$ ".number_format($rowCons['valor_prod']*$qtd,'2',',','.')." | <a href='carrinho.php?del&id=".$rowCons['id_prod']."'>Remover</a>"."</form> <br/>";
                
                //Criar Total da compra

                @$total+=$rowCons['valor_prod']*$qtd;
            }
            //exibir total
            echo "Total: ".number_format($total,'2',',','.');
    }

 
?>
<br/>

<a href="index.php">Produtos</a>
