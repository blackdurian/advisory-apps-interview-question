<?php

use App\Controller\listingController;
use App\Controller\userController;

require_once "controllers/listingController.php";
require_once "controllers/userController.php";

session_start();

//todo define cookie

if (! empty($_SESSION["user_id"]) && ! empty($_SESSION["token"]) ) {
  $isLoggedIn = true;
  $user_id = $_SESSION["user_id"];
  $token= $_SESSION["token"]; 
  $type = $_SESSION["type"];
}

if(!$isLoggedIn) {
    header("Location: login.php");
}

$listing = new listingController();
$result = $listing->getAllListing();

$userController = new userController;
$user = $userController->getUserByID($user_id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Part-B</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 700px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title ml-3">Listing</h4>

                    <div class="card-description ">


                        <!-- search bar function in bottom js-->
                        <form class="nav-link form-inline mt-2 mt-md-0 d-none d-lg-flex">
                            <div class="input-group">
                                <input type="text" class="form-control search-table-filter" placeholder="Search"
                                       data-table="order-table">
                                <div class="input-group-append">
                        <span class="input-group-text">
                        <i class="mdi mdi-magnify"></i>                  
                        </span>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="table-responsive-fluid text-nowrap">
                        <table class="table table-striped order-table" id="myTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>List Name</th>
                                <th>Distance</th>
                                <th>User ID</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($result)) {
                                foreach ($result as $k => $v) {
                                    ?>
                                    <tr>
                                        <td class="py-1"><?php echo $result[$k]["id"]; ?></td>
                                        <td class="py-1"><?php echo $result[$k]["list_name"]; ?></td>
                                        <td class="py-1"><?php echo $result[$k]["distance"]; ?></td>
                                        <td class="py-1"><?php echo $result[$k]["user_id"]; ?></td>
                                        <td class="py-1">
                                            <a href="list-action.php?action=edit&id=<?php echo $result[$k]["id"]; ?>">
                                                <button type="button" class="btn btn-info">edit</button>
                                            </a>
                                        </td>
                                        <td class="py-1">
                                            <a href="list-action.php?action=delete&id=<?php echo $result[$k]["id"]; ?>">
                                                <button type="button" class="btn">delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <a href="list-action.php?action=add">
            <button type="button" class="btn btn-info btn-fw" onclick="">Add Listing</button>
        </a>

        <a href="logout.php">
        <button type="button" class="btn btn-secondary btn-fw " onclick="">Logout</button>
        </a>

        <a  href="APImodules/login.php?email=<?php echo $user[0]['email']; ?>&password=<?php echo $user[0]['encrypted_password']; ?>">
            <button style="float: right; " type="button" class="btn btn-danger btn-fw" onclick="">USER-Login API</button>
        </a>
        <a  href="APImodules/listing.php?id=<?php echo $user_id; ?>&token=<?php echo $token; ?>">
            <button style="float: right; margin-right: 10px;" type="button" class="btn btn-danger btn-fw" onclick="">Listing API By User</button>
        </a>
    </div>

</div>
<script>

    (function (document) {
        'use strict';

        var LightTableFilter = (function (Arr) {

            var _input;

            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function (table) {
                    Arr.forEach.call(table.tBodies, function (tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            function _filter(row) {
                var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                init: function () {
                    var inputs = document.getElementsByClassName('search-table-filter');
                    Arr.forEach.call(inputs, function (input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        document.addEventListener('readystatechange', function () {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });

    })(document);

</script>
</body>
</html>