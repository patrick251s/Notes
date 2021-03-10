function confirmDelete() {
    return (window.confirm('Are you sure you want to delete this note?'));
}

function editNote(idNumber) {
    document.getElementById('title').value = document.getElementById('title'+idNumber).innerHTML;
    document.getElementById('content').value = document.getElementById('content'+idNumber).innerHTML;
    
    var addBtn = document.getElementById('addBtn');
    var editId = document.getElementById('editId');
    var editCreatingDate = document.getElementById('editCreatingDate');
    
    addBtn.value = 'Edit';
    editId.value = idNumber;
    editCreatingDate.value = document.getElementById('creatingDate'+idNumber).innerHTML.toString();
      
    $('html, body').animate({
      scrollTop: 0
    }, 500);
 
}

function changeAddBtn() {
    var addBtn = document.getElementById('addBtn');
    if(addBtn.value === 'Edit') addBtn.value = 'Add';
}


