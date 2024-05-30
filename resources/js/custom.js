import Swal from "sweetalert2";

const MODAL_SIZE = {
    SMALL: "modal-sm",
    DEFAULT: "",
    LARGE: "modal-lg",
    XL: "modal-xl",
};
const TOAST_TYPE = {
    ERROR: "error",
    SUCCESS: "success",
};
const TOAST_TIMER = 9999999;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: TOAST_TIMER,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

window.addEventListener("toast", (event) => {
    let type = event.detail[0].type;
    let title, icon;
    let text = event.detail[0].message;
    if (type == "success") {
        title = "Berhasil";
        icon = "success";
    } else if (type == "error") {
        title = "Gagal";
        icon = "error";
    }
    let options = {
        title: text,
        icon: icon,
    };

    if (event.detail.timer) {
        options.timer = event.detail.timer;
    }

    Toast.fire(options);
});

window.addEventListener("clog", (event) => {
    console.log(event.detail);
});

window.addEventListener("alert", (event) => {
    alert(event.detail);
});