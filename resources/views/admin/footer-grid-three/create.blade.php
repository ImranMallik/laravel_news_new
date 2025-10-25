 @extends('admin.layouts.master')
 @section('content')
     <section class="section">
         <div class="section-header">
             <h1>{{ __('Footer Grid') }}</h1>
         </div>
         <div class="card card-primary">
             <div class="card-header">
                 <h4>{{ __('Create Footer Grid Three') }}</h4>
             </div>
             <div class="card-body">

                 <form id="languageForm" action="{{ route('admin.footer-grid-three.store') }}" method="POST" name="languageForm">
                     @csrf
                     <div class="row">
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="language">{{ __('Language') }} :</label>
                                 <select name="language" id="language" class="form-control select2">
                                     <option value="">--{{ __('Select') }}--</option>
                                     @foreach ($languages as $lang)
                                         <option value="{{ $lang->lang }}">{{ $lang->name }}</option>
                                     @endforeach
                                 </select>
                                 <small class="text-danger d-none"
                                     id="languageError">{{ __('Language is required') }}.</small>
                             </div>

                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="name">{{ __('Name') }} :</label>
                                 <input type="text" class="form-control" name="name" id="name">
                             </div>
                         </div>
                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="name">{{ __('Url') }} :</label>
                                 <input type="text" class="form-control" name="url" id="name">
                             </div>
                         </div>

                         <div class="col-md-3">
                             <div class="form-group">
                                 <label for="status">{{ __('Status') }} :</label>
                                 <select name="status" id="status" class="form-control">
                                     <option value="">--{{ __('Select') }}--</option>
                                     <option value="1">{{ __('Active') }}</option>
                                     <option value="0">{{ __('Inactive') }}</option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <div class="mt-3 d-flex justify-content-end">
                         <button type="submit" class="btn btn-primary" id="saveBtn" disabled>
                             <i class="fas fa-save"></i> <span>{{ __('Save') }}</span>
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
                 //  $('#slug').val(selectedValue);
                 //  $('#name').val(selectedText);
                 toggleSaveButton();
             });
         });
     </script>
 @endpush
