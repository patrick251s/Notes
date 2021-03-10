<?php

class database {
    private $mysqli; 

    public function __construct() {
        $this->mysqli = new mysqli('localhost', 'root', '', 'project_notes');

        if($this->mysqli->connect_errno)
        {
            printf("Connecting error! %s\n", $this->mysqli->connect_errno);
            exit();
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }
    
    function sendNote() {
        if(filter_input(INPUT_POST, "title")) {
            $title = $this->mysqli->real_escape_string(filter_input(INPUT_POST, "title"));
            $content = $this->mysqli->real_escape_string(filter_input(INPUT_POST, "content"));
            $date = date("Y-m-d H:i:s");  
            
            if($this->mysqli->query("INSERT INTO notes VALUES(NULL, '$title', '$content', '$date', NULL, NULL, NULL, NULL)"))
            {
                $_SESSION['sendOK'] = true;
                header('Location: index.php');
            }   
            else {
                echo "Error<br/>";
                echo "$title<br/>$content<br/>$date<br/>";
            }
        }
    }
    
    function getNotes($category, $how) {
        $result = $this->mysqli->query("SELECT * FROM notes WHERE isDeleted IS NULL AND hasChild IS NULL ORDER BY $category $how"); 
        if($result->num_rows == 0) {
            echo "<div class='text-warning text-center'>You don't have any notes!</div>";
        }
        else {
            $this->arrangeSortInput();
            $this->arrangeNotes($result);
        }
    }
    
    function arrangeNotes($result) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-10 col-sm-6 mx-auto bgNote text-dark border border-primary border-3 my-3'>".
                         "<div class='row mb-3'>".
                            "<div class='col-10 mt-3'><h5><div id='title".$row['id']."'>".$row['title']."</div></h5></div>".     
                                '<div class="col-2 mt-3 d-flex justify-content-end">'.
                                    '<button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample'.$row['id'].'" aria-expanded="false" aria-controls="collapseExample">↓</button>'.
                                '</div>'.
                            "</div>";
                
                    echo '<div class="collapse bgNote" id="collapseExample'.$row['id'].'">'.
                            '<div class=" bgNote">'.
                                "<p><div id='content".$row['id']."'>".$row['content']."</div></p>".
                                    "<p><div class='row'>";
                                        if($row['modifyDate'] == null) {
                                            echo "<div class='col-2'>Created: </div><div class='col-10' id='creatingDate".$row['id']."'>".$row['creatingDate']."</div>";
                                        }
                                        else {
                                            echo "<div class='col-2'>Created: </div><div class='col-10' id='creatingDate".$row['id']."'>".$row['creatingDate']."</div>";
                                            echo "<div class='col-2'>Modified: </div><div class='col-10' id='modifyDate".$row['id']."'>".$row['modifyDate']."</div>";
                                        }
                               echo "</div></p>";
                            echo "<div class='row my-2 text-center'>".
                                    "<form class='col-6 mx-auto' method='post' action='send.php' onsubmit='return confirmDelete()'>".
                                        "<input type='hidden' name='id' value='".$row['id']."'>".
                                        "<input type='submit' value='Delete' name='submit' class='col-6 btn btn-sm btn-danger'>".
                                    "</form>".
                                    "<form class='col-6 mx-auto'>".           
                                        "<input type='button' id='edit".$row['id']."' value='Edit' onclick='editNote(".$row['id'].")' class='col-6 btn btn-sm btn-info'>".
                                    "</form>".
                                "</div>".
                            "</div>".
                          "</div>".
                    "</div>";  
            }     
    }
    
    function deleteNote() {
        if(filter_input(INPUT_POST, "id")) {
            $id = filter_input(INPUT_POST, "id");
            if($this->mysqli->query("UPDATE notes SET isDeleted = TRUE WHERE id = '$id'"))
            {
                $_SESSION['deleteOK'] = true;
                header('Location: index.php');
            }   
            else {
                echo "\nError";
            }
        }
    }
    
    function editNote() {
        if(filter_input(INPUT_POST, 'submit')) {
            $title = $this->mysqli->real_escape_string(filter_input(INPUT_POST, "title"));
            $content = $this->mysqli->real_escape_string(filter_input(INPUT_POST, "content"));
            $date = date("Y-m-d H:i:s");
            $editId = filter_input(INPUT_POST, "editId");
            $editCreatingDate = filter_input(INPUT_POST, "editCreatingDate");
            echo "$title<br/>$content<br/>$date<br/>$editId<br/>$editCreatingDate";
                        
            if(($this->mysqli->query("INSERT INTO notes VALUES(NULL, '$title', '$content', '$editCreatingDate', '$date', NULL, NULL, '$editId')"))
            && ($this->mysqli->query("UPDATE notes SET hasChild = TRUE WHERE id = '$editId'"))) {
                $_SESSION['editOK'] = true;
                unset($_SESSION['sortOption']);
                unset($_SESSION['sortType']);
                header('Location: index.php');  
            }   
            else {
                echo "\nError";
            }
        }
    }
    
    function arrangeSortInput() {
        echo "<form method='post' action='index.php' class='col-10 col-sm-6 mx-auto mt-3 mb-4'>".
                '<div class="row">'.
                    '<div class="form-group col-md-4">'.
                        '<label for="sortOption">Sort by:</label>'.
                        '<select class="form-control" id="sortOption" name="sortOption">'.
                          '<option value="creatingDate"';
                            if(isset($_SESSION['sortOption']) && ($_SESSION['sortOption'])=='creatingDate'){echo " selected";}
                      echo '>Creation date</option>'.
                          '<option value="modifyDate"';
                      if(isset($_SESSION['sortOption']) && ($_SESSION['sortOption'])=='modifyDate'){echo " selected";}
                      echo '>Modification date</option>'.
                          '<option value="title"';
                              if(isset($_SESSION['sortOption']) && ($_SESSION['sortOption'])=='title'){echo " selected";}
                      echo '>Title</option>'.
                          '<option value="content"';
                              if(isset($_SESSION['sortOption']) && ($_SESSION['sortOption'])=='content'){echo " selected";}
                      echo '>Content</option>'.
                        '</select>'.
                    '</div>'.
                    '<div class="col-md-4 my-auto">'.
                        '<div class="form-check my-1">'.
                            '<input class="form-check-input" type="radio" name="sortType" id="asc" value="asc" checked>'.
                            '<label class="form-check-label" for="asc">Ascending</label>'.
                        '</div>'.
                        '<div class="form-check my-1">'.
                            '<input class="form-check-input" type="radio" name="sortType" id="desc" value="desc"';
                            if(isset($_SESSION['sortType']) && $_SESSION['sortType']=='desc') {echo " checked";}
                      echo '>'.
                            '<label class="form-check-label" for="desc">Descending</label>'.
                        '</div>'.
                    '</div>'.
                    '<div class="col-md-4 my-auto">'.
                        '<button type="submit" name="submit" value="Sort" class="btn btn-success col-sm-8">Sort</button>'.
                    '</div>'.
                '</div>'.
              '</form>';         
    }
    
    function getHistory() {
        $result = $this->mysqli->query("SELECT * FROM notes WHERE hasChild IS NULL AND parent IS NOT NULL"); 
        if($result->num_rows == 0) {
            echo "<div class='text-warning text-center'>You don't have any notes!</div>";
        }
        else {
            $this->arrangeNotesHistory($result);
        }
        
        $result = $this->mysqli->query("SELECT * FROM notes WHERE hasChild IS NULL AND parent IS NULL");
        if($result->num_rows != 0) {
            $this->arrangeNotesHistory($result);
        }
    }
    
    function arrangeNotesHistory($result) {
        //Fetch this notes which don't have children and have parent.
        while($row = $result->fetch_assoc()) {
                echo "<div class='col-10 col-sm-6 mx-auto bgNote text-dark border border-primary border-3 my-3'>".
                         "<div class='row mb-3'>".
                            "<div class='col-10 mt-3'><h5><div id='title".$row['id']."'>".$row['title']."</div></h5></div>".     
                                '<div class="col-2 mt-3 d-flex justify-content-end">'.
                                    '<button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample'.$row['id'].'" aria-expanded="false" aria-controls="collapseExample">↓</button>'.
                                '</div>'.
                            "</div>";
                
                    echo '<div class="collapse bgNote" id="collapseExample'.$row['id'].'">'.
                            '<div class=" bgNote">';
                            if($row['isDeleted']==true) {echo "<p>(Deleted)</p>";}
                                echo "<p><div id='content".$row['id']."'>".$row['content']."</div></p>".
                                    "<p><div class='row'>";
                                        if($row['modifyDate'] == null) {
                                            echo "<div class='col-2'>Created: </div><div class='col-10' id='creatingDate".$row['id']."'>".$row['creatingDate']."</div>";
                                        }
                                        else {
                                            echo "<div class='col-2'>Created: </div><div class='col-10' id='creatingDate".$row['id']."'>".$row['creatingDate']."</div>";
                                            echo "<div class='col-2'>Modified: </div><div class='col-10' id='modifyDate".$row['id']."'>".$row['modifyDate']."</div>";
                                        }
                               echo "</div></p>".
                            "</div>".
                          "</div>".
                    "</div>";  
                if($row['parent'] !== NULL) {
                    $this->getParentNote($row['parent']);
                }
                else {
                    echo '<div class="py-3"></div>';
                }
            }     
    }
    
    function getParentNote($parentId) {
        $result = $this->mysqli->query("SELECT * FROM notes WHERE id = '$parentId'"); 
        if($result->num_rows == 0) {
            return false;
        }
        else {
            $this->arrangeNotesHistory($result);
        }
    }
    
}
