$(document).ready(function () {
  $(".select2").select2({});
});

function checkDuplicateValue(value, Array) {
  let dem = 0;
  while (dem < Array.length) {
    if (value == Array[dem]) return true;
    dem++;
  }

  return false;
}
function addIsVail(input) {
  input.classList.remove("is-invalid");
  input.classList.add("is-valid");
}

function addIsInVail(input) {
  input.classList.add("is-invalid");
  input.classList.remove("is-valid");
}
function removeAll(input) {
  input.classList.remove("is-invalid");
  input.classList.remove("is-valid");
}

function checkInputValue(Array, idOfInput, idOfErr, checkDuplicate) {
  var input = document.getElementById(idOfInput);
  var feedback_err = document.getElementById(idOfErr);
  var value = input.value.trim();
  if (value == "") {
    addIsInVail(input);
    feedback_err.innerHTML = "Vui lòng nhập đủ thông tin";
    return false;
  } else if (checkDuplicate) {
    if (Array.length == 0) {
      addIsVail(input);
      return true;
    } else if (Array.length != 0) {
      var check = checkDuplicateValue(value, Array);
      if (check) {
        addIsInVail(input);
        feedback_err.innerHTML = "Đã tồn tại";
        return false;
      } else {
        addIsVail(input);
        return true;
      }
    }
  } else {
    addIsVail(input);
    return true;
  }
}

function formValidation(idForm) {
  form = document.getElementById(idForm);
  if (!form.checkValidity()) {
    form.classList.add("was-validated");
    // alert(false)
    return false;
  }
  // alert(true)
  return true;
}
// Example starter JavaScript for disabling form submissions if there are invalid fields
// (function () {
//   "use strict";

//   // Fetch all the forms we want to apply custom Bootstrap validation styles to
//   var forms = document.querySelectorAll(".needs-validation");

//   // Loop over them and prevent submission
//   Array.prototype.slice.call(forms).forEach(function (form) {
//     form.addEventListener(
//       "submit",
//       function (event) {
//         if (!form.checkValidity()) {
//           event.preventDefault();
//           event.stopPropagation();
//         }
//         form.classList.add("was-validated");
//       },
//       false
//     );
//   });
// })();

function validate($data) {
  $data.trim();
}
$(document).ready(function () {
  // selectButton= document.querySelectorAll('button')
  // console.log(selectButton)
  // $selectButton.dblclick(false);
});
//  Array remove
function arrayRemove(arr, indexOfArr) {
  return arr.filter(function (value, index) {
    return index != indexOfArr;
  });
}

function removeRequired(elements) {
  elements.forEach(function (element) {
    element.removeAttribute("required");
  });
}
function addRequired(elements) {
  elements.forEach(function (element) {
    element.setAttribute("required", true);
  });
}
function addValueNull(elements) {
  elements.forEach(function (element) {
    element.value = "";
  });
}
function validateSize(input, max_value) {
  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > max_value) {
    alert("File size exceeds 2 MiB");
    // $(file).val(''); //for clearing with Jquery
  } else {
    // Proceed further
  }
}
// $(document).ready(function () {
//   $("button").on("click", function() {
//       $(this).attr("disabled", "disabled");
//       setTimeout('$("button").removeAttr("disabled")', 1500);
//   });
// });


