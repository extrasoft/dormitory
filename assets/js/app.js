$(function () {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
    });
});
$(document).ready(function() {
  $('.datatable').DataTable();
  $('.edit-employee').click(function() {
    //รับค่าจากปุ่ม Edit
    var id = $(this).attr('data-id');
    var firstname = $(this).attr('data-firstname');
    var lastname = $(this).attr('data-lastname');
    var address = $(this).attr('data-address');
    var email = $(this).attr('data-email');
    var tel = $(this).attr('data-tel');
    var position = $(this).attr('data-position');
    var salary = $(this).attr('data-salary');
    var memID = $(this).attr('data-memID');

    //กำหนดค่าให้ modal
    $('#inputFirstname').val(firstname);
    $('#inputLastname').val(lastname);
    $('#inputAddress').val(address);
    $('#inputEmail').val(email);
    $('#inputTelephone').val(tel);
    $('#inputPosition').val(position);
    $('#inputSalary').val(salary);
    $('#inputID').val(id);

    //เปิด modal
    $('#formEditEmployee').modal('show');
  });
});
