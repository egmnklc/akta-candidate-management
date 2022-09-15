<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Edit Data - Codeigniter 4 Crud Application</title>
    <!--  -->
</head>

<body>
    <div class="container">

        <?php

        $validation = \Config\Services::validation();
        ?>
        <h2 class="text-center mt-4 mb-4">Edit Data - Codeigniter 4 Crud Application</h2>

        <div class="card">
            <div class="card-header">Edit Data</div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('crud/edit_validation'); ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>Candidate Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $user_data['name'] ?>" />
                            </div>
                            <?php
                            if ($validation->getError('name')) {
                                echo '<div class="alert alert-danger mt-2">' . $validation->getError('name') . '</div>';
                            }
                            ?>

                            <?php
                            $fname = session()->get('firstname');
                            $lname = session()->get('lastname');
                            $nickname = $fname . ' ' . $lname;
                            ?>
                            <div class="col-6">
                                <label>Found By</label>
                                <input type="text" name="found_by" class="form-control" value="<?php echo $nickname ?>" />
                                <?php
                                if ($validation->getError('found_by')) {
                                    echo '<div class="alert alert-danger mt-2">' . $validation->getError('found_by') . '</div>';
                                }
                                ?>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-6">
                                <label>Last Contacted</label>
                                <input type="text" name="last_contacted" class="form-control" value="<?php echo date("d.m.y") ?>" />
                                <?php
                                if ($validation->getError('last_contacted')) {
                                    echo '<div class="alert alert-danger mt-2">' . $validation->getError('last_contacted') . '</div>';
                                }
                                ?>
                            </div>

                            <div class="col-6">
                                <label>LinkedIn</label>
                                <input type="text" name="linkedin" class="form-control" value="<?php echo $user_data['linkedin'] ?>" />
                                <?php
                                if ($validation->getError('linkedin')) {
                                    echo " <div class='alert alert-danger mt-2'> " . $validation->getError('linkedin') . " </div> ";
                                }
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label>Position</label>
                                <input type="text" name="position" class="form-control" value="<?php echo $user_data['position'] ?>" />
                            </div>
                            <?php
                            if ($validation->getError('position')) {
                                echo " <div class='alert alert-danger mt-2'> " . $validation->getError('position') . " </div> ";
                            }

                            ?>

                            <div class="col-6">
                                <label>Company</label>
                                <input type="text" name="company" class="form-control" value="<?php echo $user_data['company'] ?>" />
                            </div>
                            <?php
                            if ($validation->getError('company')) {
                                echo " <div class='alert alert-danger mt-2'> " . $validation->getError('company') . " </div> ";
                            }

                            ?>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label>Salary</label>
                                <input type="text" name="salary" class="form-control" value="<?php echo $user_data['salary'] ?>" />
                            </div>
                            <?php
                            if ($validation->getError('salary')) {
                                echo " <div class='alert alert-danger mt-2'> " . $validation->getError('salary') . " </div> ";
                            }

                            ?>
                            <div class="col-6">
                                <label>Blacklisted</label>
                                <input type="text" name="blacklisted" class="form-control" value="<?php echo $user_data['blacklisted'] ?>" />
                            </div>
                            <?php
                            if ($validation->getError('blacklisted')) {
                                echo " <div class='alert alert-danger mt-2'> " . $validation->getError('blacklisted') . " </div> ";
                            }

                            ?>
                        </div>


                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" cols="30" rows="5">
                                <?php
                                if ($user_data['last_contacted'] === '') {
                                    echo $user_data['notes'] . "\r\n" . "Last contact date not found.";
                                } else {
                                    echo $user_data['notes'] . "\r\n" . "Last contacted: " . $user_data['last_contacted'];
                                }
                                ?>
                                </textarea>
                            <?php
                            if ($validation->getError('notes')) {
                                echo " <div class='alert alert-danger mt-2'> " . $validation->getError('notes') . " </div> ";
                            }

                            ?>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $user_data["id"]; ?>" />
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                </form>
            </div>
        </div>

    </div>

</body>

</html>