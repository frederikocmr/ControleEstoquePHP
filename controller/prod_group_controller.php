<?php
 $prodGroupDAO = new ProdGroupDAO();
 $errors = array();


if (isset($_POST['save'])) {
     print_r($prodGroupDAO);exit;
    //saveProdGroup();
     $name = $_POST['name'];
    $description = $_POST['description'];
    
    
    if (isset($name) && isset($description)) {
        
        $id = $prodGroupDAO->insertProdGroup($name,$description );
        
        $saved_comment = '<div class="comment_box">
      		<span class="delete" data-id="' . $id . '" >delete</span>
      		<span class="edit" data-id="' . $id . '">edit</span>
      		<div class="display_name">' . $name . '</div>
      		<div class="comment_text">' . $description . '</div>
      	</div>';
        echo $saved_comment;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}

function saveProdGroup() {
    global $prodGroupDAO, $errors;
    
   
}
