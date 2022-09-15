<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!--  -->
</head>

<body>
    <div class="container">

        <h2 class="text-center mt-4 mb-4">Akta Candidates</h2>

        <?php

        $validation = \Config\Services::validation();

        ?>
        <div class="card text-left">
            <div class="card-header">
                <div class="row">
                    <div class="col">Sample Data</div>
                    <div class="col text-right">

                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url("/crud/add_validation") ?>">

                    <div class="row">
                        <div class="col-6">
                            <label>Candidate Name</label>
                            <input type="text" name="name" class="form-control" />
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
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-6">
                            <label>Found Date</label>
                            <input type="text" name="last_contacted" class="form-control" value="<?php echo date("d.m.y") ?>" />
                        </div>
                        <div class="col-6">
                            <label>LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" />
                            <?php
                            if ($validation->getError('linkedin')) {
                                echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('linkedin') . "
                            </div>
                            ";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control" />
                        </div>
                        <?php
                        if ($validation->getError('position')) {
                            echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('position') . "
                            </div>
                            ";
                        }
                        ?>

                        <div class="col-6">
                            <label>Company</label>
                            <input type="text" name="company" class="form-control" />
                        </div>
                        <?php
                        if ($validation->getError('company')) {
                            echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('company') . "
                            </div>
                            ";
                        }
                        ?>
                    </div>

            <div class="row">
                <div class="col-6">
                    <label>Salary</label>
                    <input type="text" name="salary" class="form-control" />
                </div>
                <?php
                if ($validation->getError('salary')) {
                    echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('salary') . "
                            </div>
                            ";
                }
                ?>
                <div class="col-6">
                    <label>Blacklisted</label>
                    <input type="text" name="blacklisted" class="form-control" />
                </div>
                <?php
                if ($validation->getError('blacklisted')) {
                    echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('blacklisted') . "
                            </div>
                            ";
                }
                ?>
            </div>


            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes" class="form-control" cols="30" rows="5"  ></textarea>
                <?php
                if ($validation->getError('notes')) {
                    echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('notes') . "
                            </div>
                            ";
                }
                ?>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>

        </div>
    </div>

    </div>

</body>

</html>