<?php

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();
// Pools
if (isset($_POST['add_pool'])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['pool_picture'], POOLS_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `pools`(`picture`, `name`, `description`) VALUES (?,?,?)";
        $values = [$img_r, $frm_data['pool_name'], $frm_data['pool_desc']];
        $res = insert($q, $values, 'sss');
        echo $res;
    }
}

if (isset($_POST['get_pools'])) {
    $res = selectAll('pools');
    $i = 1;
    $path = POOLS_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        $path = POOLS_IMG_PATH;
        echo <<<data
        <tr class="align-middle">
            <td>$i</td>
            <td><img src="$path{$row['picture']}" height="100px"></td> 
            <td>{$row['name']}</td> 
            <td>{$row['description']}</td> 
            <td>
                <button type="button" onclick="rem_pool({$row['id']})" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash-fill"></i> Delete
                </button>
            </td>
        </tr>
    data;
        $i++;
    }
}
if (isset($_POST['edit_pool'])) {
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `pools` SET `picture`=?,`name`=?,`description`=? WHERE `id`=?";
    $values = [$frm_data['edit_pool_picture'], $frm_data['edit_pool_name'], $frm_data['edit_pool_desc'], $frm_data['get_pool']];

    if (update($q1, $values, 'sssi')) {
        $flag = 1;
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}
if (isset($_POST['update_pool'])) {
    $frm_data = filteration($_POST);
    $flag = 0;

    // Check if a new image file is uploaded
    if (isset($_FILES['edit_pool_picture']) && $_FILES['edit_pool_picture']['error'] == 0) {
        // Handle the image upload separately
        $img_r = uploadImage($_FILES['edit_pool_picture'], POOLS_FOLDER);

        if ($img_r == 'inv_img') {
            echo $img_r;
            // Don't exit, continue with the update
        }

        // Update the database with the new image
        $q1 = "UPDATE `pools` SET `picture`=? WHERE `id`=?";
        $values = [$img_r, $frm_data['get_pool']];
    } else {
        // No new image uploaded, check for name and description
        if (!empty($frm_data['edit_pool_name']) && !empty($frm_data['edit_pool_desc'])) {
            $q1 = "UPDATE `pools` SET `name`=?, `description`=? WHERE `id`=?";
            $values = [$frm_data['edit_pool_name'], $frm_data['edit_pool_desc'], $frm_data['get_pool']];
        } elseif (!empty($frm_data['edit_pool_name'])) {
            $q1 = "UPDATE `pools` SET `name`=? WHERE `id`=?";
            $values = [$frm_data['edit_pool_name'], $frm_data['get_pool']];
        } elseif (!empty($frm_data['edit_pool_desc'])) {
            $q1 = "UPDATE `pools` SET `description`=? WHERE `id`=?";
            $values = [$frm_data['edit_pool_desc'], $frm_data['get_pool']];
        } else {
            echo 0; // Nothing to update
            exit;
        }
    }

    // Perform the database update
    if (update($q1, $values, 'si')) {
        $flag = 1;
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}
if (isset($_POST['get_pool'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['get_pool']];
    
    $q = "SELECT * FROM `pools` WHERE `id`=?";
    $res = select($q, $values, 'i');
    $row = mysqli_fetch_assoc($res);
    
    // Return the data as JSON
    echo json_encode(['pooldata' => $row]);
}
if (isset($_POST['rem_pool'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_pool']];

    $pre_q = "SELECT * FROM `pools` WHERE `id`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['picture'], POOLS_FOLDER)) {
        $q = "DELETE FROM `pools` WHERE `id`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }

}


// Cottages

if (isset($_POST['add_cottage'])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['picture'], COTTAGES_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `cottages`(`picture`, `name`, `description`) VALUES (?,?,?)";
        $values = [$img_r, $frm_data['name'], $frm_data['desc']];
        $res = insert($q, $values, 'sss');
        echo $res;
    }
}

if (isset($_POST['get_cottages'])) {
    $res = selectAll('cottages');
    $i = 1;
    $path = COTTAGES_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        $path = COTTAGES_IMG_PATH;
        echo <<<data
            <tr class="align-middle">
            <td>$i</td>
            <td><img src="$path$row[picture]" height="100px"></td> 
            <td>$row[name]</td> 
            <td>$row[description]</td> 
            <td>
                <button type="button" onclick="rem_cottage($row[id])" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash-fill"></i> Delete
                </button>
            </td>
            </tr>

        data;
        $i++;
    }
}

if (isset($_POST['rem_cottage'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_cottage']];

    $pre_q = "SELECT * FROM `cottages` WHERE `id`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['picture'], COTTAGES_FOLDER)) {
        $q = "DELETE FROM `cottages` WHERE `id`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }

}
// Other Amenities
if (isset($_POST['add_other'])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['picture'], OTHERS_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `others`(`picture`, `name`, `description`) VALUES (?,?,?)";
        $values = [$img_r, $frm_data['name'], $frm_data['desc']];
        $res = insert($q, $values, 'sss');
        echo $res;
    }
}

if (isset($_POST['get_others'])) {
    $res = selectAll('others');
    $i = 1;
    $path = OTHERS_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        $path = OTHERS_IMG_PATH;
        echo <<<data
            <tr class="align-middle">
            <td>$i</td>
            <td><img src="$path$row[picture]" height="100px"></td> 
            <td>$row[name]</td> 
            <td>$row[description]</td> 
            <td>
                <button type="button" onclick="rem_other($row[id])" class="btn btn-danger btn-sm shadow-none">
                    <i class="bi bi-trash-fill"></i> Delete
                </button>
            </td>
            </tr>

        data;
        $i++;
    }
}

if (isset($_POST['rem_other'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_other']];

    $pre_q = "SELECT * FROM `others` WHERE `id`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['picture'], OTHERS_FOLDER)) {
        $q = "DELETE FROM `others` WHERE `id`=?";
        $res = delete($q,$values,'i');
        echo $res;
    } else {
        echo 0;
    }

}


?>