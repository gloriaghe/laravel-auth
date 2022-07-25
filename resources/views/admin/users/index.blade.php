@extends('admin.layouts.base')
@section('mainContent')

<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Birth</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr data-id="{{ $user->id }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->userDetails()->get()->address }}</td>
                <td>{{ $user->userDetails()->get()->birth }}</td>
                <td>{{ $user->userDetails()->get()->phone }}</td>

                {{-- <td>
                    <a href="{{ route('admin.user.show', ['user' => $user]) }}" class="btn btn-primary">View</a>
                </td>
                <td>
                    <a href="{{ route('admin.user.edit', ['user' => $user]) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <button class="btn btn-danger js-delete">Delete</button>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>

{{ $user->links() }}

<section class="overlay d-none">
    <form class="popup" data-action="{{ route('admin.user.destroy', ['user' => '*****']) }}" method="user">
        @csrf
        @method('DELETE')

        <h1>Sei sicuro?</h1>
        <button type="submit" class="btn btn-warning js-yes">Yes</button>
        <button type="button" class="btn btn-danger js-no">No</button>
    </form>
</section>
@endsection
