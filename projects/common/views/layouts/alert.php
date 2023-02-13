<style>
.dark-mode .swal2-popup {
    background-color: #fff;
}

.swal-height {
    /* height: 80px; */
    display: flex;
}

h2#swal2-title {
    color: blue;
    padding-top: 10px;
}
</style>
<script>
var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
});

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}


// notify('Đăng ký thành công', 'success')
//success	error	warning	info	question
function notify(title, status) {
    Toast.fire({
        icon: status,
        title: title,
        customClass: 'swal-height',
        timerProgressBar: true,
    })
};

function loading(title) {
    let timerInterval
    Swal.fire({
        title: title,
        allowOutsideClick: false,
        showCloseButton: true,
        // timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()

        },
    })
}

// Ngắn chặn nhập các ký tự đặc biệt
// $('input[type=text]:not(.special_key)').on('blur', function() {
//     var c = this.selectionStart,
//         r =
//         /[^a-z0-9-/.+±, _A-Z_àáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]/gi,
//         v = $(this).val().normalize('NFC');
//     if (r.test(v)) {
//         $(this).val(v.replace(r, ''));
//         c--;
//         notify('Please do not enter special characters <br> Only allowed to enter a-> z, 0-9, and -,/',
//             'warning')
//     }
//     this.setSelectionRange(c, c);
// });
</script>