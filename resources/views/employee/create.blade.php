<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Internship Task</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <div class="h4"></div>
            <div>
                <a href="{{ route('employees.index') }}" class="btn btn-primary">View List</a>
            </div>
        </div>
  
           <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old ('name')}}">
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
            
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="form-check">
                    <input type="radio" name="gender" id="genderM" value="male" class="form-check-input">
                    <label for="genderM" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                    <input type="radio" name="gender" id="genderF" value="female" class="form-check-input">
                    <label for="genderF" class="form-check-label">Female</label>
                    </div>
                    <div class="form-check">
                    <input type="radio" name="gender" id="genderO" value="other" class="form-check-input">
                    <label for="genderO" class="form-check-label">Other</label>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="dateofbirth">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="{{ old ('date')}}">
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" cols="30" rows="4" placeholder="Enter Address" class="form-control" >{{ old ('address')}}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="hobbies">Hobbies</label><br>
                    <input type="checkbox" name="hobbies[]" id="hobbies_sports" value="sports" class="form-check-input"
                    {{ in_array('sports', old('hobbies', [])) ? 'checked' : '' }}>
                    Sports
                    <input type="checkbox" name="hobbies[]" id="hobbies_music" value="music" class="form-check-input"
                    {{ in_array('music', old('hobbies', [])) ? 'checked' : '' }}>
                    Music
                    <input type="checkbox" name="hobbies[]" id="hobbies_reading" value="reading" class="form-check-input"
                    {{ in_array('reading',old('hobbies', [])) ? 'checked' : '' }}>
                    Reading
                    <input type="checkbox" name="hobbies[]" id="hobbies_traveling" value="traveling" class="form-check-input"
                    {{ in_array('traveling', old('hobbies', [])) ? 'checked' : '' }}>
                    Traveling
                    <br>
                </div>



                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 100px;">
                </div>

            </div>
        </div>
        <button class="btn btn-primary mt-3" onclick="addEmployee({{ $employee->id }})">Save Information</button>
        <form id="employee-success-action-{{ $employee->id }}" action="{{ route('employees.create',$employee->id)}}" method="get">
                                
                @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div>
                @endif
                </form>
        </form>
    </div>
    <script>
    $(document).ready(function() {
        
        $('input[type="file"]').change(function(e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                    $('#image-preview').show();
                };
                reader.readAsDataURL(file);
            }
        });
    });
    </script>
    <script>
function addEmployee(employeeId) {
    if (confirm("Data Added Successfully")) {
        document.getElementById('employee-success-action-' + employeeId).submit();
    }
}
</script>


        

</body>
</html>
