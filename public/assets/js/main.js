function Delete(event) {
    event.preventDefault();
    var form = event.target.closest("form");

    Swal.fire({
        title: "Are You Sure?",
        text: "For Deleting This?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

function isNumberKey(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (
        (charCode >= 48 && charCode <= 57) ||
        charCode === 44 ||
        charCode === 46
    ) {
        return true;
    } else {
        return false;
    }
}

function Refresh(event, id) {
    event.preventDefault();

    Swal.fire({
        title: "Are You Sure?",
        text: "For Change to Default Password?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/refresh/" + id;
        }
    });
}

$(document).ready(function () {
    $(".role").select2({
        placeholder: "Select Role",
    });
    $(".role").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });
    $(".departement").select2({
        placeholder: "Select Departement",
    });
    $(".departement").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });
    $(".messar").select2({
        placeholder: "Select Messar",
    });
    $(".messar").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });
    $(".nopo").select2({
        placeholder: "Select No. PO",
    });
    $(".nopo").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });
    $(".currencies").select2({
        placeholder: "Select Currency",
    });
    $(".currencies").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });
    $(".satuan").select2({
        placeholder: "Select Satuan",
    });
    $(".satuan").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });
    $(".supplier").select2({
        placeholder: "Select Suplier",
    });
    $(".supplier").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });
    $(".position").select2({
        placeholder: "Select Position",
    });
    $(".position").on("select2:open", function (e) {
        $(".select2-dropdown").addClass("dropdown-menu");
    });

    $("#hire_date").datepicker({
        todayHighlight: true,
        autoclose: true,
    });
    $("#contract_exp_date").datepicker({
        todayHighlight: true,
        autoclose: true,
    });
});

function Approve(event, id) {
    event.preventDefault();

    Swal.fire({
        title: "Approve Purchase Order?",
        text: "Approval Can't Cancel",
        showDenyButton: true,
        showCancelButton: true,
        icon: "question",
        confirmButtonText: "Approve",
        denyButtonText: `Not Approve`,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#3085d6",
        denyButtonColor: "#d33",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/purchaseorder/approve/" + id;
        } else if (result.isDenied) {
            window.location.href = "/purchaseorder/notapprove/" + id;
        }
    });
}
function Cancel(event, id) {
    event.preventDefault();

    Swal.fire({
        title: "Cancel Approval?",
        text: "",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/purchaseorder/cancel-approve/" + id;
        }
    });
}
