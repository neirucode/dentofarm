let cottage_s_form = document.getElementById("cottage_s_form");
let other_s_form = document.getElementById("other_s_form");
let add_room_form = document.getElementById('add_room_form');
let edit_room_form = document.getElementById('edit_room_form');

let pool_s_form = document.getElementById("pool_s_form");
let edit_pool_form = document.getElementById("edit_pool_form");



// Add Pool Modal
pool_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    add_pool();
});

function add_pool() {
    let data = new FormData(pool_s_form);
    data.append("add_pool", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("pool-s");
        var modal = new bootstrap.Modal(myModal);
        modal.hide();

        if (this.responseText == "inv_img") {
            alert("Only JPG, JPEG, PNG, and WEBP images are allowed!");
        } else if (this.responseText == "inv_size") {
            alert("Image size should be less than 2mb!");
        } else if (this.responseText == "upd_failed") {
            alert("Image upload failed. Server Down!");
        } else {
            alert("New Pool added!");
            pool_s_form.reset();
            get_pools();
        }
    };

    xhr.send(data);
}
function edit_pool(id) {
    edit_pool_form.poolId = id; // Set the pool ID as a property of the form

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        try {
            // Check if the response is not empty
            if (this.responseText.trim() !== '') {
                let data = JSON.parse(this.responseText);
                 var editModal = new bootstrap.Modal(document.getElementById("edit-pool-modal"));
                modal.hide();
                // Check if data and pooldata properties exist
                if (data && data.pooldata) {
                    // Update the form fields with the retrieved data
                    edit_pool_form.elements['edit_pool_name'].value = data.pooldata.name;
                    // Assuming 'picture' is the file input id in your edit modal
                    edit_pool_form.elements['edit_pool_picture'].value = data.pooldata.picture;
                    edit_pool_form.elements['edit_pool_desc'].value = data.pooldata.description;
                    // ...
                
                    // Now, you can proceed with the rest of your code
                } else {
                    console.error('Invalid or missing data properties in the response:', data);
                }
            } else {
                console.error('Empty response from the server.');
            }
        } catch (error) {
            console.log('Server response:', this.responseText);
        }
    };

    xhr.send('get_pool=' + id);
}

// Update Pool Modal
edit_pool_form.addEventListener("submit", function (e) {
    e.preventDefault();
    update_pool();
});

function update_pool() {
    let data = new FormData(edit_pool_form);
    data.append("update_pool", "");
    data.append("get_pool", edit_pool_form.poolId); // Use the pool ID from the form's property

    // Check if the file input has a value and append it to the FormData
    let poolPictureInput = edit_pool_form.elements['edit_pool_picture'];
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("edit-pool-modal");
        if (poolPictureInput.files.length > 0) {
            data.append("edit_pool_picture", poolPictureInput.files[0]);
        }    
        if (this.responseText == "inv_img") {
            alert("Only JPG, JPEG, PNG, and WEBP images are allowed!");
        } else if (this.responseText == "inv_size") {
            alert("Image size should be less than 2mb!");
        } else if (this.responseText == "upd_failed") {
            alert("Pool update failed. Server Down!");
        } else if (this.responseText == "1") {
            let successMessage = "Pool updated!";

            // Check if the name, picture, or description was updated
            if (data.has("edit_pool_name") || data.has("edit_pool_picture") || data.has("edit_pool_desc")) {
                successMessage = "Pool edited!";
            }

            alert(successMessage);
            edit_pool_form.reset();
            get_pools();

        }
    };

    xhr.send(data);
}

// Get Pools
function get_pools() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        document.getElementById("pools-data").innerHTML = this.responseText;
    };

    xhr.send("get_pools");
}

// Remove Pool
function rem_pool(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert("success", "Pool removed!");
            get_pools(); // Reload the list of pools
        } else if (this.responseText == "amenities_added") {
            alert("error", "Pool is added in amenities!");
        } else {
            alert("error", "Server down!");
        }
    };

    xhr.send("rem_pool=" + val);
}




// cottage
cottage_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    add_cottage();
});

function add_cottage() {
    let data = new FormData();
    data.append("name", cottage_s_form.elements["cottage_name"].value);
    data.append("picture", cottage_s_form.elements["cottage_picture"].files[0]);
    data.append("desc", cottage_s_form.elements["cottage_desc"].value);
    data.append("add_cottage", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("cottage-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == "inv_img") {
            alert("error", "Only JPG, JPEG, PNG, and WEBP images are allowed!");
        } else if (this.responseText == "inv_size") {
            alert("error", "Image size should be less than 2mb!");
        } else if (this.responseText == "upd_failed") {
            alert("error", "Image upload failed. Server Down!");
        } else {
            alert("success", "New Cottage added!");
            cottage_s_form.reset();
            get_cottages();
        }
    };

    xhr.send(data);
}
function get_cottages() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        document.getElementById("cottages-data").innerHTML = this.responseText;
    };

    xhr.send("get_cottages");
}

function rem_cottage(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert("success", "Pool removed!");
            get_cottages();
        } else if (this.responseText == "amenities_added") {
            alert("error", "Cottage is added in amenities!");
        } else {
            alert("error", "Server down!");
        }
    };

    xhr.send("rem_cottage=" + val);
}

// other
        other_s_form.addEventListener("submit", function (e) {
    e.preventDefault();
    add_other();
});

function add_other() {
    let data = new FormData();
    data.append("name", other_s_form.elements["other_name"].value);
    data.append("picture", other_s_form.elements["other_picture"].files[0]);
    data.append("desc", other_s_form.elements["other_desc"].value);
    data.append("add_other", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("other-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == "inv_img") {
            alert("error", "Only JPG, JPEG, PNG, and WEBP images are allowed!");
        } else if (this.responseText == "inv_size") {
            alert("error", "Image size should be less than 2mb!");
        } else if (this.responseText == "upd_failed") {
            alert("error", "Image upload failed. Server Down!");
        } else {
            alert("success", "New Amenity added!");
            other_s_form.reset();
            get_others();
        }
    };

    xhr.send(data);
}
function get_others() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        document.getElementById("others-data").innerHTML = this.responseText;
    };

    xhr.send("get_others");
}

function rem_other(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/amenities_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.responseText == 1) {
            alert("success", "Amenity removed!");
            get_cottages();
        } else if (this.responseText == "amenities_added") {
            alert("error", "New Amenity is added in amenities!");
        } else {
            alert("error", "Server down!");
        }
    };

    xhr.send("rem_other=" + val);
}


        window.onload = function () {
            get_pools();
            get_cottages();
            get_others();

}