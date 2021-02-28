function addSaleDate(status) {
    if (status.value == 2) {
        document.getElementById("date_of_sale").style.display = "block";
    } else {
        document.getElementById("date_of_sale").style.display = "none";
    }
}

function removePhotos(id) {

    document.getElementById(id).classList.toggle('transform');
    let arr_value = document.getElementById("hidden_img").value;
    var img_arr = document.getElementById("hidden_img");

    // array that will be assigned to the hidden input
    // the arr is reinitilised every time, allowing us to simply skip adding a value we want to pop
    var arr = [];
    var flag = true;

    // if hidden input value exists
    if (arr_value) {
        arr_value = JSON.parse(arr_value);

        arr_value.forEach(img_id => {
            // if the image is clicked for the second time
            // do not add it to the arr that will be assigned to the hidden input
            if (img_id == id) {
                flag = false;
            } else {
                // place existing values into the empty arr
                arr.push(img_id);
            }
        });
    }

    if (flag) {
        arr.push(id);
    }

    // the array is stringified so that more values could be placed within the input field
    img_arr.value = JSON.stringify(arr);

    console.log(img_arr.value);

}

// the element to which we add selected filters
var ul = document.getElementById('criteria-list');

// function to add filter buttons
function addFilters(filter, btn_text = "", measure = "", select = false, select_el = "", id_parent="", id_self="") {
    if (filter != "") {
        if (select) {
            for (var i = 0; i < select_el.length; i++) {
                var option = select_el.options[i];
                if (option.value == filter) {
                    filter = option.text;
                }
            }
        } 
        var li = document.createElement('li');

        li.innerHTML = `<button class="btn btn-primary" id="${id_self}" value="${id_parent}">${btn_text}${filter}${measure} <i class="fas fa-times fa-lg"></i></button>`;

        ul.appendChild(li);

        // set the event listened so that the filter gets deleted once clicked
        var btn = document.getElementById(id_self);
        btn.addEventListener("click", clearSearch);
    }
}

function clearSearch(event) {
    // get the clicked button which is the parent element of the link
    let clickedBtn = event.target.parentElement;
    console.log(clickedBtn);

    // search for the parent element and clear it 
    document.getElementById(clickedBtn.value).value = "";

    // // submit the form so that changes apply
    document.getElementById('search_form').submit();
}
var criteriaDiv = document.getElementById('criteria-div');

function displayFilters() {

    criteriaDiv.style.display = "block";
}

// show filter row
document.getElementById('search_form').addEventListener('submit', displayFilters);

// dropdown menus from which we need to extract textual data 
var realty_type_slc = document.getElementById('realty_type_id');
var ad_type_slc = document.getElementById('ad_type_id');
var city_slc = document.getElementById('city_id');
var status_slc = document.getElementById('status_id');

// get the url 
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

// check which params exist
const realty_type = urlParams.get('realty_type');
addFilters(realty_type, "", "", true, realty_type_slc, "realty_type_id", "btn1");

const ad_type = urlParams.get('ad_type');
addFilters(ad_type, "", "", true, ad_type_slc, "ad_type_id", "btn2");

const city_id = urlParams.get('city');
addFilters(city_id, "", "", true, city_slc, "city_id", "btn3");

let status = urlParams.get('status');
addFilters(status, "", "", true, status_slc, "status_id", "btn10");
// a separate function because the options are a bit different than for the other filters

const min_price = urlParams.get('min_price');
addFilters(min_price, "Min Price: ", "€", false, "", "min_price_id", "btn4");

const max_price = urlParams.get('max_price');
addFilters(max_price, "Max Price: ", "€", false, "", "max_price_id", "btn5");

const min_size = urlParams.get('min_size');
addFilters(min_size, "Min Size: ", "m2", false, "", "min_size_id", "btn6");

const max_size = urlParams.get('max_size');
addFilters(max_size, "Max Size: ", "m2", false, "", "max_size_id", "btn7");

const year_min = urlParams.get('year_min');
addFilters(year_min, "Constructed since: ", "", false, "", "year_min_id", "btn8");

const year_max = urlParams.get('year_max');
addFilters(year_max, "Constructed until: ", "", false, "", "year_max_id", "btn9");

// if (status != "") {
//     status == 0 ? status = "Available" : status = "Not available";
// }

function addFilterDate(date_min, date_max) {

    if (date_min != "" || date_max != "") {
        var li = document.createElement('li');

        if (date_min != "" && date_max != "") {
            var text1 = "Sold between: ";
            var text2 = " and ";
            // li.innerHTML = `<button class="btn btn-primary">Sold between: ${date_min} and ${date_max}<i class="fas fa-times fa-lg"></i></button>`;
        } else if (date_max != "" && date_min == "") {
            text1 = "Sold before: ";
            text2 = "";
        } else if (date_min != "" && date_max == "") {
            text1 = "Sold after: ";
            text2 = "";
        }
        li.innerHTML = `<button class="btn btn-primary">${text1}${date_min}${text2}${date_max}<i class="fas fa-times fa-lg"></i></button>`;
        ul.appendChild(li);
    }
}

const date_of_sale_min = urlParams.get('date_of_sale_min');
const date_of_sale_max = urlParams.get('date_of_sale_max');

addFilterDate(date_of_sale_min, date_of_sale_max);

function clearSearchCriteria() {
    realty_type_slc.value = "";
    ad_type_slc.value = "";
    city_slc.value = "";
    status_slc.value = "";
    document.getElementById("min_price_id").value = "";
    document.getElementById("max_price_id").value = "";
    document.getElementById("min_size_id").value = "";
    document.getElementById("max_size_id").value = "";
    document.getElementById("year_min_id").value = "";
    document.getElementById("year_max_id").value = "";

    // // submit the form so that changes apply
    document.getElementById('search_form').submit();
    // criteriaDiv.style.display = "none";
}

document.getElementById('clear_all').addEventListener('click', clearSearchCriteria);