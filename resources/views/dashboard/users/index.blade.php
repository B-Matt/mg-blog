@extends('layouts.dashboard')

@section('notification')
{!! \Session::get('notification') !!}
@endsection

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 ml-4 mb-0">{{ __('main.all_users') }}</h1>                    
</div>

<div class="container-fluid mb-5">
    <div class="row">
        <div class="col w-100">
            <!-- Accordion -->
            <div id="usersAccord" class="accordion shadow">

                @foreach ($users as $user)
                <div class="card">
                    <div id="heading{{ $loop->iteration }}" class="card-header bg-white shadow-sm border-0">
                        <h6 class="mb-0 font-weight-bold">                            
                            <a href="#" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                aria-controls="collapse{{ $loop->iteration }}"
                                class="d-block position-relative text-dark text-uppercase collapsible-link py-2">
                                {{ $user->name }}
                            </a>
                        </h6>
                    </div>
                    <div id="collapse{{ $loop->iteration }}" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#usersAccord"
                        class="collapse">
                        <div class="dash-body card-body p-5">                     
                            <div class="d-inline-flex float-right">
                                <a href="{{ route('users.edit', $user) }}" class="mr-3" title="Edit user details">
                                    <i class="dash-icon flaticon-pencil"></i>
                                </a>                                
                                <form method="post" action="{{ route('users.destroy', $user) }}" class="mr-3">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link p-0" title="{{ __('main.user_delete') }}">
                                        <i class="dash-icon flaticon-trash-bin"></i>
                                    </button>                                    
                                </form>
                            </div>
                            <span class="m-0 mt-4">
                                <div class="form-group mt-0 mb-0">
                                    <strong>{{ __('main.name') }}:</strong> {{ $user->name }}
                                </div>
                                <div class="form-group mt-2 mb-0">
                                    <strong>{{ __('main.email') }}:</strong> {{ $user->email }}
                                </div>
                                <div class="form-group mt-2 mb-0">
                                    <strong>{{ __('main.user_about') }}:</strong> {!! $user->about !!}
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
