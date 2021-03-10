<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Notes</title>
       
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="bg-dark text-light">
        <header class="p-3 text-center">
            <h2>Your notes</h2>
        </header>
        
        <main>
            <section class="col-10 col-sm-6 mx-auto text-center">
                <form method="post" action="send.php" id="addForm">
                    <div class="form-group my-2">
                        <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="Title..." required>
                    </div>

                    <div class="form-group my-2">
                        <textarea class="form-control" id="content" name="content" rows="4" placeholder="Content..." maxlength="300" required></textarea>
                    </div>
                    
                    <input type='hidden' name='editId' id="editId">
                    <input type='hidden' name='editCreatingDate' id="editCreatingDate" >
                    
                    <div class="row my-3">
                        <input type="submit" id="addBtn" value="Add" name="submit" class="btn btn-outline-primary col-4 col-sm-3 mx-auto mt-2 mb-4">
                        <input type="reset" id="resetBtn" value="Reset" onclick="changeAddBtn()" class="btn btn-outline-secondary col-4 col-sm-3 mx-auto mt-2 mb-4">
                    </div>
                  </form>
                <div>
                    <?php
                        if(isset($_SESSION['sendOK']) && $_SESSION['sendOK'] == true) {
                            echo "<h3>Your note is saved</h3>";
                            unset($_SESSION['sendOK']);
                        }
                        else if(isset($_SESSION['deleteOK']) && $_SESSION['deleteOK'] == true) {
                            echo "<h3>Your note is deleted</h3>";
                            unset($_SESSION['deleteOK']);
                        }
                        else if(isset($_SESSION['editOK']) && $_SESSION['editOK'] == true) {
                            echo "<h3>Your note is edited</h3>";
                            unset($_SESSION['editOK']);
                        }
                    ?>
                </div>
            </section>
            
            <section>
                <?php
                    require_once 'database.php';
                    $db = new Database();
                    if(filter_input(INPUT_POST, "sortOption")) {
                        $category = filter_input(INPUT_POST, "sortOption");
                        $how = filter_input(INPUT_POST, "sortType");
                        $_SESSION['sortOption'] = $category;
                        $_SESSION['sortType'] = $how;
                        $db->getNotes($category, $how);    
                    }
                    else {
                        $db->getNotes("creatingDate", "asc");
                    }   
                ?>
            </section>
            
            <section>
                <a href="history.php" class="text-info"><h4 class="text-center my-4">View change history</h4></a>
            </section>
        </main>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="app.js"></script>
    </body>
</html>
