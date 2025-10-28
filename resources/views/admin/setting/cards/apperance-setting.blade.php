<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.appearance-setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>{{ __('Pick Your Color') }}</label>
                <div class="input-group colorpickerinput">
                    <input type="text" class="form-control" name="color" id="color"
                        value="{{ old('color', $setting['site_color'] ?? '#000000') }}">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-fill-drip" id="color-icon"
                                style="color: {{ old('color', $setting['site_color'] ?? '#000000') }}"></i>
                        </div>
                    </div>
                </div>

                @error('color')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $(".colorpickerinput").colorpicker({
                format: 'hex',
                component: '.input-group-append',
            });
        });
    </script>
@endpush
