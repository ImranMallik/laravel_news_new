<div class="card border border-primary">
    <div class="card-body">
        <form action="{{ route('admin.seo-setting.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- SEO Title --}}
            <div class="form-group">
                <label for="site_name">{{ __('SEO Title') }}</label>
                <input type="text" id="seo_title" name="seo_title" class="form-control"
                    value="{{ old('seo_title', $setting['seo_title'] ?? '') }}">
                @error('seo_title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- SEO Description --}}
            <div class="form-group">
                <label for="seo_description">{{ __('SEO Description') }}</label>
                <textarea id="seo_description" name="seo_description" class="form-control" style="height: 300px;" rows="10">{{ old('seo_description', $setting['seo_description'] ?? '') }}</textarea>
                @error('seo_description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- SEO Keywords --}}
            <div class="form-group">
                <label for="seo_keywords">{{ __('SEO Keywords') }}</label>
                <input type="text" id="seo_keywords" name="seo_keywords" class="form-control inputtags"
                    value="{{ old('seo_keywords', $setting['seo_keywords'] ?? '') }}">
                @error('seo_keywords')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
    </div>
</div>
