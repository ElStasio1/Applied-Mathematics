<?php require 'connect_db.php';?>
    <div class="container">
        <?php
        require "functions.php";
        $name = htmlspecialchars($_POST['name']);
        $descr = htmlspecialchars($_POST['descr']);
        $keywords = htmlspecialchars($_POST['keywords']);
        $category = htmlspecialchars($_POST['category']);

        if (isset($_POST["text"])) {

            $text = htmlspecialchars($_POST["text"]);
            $text_comp = compile_text($text);            
        }
        if(empty($name) || empty($descr) || empty($keywords)){
            header("location: ../page/admin_panel.php?error=emptyfield");
            exit();
        }
        $stmt = $mysql->prepare('INSERT INTO articles (name, descr, text, text_compl, keywords, category, description, comments, data) VALUES (?, ?, ?, ?, ?, ?, ?,?, UTC_TIMESTAMP())');
        if(!$stmt){
            header("location: ../page/admin_panel.php?error=sqlerror");
            exit();
        }
       
        $comm = '0';
        $stmt->bind_param('ssssssss', $name, $descr, $text, $text_comp, $keywords, $category, $descr, $comm);
        $stmt->execute();
        $stmt->close();
      	exit("<meta http-equiv='refresh' content='0; url= /page/admin_panel.php?success'>");
        
        ?>
    </div>
</body>

</html>