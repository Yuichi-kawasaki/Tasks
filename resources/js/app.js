import './bootstrap';
function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this task?")) {
      var form = document.getElementById('delete-form-' + id);
      var confirmDialog = document.createElement('div');
      confirmDialog.className = 'confirm-dialog';
      confirmDialog.innerHTML = '<h3>Confirm Delete</h3><p>Are you sure you want to delete this task?</p><button type="submit" class="btn my-btn">Delete</button> <button type="button" class="btn my-btn" onclick="cancelDelete()">Cancel</button>';
      form.parentNode.insertBefore(confirmDialog, form.nextSibling);
      form.style.display = 'none';
    }
  }
  
  function cancelDelete() {
    var confirmDialog = document.querySelector('.confirm-dialog');
    var form = confirmDialog.previousSibling;
    confirmDialog.parentNode.removeChild(confirmDialog);
    form.style.display = 'inline';
  }
  