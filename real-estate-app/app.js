
function addSaleDate(status) {
    if (status.value == 1) {
        document.getElementById("date_of_sale").style.display = "block";
    } else {
        document.getElementById("date_of_sale").style.display = "none";
    }
}


function removePhotos(id) {
   
    let arr_value = document.getElementById("hidden_img").value;
    var img_arr = document.getElementById("hidden_img");
    
    // array that will be assigned to the hidden input
    // the arr is reinitilised every time, allowing us to simply skip adding a value we want to pop
    var arr = [];
    var flag = true;

    // if hidden input value exists
    if(arr_value){
        arr_value= JSON.parse(arr_value);

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

    if(flag){
       arr.push(id);
    }  
    
    img_arr.value = JSON.stringify(arr);
    
    console.log(img_arr.value);
   
}