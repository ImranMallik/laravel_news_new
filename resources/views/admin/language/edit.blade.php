 @extends('admin.layouts.master')
 @section('content')
     <section class="section">
         <div class="section-header">
             <h1>{{ __('Edit Language') }}</h1>
         </div>
         <div class="card card-primary">
             <div class="card-header">
                 <h4>{{ __('Edit Language') }}</h4>
             </div>
             <div class="card-body">

                 <form id="languageForm" action="{{ route('admin.language.update', $language->id) }}" method="POST"
                     name="languageForm">
                     @csrf
                     @method('PUT')

                     <div class="row">
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="language">{{ __('Language') }} :</label>
                                 <select name="language" id="language" class="form-control select2">
                                     <option value="">--{{ __('Select') }}--</option>
                                     @foreach (config('language') as $key => $lang)
                                         <option value="{{ $key }}"
                                             {{ $language->lang === $key ? 'selected' : '' }}>
                                             {{ $lang['name'] }}
                                         </option>
                                     @endforeach
                                 </select>
                                 <small class="text-danger d-none"
                                     id="languageError">{{ __('Language is required') }}.</small>
                             </div>
                         </div>

                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="slug">{{ __('Slug') }} :</label>
                                 <input type="text" readonly class="form-control" name="slug" id="slug"
                                     value="{{ $language->slug }}">
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="name">{{ __('Name') }} :</label>
                                 <input type="text" readonly class="form-control" name="name" id="name"
                                     value="{{ $language->name }}">
                             </div>
                         </div>


                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="is_default">{{ __('Is Default') }}:</label>
                                 <select name="is_default" id="is_default" class="form-control">
                                     <option value="">--{{ __('Select') }}--</option>
                                     <option value="0" {{ $language->is_default == 0 ? 'selected' : '' }}>
                                         {{ __('No') }}</option>
                                     <option value="1" {{ $language->is_default == 1 ? 'selected' : '' }}>
                                         {{ __('Yes') }}</option>
                                 </select>
                             </div>
                         </div>

                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="status">{{ __('Status') }} :</label>
                                 <select name="status" id="status" class="form-control">
                                     <option value="">--{{ __('Select') }}--</option>
                                     <option value="1" {{ $language->status == 1 ? 'selected' : '' }}>
                                         {{ __('Active') }}</option>
                                     <option value="0" {{ $language->status == 0 ? 'selected' : '' }}>
                                         {{ __('Inactive') }}
                                     </option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <div class="mt-3 d-flex justify-content-end">
                         <button type="submit" class="btn btn-primary" id="saveBtn">
                             <i class="fas fa-save"></i> <span>{{ __('Update') }}</span>
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
             function toggleSaveButton() {
                 const languageValue = $('#language').val();
                 $('#saveBtn').prop('disabled', !languageValue);
             }
             toggleSaveButton();
             $('#language').on('change', function() {
                 const selectedValue = $(this).val();
                 const selectedText = $(this).children(':selected').text();
                 $('#slug').val(selectedValue);
                 $('#name').val(selectedText);
                 toggleSaveButton();
             });
         });
     </script>
 @endpush
