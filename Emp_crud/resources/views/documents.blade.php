<x-layout>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Upload Documents</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @if (isset($documents))
                                <li class="breadcrumb-item"><a href="{{ route('employees') }}">Employees</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            @else
                                <li class="breadcrumb-item active">Upload Documents</li>
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
                                        {{ isset($documents) ? 'Update' : 'Add New' }} Document</h3>
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
                                                <label for="docno">Document No:</label>
                                                <input type="text" name="docno" id="docno"
                                                    class="form-control" placeholder="Enter Document No:"
                                                    value="" required>
                                            </div>
                                            @error('docno')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="Docname">Document Name:</label>
                                                <input type="text" name="docname" id="docname"
                                                    class="form-control" placeholder="Enter Document Name"
                                                    value=""
                                                    required>
                                            </div>
                                            @error('docname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                      
                                      
                                        
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4 pb-3">
                                            <div class="form-group mb-0">
                                                <label for="Upload Document">Upload Document</label>
                                                
                                                <input type="file" id="uploadoc" name="uploadoc" placeholder="Please Choose File" value="{{ old('image') }}" class="form-control" required/>  

                                            </div>
                                            @error('uploadoc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="submit"
                                        value="{{ isset($documents) ? 'Update Document' : 'Add Document' }}"
                                        class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @isset($documents)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">All Documents</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    @if ($documents->count() > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Date of Birth</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Address</th>
                                                    <th>Profile Picture</th>
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
                                                        <td><img width="80px" height="80px" src="{{ asset("public/images/" . $employee->image)}}"></td>
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
