
<html>
    <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
<x-layout>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employees</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @if (isset($employee))
                                <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employees</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            @else
                                <li class="breadcrumb-item active">Employees</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="content">
        <section class="content">
            <div class="container-fluid">
                <form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">
                                        {{ isset($employee) ? 'Update' : 'Add New' }} Employee</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <div class="row">
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="firstname">First Name:</label>
                                                <input type="text" name="firstname" id="firstname"
                                                    class="form-control" placeholder="First Name"
                                                    value="{{ old('firstname', $employee->firstname ?? '') }}" required>
                                            </div>
                                            @error('firstname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="middlename">Middle Name:</label>
                                                <input type="text" name="middlename" id="middlename"
                                                    class="form-control" placeholder="Middle Name"
                                                    value="{{ old('middlename', $employee->middlename ?? '') }}"
                                                    required>
                                            </div>
                                            @error('middlename')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="lastname">Last Name:</label>
                                                <input type="text" name="lastname" id="lastname"
                                                    class="form-control" placeholder="Last Name"
                                                    value="{{ old('lastname', $employee->lastname ?? '') }}" required>
                                            </div>
                                            @error('lastname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="dob">Date of Birth:</label>
                                                <input type="date" name="dob" id="dob" class="form-control"
                                                    placeholder="Date of Birth"
                                                    value="{{ old('dob', $employee->dob ?? '') }}" required>
                                            </div>
                                            @error('dob')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="email">Email:</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Email Address"
                                                    value="{{ old('email', $employee->email ?? '') }}" required>
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="mobile">Mobile Number:</label>
                                                <input type="number" name="mobile" id="mobile" min="1000000000"
                                                    max="9999999999" class="form-control" placeholder="Mobile Number"
                                                    value="{{ old('mobile', $employee->mobile ?? '') }}"required>
                                            </div>
                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="address">Address:</label>
                                                <textarea name="address" id="address" class="form-control" placeholder="Address" rows="3" required>{{ old('address', $employee->address ?? '') }}</textarea>
                                            </div>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="address">Select State</label>
                                                <select name="state" id="state" class="form-control">
                                               <option value="">--Select State--</option>
                                                @isset($employee)
                                                     @foreach ($states as $data)
                                                            <option value="{{$data->st_id}}">
                                                                  {{$data->statename}}
                                                             </option>
                                                     @endforeach
                                                @endisset
                                                 </select>
                                            </div>
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="address">Select City</label>
                                                <select name="city" id="city" class="form-control"></select>
                                            </div>
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="Profile Picture">Profile Picture :</label>
                                                
                                                <input type="file" id="profile" name="profile" placeholder="Please Choose File" value="{{ old('image') }}" class="form-control" />  
                                                <br/>
                                                @isset($employee)
                                                <img src="{{ asset("public/images/" . $employee->image)}}" width="100" />
                                                    @endisset
                                            </div>
                                            @error('profile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="Resume">Upload Resume :</label>
                                                
                                                <input type="file" id="resume" name="resume" placeholder="Please Choose File"  class="form-control" />  
                                                <br>

                                                @isset($employee)
                                                <a href="{{ asset("public/images/" . $employee->file)}}">View Uploaded Pdf</a>
                                                    @endisset
                                            </div>
                                            @error('resume')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="submit"
                                        value="{{ isset($employee) ? 'Update Employee' : 'Add Employee' }}"
                                        class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @isset($employees)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">All Employees</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    @if ($employees->count() > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Date of Birth</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Address</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Profile Picture</th>
                                                    <th>Resume</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $employee)
                                                    <tr>
                                                        <td>{{ $employee->firstname }} {{ $employee->middlename }}
                                                            {{ $employee->lastname }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($employee->dob)) }}</td>
                                                        <td>{{ $employee->email }}</td>
                                                        <td>{{ $employee->mobile }}</td>
                                                        <td>{{ $employee->address }}</td>
                                                        <td>{{ $employee->state }}</td>
                                                        <td>{{ $employee->city}}</td>
                                            
                                                        <td><img width="80px" height="80px" src="{{ asset("public/images/" . $employee->image)}}"></td>
                                                        <td><a href="{{ asset("public/images/" . $employee->file)}}">View Uploaded Pdf</a></td>
                                                        <td>
                                                            <a href="{{ route('employees.edit', ['employee' => $employee->emp_id]) }}"
                                                                class="btn btn-success btn-sm">Edit</a>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('employees.delete', ['employee' => $employee->emp_id]) }}"
                                                                class="btn btn-danger btn-sm">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <h2 class="mt-3 mb-4 text-center font-weight-bold">No Employees to Display</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
                
            </div>
        </section>
    </x-slot>
</x-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        $(document).ready(function () {
            $('#state').on('change', function () {
                var idState = $(this).val();
                $("#city").html('');
                $.ajax({
                    url: "{{url('fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city").append('<option value="' + value
                                .id + '">' + value.cityname + '</option>');
                        });
                    }
                });
            });
  
        });
    </script>
    </body>
</html>



