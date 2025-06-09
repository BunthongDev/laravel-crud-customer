{{-- // Extending the main layout --}}
@extends('layouts.app')


@section('content')
    {{-- Success Message --}}
    {{-- This will show a success message when a customer is created or updated successfully by using SweetAlert2 --}}
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: @json(session('success')),
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
@endif

    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This customer will be deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('.form-' + id).submit();
            }
        })
    }
    </script>
    {{-- customer index UI file --}}
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3>Customers</h3>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('customers.create') }}" class="btn"
                                style="background-color: #4643d3; color: white;"><i class="fas fa-plus"></i> Create
                                Customer</a>
                        </div>
                        {{-- search form input --}}
                        <div class="col-md-8">
                            <form action="{{ route('customers.index') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search anything..."
                                        aria-describedby="button-addon2" name="search" value"{{ request()->search }}">
                                    <button class="btn btn-outline-secondary" type="submit"
                                        id="button-addon2">Search</button>
                                </div>
                                {{-- Sort Dropdown --}}
                                <div class="input-group mb-3">
                                    <select class="form-select" name="sort" id="sortSelect" onchange="this.form.submit()">
                                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest to Old</option>
                                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Old to Newest</option>
                                    </select>
                                </div>
                            </form>
                            
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="border: 1px solid #dddddd">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">BAN</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through customers --}}
                            @foreach ($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $customer->first_name }}</td>
                                    <td>{{ $customer->last_name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->bank_account_number }}</td>
                                    <td>
                                        <a href="{{ route('customers.edit', $customer->id) }}" style="color: #2c2c2c;"
                                            class="ms-1 me-1"><i class="far fa-edit"></i></a>
                                        <a href="{{ route('customers.show', $customer->id) }}" style="color: #2c2c2c;"
                                            class="ms-1 me-1"><i class="far fa-eye"></i></a>
                                        {{-- using form submission for delete mix with javascript & jquery --}}
                                        <a href="javascript:;" onclick="confirmDelete({{ $customer->id }})"
                                            style="color: #2c2c2c;" class="ms-1 me-1"><i class="fas fa-trash-alt"></i></a>
                                        <form class="form-{{ $customer->id }}"
                                            action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit" style="border: none; background: none; color: #2c2c2c;" class="ms-1 me-1"><i class="fas fa-trash-alt"></i></button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


