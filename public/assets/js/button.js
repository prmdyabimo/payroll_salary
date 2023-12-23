const formAdd = document.getElementById("formAdd");
const btnAdd = document.getElementById("btnAdd");

if (formAdd && btnAdd) {
  btnAdd.addEventListener("click", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "Apakah anda yakin ingin menambahkan data?",
      text: "Data akan tersimpan",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Tambah!",
    }).then((result) => {
      if (result.isConfirmed) {
        if (formAdd instanceof HTMLFormElement) {
          formAdd.submit();
        } else {
          console.error("formAdd is not a valid form element.");
        }
      }
    });
  });
}

const formEdit = document.getElementById("formEdit");
const btnEdit = document.getElementById("btnEdit");

if (formEdit && btnEdit) {
  btnEdit.addEventListener("click", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "Apakah anda yakin ingin mengubah data?",
      text: "Data akan terubah",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ubah!",
    }).then((result) => {
      if (result.isConfirmed) {
        if (formEdit instanceof HTMLFormElement) {
          formEdit.submit();
        } else {
          console.error("formEdit is not a valid form element.");
        }
      }
    });
  });
}

$(document).on("click", ".btn_delete", function (e) {
  e.preventDefault();
  var link = $(this).attr("href");
  Swal.fire({
    title: "Apakah anda yakin ingin menghapus data?",
    text: "Data akan dihapus secara permanen!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = link;
    }
  });
});


const formDownload = document.getElementById("formDownload");
const btnDownload = document.getElementById("btnDownload");

if (formDownload && btnDownload) {
  btnDownload.addEventListener("click", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "Apakah anda yakin ingin mendownload data?",
      text: "Data akan tersimpan",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Download!",
    }).then((result) => {
      if (result.isConfirmed) {
        if (formDownload instanceof HTMLFormElement) {
          formDownload.submit();
        } else {
          console.error("formDownload is not a valid form element.");
        }
      }
    });
  });
}