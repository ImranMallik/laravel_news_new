@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Social Count') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Edit Social Link') }}</h4>
            </div>

            <div class="card-body">
                <form id="languageForm" action="{{ route('admin.social-count.update', $socialCount->id) }}" method="POST"
                    name="languageForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Language --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="language">{{ __('Language') }} <span class="text-danger">*</span></label>
                                <select name="language" id="language" class="form-control select2">
                                    <option value="">-- {{ __('Select') }} --</option>
                                    @foreach ($languages as $lang)
                                        <option value="{{ $lang->lang }}"
                                            {{ $socialCount->language == $lang->lang ? 'selected' : '' }}>
                                            {{ $lang->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger d-none"
                                    id="languageError">{{ __('Language is required') }}.</small>
                            </div>
                        </div>

                        {{-- Icon Picker --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Icon') }}</label>
                                <br>
                                <button class="btn btn-primary" name="icon" role="iconpicker"
                                    data-icon="{{ $socialCount->icon }}"></button>
                                <input type="hidden" name="icon" id="iconInput" value="{{ $socialCount->icon }}">
                            </div>
                        </div>

                        {{-- Fan Count --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fan_count">{{ __('Fan Count') }}</label>
                                <input type="text" class="form-control" name="fan_count" id="fan_count"
                                    value="{{ old('fan_count', $socialCount->fan_count) }}">
                                @error('fan_count')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Fan Type --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fan_type">{{ __('Fan Type') }}</label>
                                <input type="text" name="fan_type" class="form-control" id="fan_type"
                                    value="{{ old('fan_type', $socialCount->fan_type) }}"
                                    placeholder="ex: likes, fans, followers">
                                @error('fan_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Button Text --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="button_text">{{ __('Button Text') }}</label>
                                <input type="text" name="button_text" class="form-control" id="button_text"
                                    value="{{ old('button_text', $socialCount->button_text) }}"
                                    placeholder="ex: Subscribe, Follow">
                                @error('button_text')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Link URL --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="url">{{ __('Url') }}</label>
                                <input type="text" name="url" class="form-control" id="url"
                                    value="{{ old('url', $socialCount->url) }}">
                                @error('url')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Color Picker --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('Pick Your Color') }}</label>
                                <div class="input-group colorpickerinput">
                                    <input type="text" class="form-control" name="color" id="color"
                                        value="{{ old('color', $socialCount->color) }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-fill-drip"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- {{ __('Select') }} --</option>
                                    <option value="1" {{ $socialCount->status == 1 ? 'selected' : '' }}>
                                        {{ __('Active') }}</option>
                                    <option value="0" {{ $socialCount->status == 0 ? 'selected' : '' }}>
                                        {{ __('Inactive') }}</option>
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" id="saveBtn">
                            <i class="fas fa-save"></i> {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".colorpickerinput").colorpicker({
                format: 'hex',
                component: '.input-group-append',
            });

            // Initialize iconpicker
            $('[role="iconpicker"]').on('change', function(e) {
                $('#iconInput').val(e.icon);
            });
        });
    </script>
@endpush
