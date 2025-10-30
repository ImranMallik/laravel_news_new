@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Role and Permissions') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Create Role') }}</h4>
            </div>

            <div class="card-body">
                <form id="languageForm" action="{{ route('admin.role.store') }}" method="POST" name="languageForm">
                    @csrf

                    <div class="form-group">
                        <label for="role_name">{{ __('Role Name') }}</label>
                        <input type="text" class="form-control" id="role_name" name="role" required>
                    </div>

                    @foreach ($permissions as $groupName => $permission)
                        <div class="form-group">
                            <h6>{{ __($groupName) }}</h6>
                            <div class="row">
                                @foreach ($permission as $item)
                                    <div class="col-md-3">
                                        <label class="custom-switch mt-2">
                                            <input type="checkbox" name="permissions[]" value="{{ $item->name }}"
                                                class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">{{ $item->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach


                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="saveBtn">
                            <i class="fas fa-save"></i> {{ __('Save') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
