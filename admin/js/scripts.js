$(document).ready(function () {
  // EDITOR CKEDITOR
  ClassicEditor.create(document.querySelector("#body")).catch((error) => {
    console.error(error);
  });

  $("#checkAllBoxes").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });
});

function loadUsersOnline() {
  $.get("functions.php?online_users=result", function (data) {
    $(".users_online").text(data);
  });
}

setInterval(function () {
  loadUsersOnline();
}, 500);
