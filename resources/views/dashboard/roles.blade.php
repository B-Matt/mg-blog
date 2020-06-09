@extends('layouts.dashboard')

@section('content')
<h1>Modify Roles</h1>

<div class="container-fluid mt-4">
    <div class="row mb-3">
        <div class="col font-weight-bold text-muted">Role Name</div>
        <div class="col text-center font-weight-bold text-muted">Read Posts</div>
        <div class="col text-center font-weight-bold text-muted">Write Posts</div>
        <div class="col text-center font-weight-bold text-muted">Delete Posts</div>
        <div class="col text-center font-weight-bold text-muted">Modify Posts</div>
        <div class="col text-center font-weight-bold text-muted">Add/Delete/Modify Users</div>
        <div class="col text-center font-weight-bold text-muted"></div>
    </div>

    @foreach($roles as $role)
    <form method="POST" enctype="multipart/form-data" action="{{ route('roles.update', $role) }}">
        @csrf
        <div class="row">        
            <div class="col">{{ $role->name }}</div>
            <input type="hidden" name="id" value="{{ $role->id }}" />
            <div class="col text-center">
                <input type="checkbox" name="read" value="{{ $role->perm_read }}" {{ $role->perm_read == 1 ? 'checked' : '' }}>
            </div>
            <div class="col text-center">
                <input type="checkbox" name="write" value="{{ $role->perm_write }}" {{ $role->perm_write == 1 ? 'checked' : '' }}>
            </div>
            <div class="col text-center">
                <input type="checkbox" name="delete" value="{{ $role->perm_delete }}" {{ $role->perm_delete == 1 ? 'checked' : '' }}>
            </div>
            <div class="col text-center">
                <input type="checkbox" name="modify" value="{{ $role->perm_update }}" {{ $role->perm_update == 1 ? 'checked' : '' }}>
            </div>
            <div class="col text-center">
                <input type="checkbox" name="users" value="{{ $role->perm_users }}" {{ $role->perm_users == 1 ? 'checked' : '' }}>
            </div>
            <div class="col text-center">
                <input type="checkbox" name="admin" value="{{ $role->perm_su }}" {{ $role->perm_su == 1 ? 'checked' : '' }}>
            </div>
            <div class="col">
            @method('patch')
                <button type="submit" class="btn btn-link" title="Save roles">Save</button>
            </div>
        </div>
    </form>
    @endforeach    
</div>
@endsection