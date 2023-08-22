<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Internship Task</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">Simple Registration Form</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">List</div>
            <div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>
  
        <div>
            @if (Session::has('success'))
                <div class="alert alert-success">{{ session::get('success') }}</div>
            @endif
        </div>
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th width="30">ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Hobbies</th>
                        <th>Image</th>
                        <th width="150">Action</th>
                    </tr>
                    @if($employees->isNotEmpty())
                    @foreach ($employees as $employee)
                    <tr valign="middle">
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->gender }}</td>
                        <th>{{ $employee->dob }}</th>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->hobbies }}</td>
                        <td>
                            @if($employee->image !='' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                            <img src="{{ url('uploads/employees/'.$employee->image) }}" width="40" alt="" height="40" class="rounded-circle">
                            @else
                            <img src="{{ url('assets/images/noimg.png') }}" width="40" alt="" height="40" class="rounded-circle">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('employees.edit',$employee->id)}}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="#" onclick="deleteEmployee({{ $employee->id }})" class="btn btn-sm btn-danger">Delete</a>

                            <form id="employee-edit-action-{{ $employee->id }}" action="{{ route('employees.destroy',$employee->id)}}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">No records found</td>
                    </tr>
                    @endif

                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $employees->links() }}
        </div>
    </div>
        

</body>
</html>

<script>
    function deleteEmployee(id){
        if(confirm("Are you sure want to delete?")){
            document.getElementById('employee-edit-action-'+id).submit();
        }
    }
</script>

