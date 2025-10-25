 @extends('admin.layouts.master')
 @section('content')
     <section class="section">
         <div class="section-header">
             <h1>{{ __('Social Link') }}</h1>
         </div>

         <div class="card card-primary">
             <div class="card-header">
                 <h4>{{ __('Edit Social Link') }}</h4>
             </div>

             <div class="card-body">
                 <form id="languageForm" action="{{ route('admin.social-link.update', $socialLinks->id) }}" method="POST" name="languageForm">
                     @csrf
                     @method('PUT')
                     <div class="row">

                         {{-- Icon Picker --}}
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label>{{ __('Icon') }}</label>
                                 <br>
                                 <button class="btn btn-primary" name="icon" role="iconpicker" data-icon="{{$socialLinks->icon}}"></button>
                             </div>
                         </div>

                         {{-- Link URL --}}
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="url">{{ __('Url') }}</label>
                                 <input type="text" name="url" class="form-control" id="url" value="{{$socialLinks->url}}">
                                 @error('url')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                         </div>


                         {{-- Status --}}
                         <div class="col-md-4">
                             <div class="form-group">
                                 <label for="status">{{ __('Status') }}</label>
                                 <select name="status" id="status" class="form-control">
                                     <option value="">-- {{ __('Select') }} --</option>
                                     <option value="1" {{ $socialLinks->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                     <option value="0" {{ $socialLinks->status == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                 </select>
                                 @error('status')
                                     <p class="text-danger">{{ $message }}</p>
                                 @enderror
                             </div>
                         </div>

                     </div> {{-- End row --}}

                     {{-- Submit Button --}}
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

 @push('scripts')
 @endpush
