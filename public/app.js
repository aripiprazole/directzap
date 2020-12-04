const url = window.location.hostname;

console.log(url);

function confirmDelete(self) {
  const form = document.getElementById("form-delete-user");

  form.id = self.getAttribute("data-id");

  $("#deleteModal").modal("show");
}

function loadModal() {
  $('.modal').modal('show')
}

const closeModal = document.querySelector('.close');

closeModal.addEventListener('click', function () {

});

$(document).ready(function () {
  // $('.modal').on('hidden.bs.modal', function () {
  //   window.location.href = "https://" + url + "/admin/dashboard/";
  // });
});


//Background
const backgroundModal = document.querySelector('.bgModal');
backgroundModal.style.background = "#f4f4f4";

const modal = document.querySelector('.modal-dialog');
modal.style.boxShadow = "10px 10px 5px rgba(0, 0, 0, 0.3)"
