<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ecommerce Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Template Main JS & CSSFile -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        #modaldata tbody tr>td:last-of-type {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container p-5">
        @if (session('success'))
        <p class="alert alert-success text-center">{{ session('success') }}</p>
        @endif
        <div class="form-group">
            <button type="button" class="btn btn-primary float-end" id="lead_doctor_show">Send Lead</button>
        </div>
        <table id="example" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Speciality</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $loop->iteration }} <input class="select-doctor" type="checkbox" name="select_doctor" value="{{ $doctor->email }}" data="{{ $doctor->name .'-'. $doctor->speciality }}"></td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->phone_number }}</td>
                    <td>{{ $doctor->speciality }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Speciality</th>
                </tr>
            </tfoot>
        </table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="lead_doctor_hide" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="doctor_name"></div>
                    <form method="post" action="{{route('store')}}" id="myform" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pb-2">
                            <div class="row row-sm">
                                <div class="row row-sm">
                                    <div class="col-lg" id="doctor_email">
                                        <label class="form-label">Patient Name</label>
                                        <input type="text" class="form-control mb-4" name='patient_name' required>
                                    </div>
                                    <div class="col-lg">
                                        <label class="form-label">Patient phone Number</label>
                                        <input type="text" class="form-control mb-4" name='phone_number' required>
                                    </div>
                                </div>
                                <label class="form-label">Issue/Concern/Consulting For:</label>
                                <textarea name="issue_message" class="form-control mb-4" value="{{ old('issue_message') }}" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="mb-0 mt-4 row justify-content-end">
                            <div class="col-md-9">
                                <button type="submit" name="insert" value="insert" class="btn btn-primary">Send Lead</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- script -->
    <script>
        jQuery(document).ready(function($) {
            //jQuery Functionality
            $('#example').DataTable();
            // model show
            $('#lead_doctor_show').click(function() {
                var name = [];
                var email = [];
                $('.select-doctor:checked').each(function() {
                    email.push($(this).val());
                    name.push($(this).attr('data'));
                });
                if (email.length != 0) {
                    $('#doctor_name').append('<p><b>Selected Doctor</b>"' + name + '"</p>');
                    $('#doctor_email').append('<input type="hidden" name="doctor_email" value="' + email + '" class="form-control">');
                    $('#exampleModal').modal('show');
                } else {
                    alert("Please Select a Doctor");
                }
            });
            // model hide
            $('#lead_doctor_hide').click(function() {
                $('#exampleModal').modal('hide');
            });
        });
    </script>
    <!-- end script -->
</body>

</html>