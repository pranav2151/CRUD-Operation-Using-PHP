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
            <div class="h4">Edit Details Here</div>
            <div>
                <a href="{{ route('employees.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
  
        <form action="{{ route('employees.update',$employee->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old ('name',$employee->name)}}">
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
            
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div class="form-check">
                    <input type="radio" name="gender" id="genderM" class="form-check-input" value="male" {{ old('gender', $employee->gender) === 'male' ? 'checked' : '' }}>
                    <label for="genderM" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                    <input type="radio" name="gender" id="genderF" value="female" class="form-check-input" value="female" {{ old('gender', $employee->gender) === 'female' ? 'checked' : '' }}>
                    <label for="genderF" class="form-check-label">Female</label>
                    </div>
                    <div class="form-check">
                    <input type="radio" name="gender" id="genderO" value="other" class="form-check-input" value="other" {{ old('gender', $employee->gender) === 'other' ? 'checked' : '' }}>
                    <label for="genderO" class="form-check-label">Other</label>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="dateofbirth">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', $employee->dob) }}">
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" cols="30" rows="4" placeholder="Enter Address" class="form-control"> {{ old ('address',$employee->address)}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="hobbies">Hobbies</label><br>
                    <input type="checkbox" name="hobbies[]" id="hobbies_sports" value="sports" class="form-check-input"
                    {{ in_array('sports', explode(',', $employee->hobbies)) ? 'checked' : '' }}>
                    Sports
                    <input type="checkbox" name="hobbies[]" id="hobbies_music" value="music" class="form-check-input"
                    {{ in_array('music', explode(',', $employee->hobbies)) ? 'checked' : '' }}>
                    Music
                    <input type="checkbox" name="hobbies[]" id="hobbies_reading" value="reading" class="form-check-input"
                    {{ in_array('reading', explode(',', $employee->hobbies)) ? 'checked' : '' }}>
                    Reading
                    <input type="checkbox" name="hobbies[]" id="hobbies_traveling" value="traveling" class="form-check-input"
                    {{ in_array('traveling', explode(',', $employee->hobbies)) ? 'checked' : '' }}>
                    Traveling
                    <br>
                </div>



                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    <div class="pt-3">
                    @if($employee->image !='' && file_exists(public_path().'/uploads/employees/'.$employee->image))
                            <img src="{{ url('uploads/employees/'.$employee->image) }}" width="100" alt="" height="100">
                    @endif
                    </div>
                </div>

            </div>
        </div>
        <button class="btn btn-primary my-3"> Update Information </button>
        </form>
    </div>
        

</body>
</html>
