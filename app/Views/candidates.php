<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/af-2.4.0/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <title>Candidates</title>
</head>

<body>
    <div class="container-lg">
        <!-- <span id="message"></span> -->
        <h2 class="text-center mt-4 mb-4">Candidates</h2>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col text-right">
                        <a href="<?php echo base_url("/candidates/add") ?>" class="btn btn-success btn-sm">Create</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-striped table-bordered" id="sample_table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Found By</th>
                                <th>Last Contacted</th>
                                <th>Linkedin</th>
                                <th>Position</th>
                                <th>Notes</th>
                                <th>Company</th>
                                <th>Salary</th>
                                <th>Blacklisted</th>
                                <th>Operations</th>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#sample_table').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 10
            }],
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("/ajax_crud/fetch_all"); ?>",
                type: "POST",
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    title: 'Akta Candidates',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    },
                },
                {
                    extend: 'excelHtml5',
                    title: 'Akta Candidates',
                    footer: true
                },
                'copy', 'csv'
            ],
            order: [0, 'desc'],
            "createdRow": function(row, data, dataIndex) {
                if (data[9] == `Yes` || data[9] == 'yes') {
                    $(row).addClass('bg-danger');
                }
                // console.log("DATA IS", data[9]);
            }
        });

    });

    function delete_data(id) {
        if (confirm("Are you sure you want to remove it?")) {
            window.location.href = "<?php echo base_url(); ?>/candidates/delete/" + id;
        }
        return false;
    }
</script>