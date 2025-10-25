@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Footer Info') }}</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Footer Info Settings') }}</h4>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="footerTab" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $language->lang }}"
                                data-toggle="tab" href="#footer-{{ $language->lang }}" role="tab"
                                aria-controls="footer-{{ $language->lang }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="footerTabContent">
                    @foreach ($languages as $language)
                        @php
                            // Fetch footer info for this specific language
                            $footerInfo = \App\Models\FooterInfo::where('language', $language->lang)->first();
                        @endphp

                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="footer-{{ $language->lang }}"
                            role="tabpanel">

                            <form method="POST" action="{{ route('admin.footer-info.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="language" value="{{ $language->lang }}">

                                {{-- Logo --}}
                                <div class="form-group">
                                    <label>{{ __('Logo') }} :</label>
                                    @if (!empty($footerInfo?->logo))
                                        <div class="mb-2">
                                            <img src="{{ asset($footerInfo->logo) }}" alt="Logo" height="60">
                                        </div>
                                    @endif
                                    <input type="file" name="logo" class="form-control">
                                </div>

                                {{-- Short Description --}}
                                <div class="form-group">
                                    <label>{{ __('Short Description') }} :</label>
                                    <textarea name="short_description" class="form-control" rows="4">{{ old('short_description', $footerInfo->description ?? '') }}</textarea>
                                </div>

                                {{-- Copyright Text --}}
                                <div class="form-group">
                                    <label>{{ __('Copyright Text') }} :</label>
                                    <input type="text" name="copy_right" class="form-control"
                                        value="{{ old('copy_right', $footerInfo->copyright ?? '') }}">
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: "{{ $error }}"
                });
            @endforeach
        @endif
    </script>
@endpush
