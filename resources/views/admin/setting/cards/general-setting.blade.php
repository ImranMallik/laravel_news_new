 <div class="card border border-primary">
     <div class="card-body">
         <form action="{{ route('admin.setting-setting.update') }}" method="POST" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="form-group">
                 <label for="site_name">{{ __('Site Name') }}</label>
                 <input type="text" id="site_name" name="site_name" class="form-control"
                     value="{{ old('site_name', $setting['site_name'] ?? '') }}">
                 @error('site_name')
                     <p class="text-danger">{{ $message }}</p>
                 @enderror
             </div>

             <div class="form-group">
                 @if (!empty($setting['site_logo']))
                     <div class="mb-2">
                         <img src="{{ asset($setting['site_logo']) }}" alt="Site Logo"
                             style="height: 60px; border: 1px solid #ddd; padding: 4px; border-radius: 5px;">
                     </div>
                 @endif

                 <label for="site_logo">{{ __('Site Logo') }}</label>
                 <input type="file" id="site_logo" name="site_logo" class="form-control">
             </div>


             <div class="form-group">
                 @if (!empty($setting['site_favicon']))
                     <div class="mb-2">
                         <img src="{{ asset($setting['site_favicon']) }}" alt="Favicon"
                             style="height: 60px; border: 1px solid #ddd; padding: 4px; border-radius: 5px;">
                     </div>
                 @endif

                 <label for="site_favicon">{{ __('Site Favicon') }}</label>
                 <input type="file" id="site_favicon" name="site_favicon" class="form-control">
             </div>


             <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
         </form>
     </div>
 </div>
