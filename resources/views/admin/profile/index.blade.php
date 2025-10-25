@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Profile') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>

        <div class="section-body">
            <h6 class="section-lead">
                {{ __('Change information about yourself on this page.') }}
            </h6>

            <div class="row mt-sm-4">
                <!-- Profile Info Update Form -->
                <div class="col-12 col-md-6">
                    <div class="card">
                        <form method="POST"
                            action="{{ route('admin.profile.update', auth()->guard('admin')->user()->id) }}"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{ __('Edit Profile') }}</h4>
                            </div>
                            <div class="card-body">

                                <!-- Profile Image -->
                                <div id="image-preview" style="height: 200px;width:200px" class="image-preview  mb-3">
                                    <label for="image-upload" id="image-label">{{ __('Choose Image') }}</label>
                                    <input type="file" name="image" id="image-upload" accept="image/*" />
                                    <input type="hidden" name="old_image" value="{{ $user->image }}">
                                </div>
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                                <!-- Name -->
                                <div class="form-group col-12">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                        required>
                                    <div class="invalid-feedback">
                                        {{ __('Please fill in the name') }}
                                    </div>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group col-12">
                                    <label>{{ __('Email') }}</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        required>
                                    <div class="invalid-feedback">
                                        {{ __('Please fill in the email') }}
                                    </div>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Update Form -->
                <div class="col-12 col-md-6">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.profile-password.update', $user->id) }}"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{ __('Update Password') }}</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group col-12">
                                    <label>{{ __('Old Password') }}</label>
                                    <input type="password" name="old_password" class="form-control" required>
                                    <div class="invalid-feedback">
                                        {{ __('Please fill in the old password') }}
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{ __('New Password') }}</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                    <div class="invalid-feedback">
                                        {{ __('Please fill in the new password') }}
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                    <div class="invalid-feedback">
                                        {{ __('Please confirm the new password') }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @if (!empty($user->image))
                $('.image-preview').css({
                    'background-image': 'url("{{ asset($user->image) }}")',
                    'background-size': 'cover',
                    'background-position': 'center'
                });
            @endif
        });
    </script>
@endpush
