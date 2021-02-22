
function addSaleDate(status) {
    if (status.value == 1) {
        document.getElementById("date_of_sale").style.display = "block";
    } else {
        document.getElementById("date_of_sale").style.display = "none";
    }
}