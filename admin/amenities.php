<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Amenities</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">
</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <!-- Pools  -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title m-0">Pools</h5>
                    <button type="button" class="btn btn-success shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#pool-s">
                        <i class="bi bi-plus-square"></i> Add
                    </button>
                </div>
                
                <!-- Pools Table -->
                <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                    <table class="table table-primary table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" width="20%">Picture</th>
                                <th scope="col">Name</th>
                                <th scope="col" width="30%">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="pools-data">
                            <!-- Pools data will be dynamically populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        <!-- cottages -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title m-0">Cottages</h5>
                    <button type="button" class="btn btn-success shadow-none btn-sm" data-bs-toggle="modal"
                        data-bs-target="#cottage-s">
                        <i class="bi bi-plus-square"></i> Add
                    </button>
                </div>
                <!--cottages table-->

                <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                    <table class="table table-primary table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Picture</th>
                                <th scope="col">Name</th>
                                <th scope="col" width="40%">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="cottages-data">
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- other amenities -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="card-title m-0">Other Amenities</h5>
                    <button type="button" class="btn btn-success shadow-none btn-sm" data-bs-toggle="modal"
                        data-bs-target="#other-s">
                        <i class="bi bi-plus-square"></i> Add
                    </button>
                </div>
                <!--other amenities table-->
                <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                    <table class="table table-primary table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Name</th>
                                <th scope="col" width="40%">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="others-data">
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        </div>
    </div>
</div>

    <!--Add Pool modal-->
    <div class="modal fade" id="pool-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="pool_s_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Pool</h5>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pool Name</label>
                            <input type="text" name="pool_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pool Picture</label>
                            <input type="file" name="pool_picture" accept=".jpg, .png, .webp, .jpeg"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3 fw-bold">
                            <label class="form-label">Pool Description</label>
                            <textarea name="pool_desc" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-sm bg-secondary more-btn text-white shadow-none"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="btn btn-sm bg-primary more-btn text-white shadow-none">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Edit Pool modal -->
<div class="modal fade" id="edit-pool-modal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="edit_pool_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pool</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pool Name</label>
                        <input type="text" name="edit_pool_name" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pool Picture</label>
                        <input type="file" name="edit_pool_picture" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none">
                    </div>
                    <div class="mb-3 fw-bold">
                        <label class="form-label">Pool Description</label>
                        <textarea name="edit_pool_desc" class="form-control shadow-none" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm bg-secondary more-btn text-white shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm bg-primary more-btn text-white shadow-none">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- cottage modal -->
    <div class="modal fade" id="cottage-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="cottage_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Pool</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cottage Name</label>
                            <input type="text" name="cottage_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Cottage Picture</label>
                            <input type="file" name="cottage_picture" accept=".jpg, .png, .webp, .jpeg"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3 fw-bold">
                            <label class="form-label">Cottage Description</label>
                            <textarea name="cottage_desc" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-sm bg-secondary more-btn text-white shadow-none"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="btn btn-sm bg-primary more-btn text-white shadow-none">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- other modal -->
    <div class="modal fade" id="other-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="other_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Amenity</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Amenity Name</label>
                            <input type="text" name="other_name" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Amenity Picture</label>
                            <input type="file" name="other_picture" accept=".jpg, .png, .webp, .jpeg"
                                class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3 fw-bold">
                            <label class="form-label">Amenity Description</label>
                            <textarea name="other_desc" class="form-control shadow-none" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-sm bg-secondary more-btn text-white shadow-none"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="btn btn-sm bg-primary more-btn text-white shadow-none">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
      </div>
    </div>
  </div>
</div>
    <?php require('inc/scripts.php'); ?>
    <script src="scripts/amenities.js"></script>

    </script>
    </script>


</body>
</html>