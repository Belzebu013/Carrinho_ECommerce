<?php
    class Produto{
        private $id= NULL;
        public $nome = NULL;
        public $valor = NULL;
        public $desc = NULL;

        public function __get($atributo){
            return $this->atributo;
        }

        public function __set($atributo, $valor){
            $this->atributo = $valor;
        }

        public function ExibirProdutos(){
            include 'conn.php';
            $query= 'SELECT * FROM `produtos`';
            $prod = $conn->prepare($query);
            $prod->execute();
            if($prod->rowCount()==0){
                echo 'Não há produtos';
            }else{
                while($row=$prod->fetch()){
                    echo $row['nome_prod']." | ".$row['desc_prod']." | R$".number_format($row['valor_prod'],'2',',','.')." | <a href='carrinho.php?add&id= ".$row['id_prod']."'>Comprar</a> <br/>";
                }
            }
        }

        public function exibir(){
            echo 'exibido com sucesso';
        }

        
    }





?>