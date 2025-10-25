@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Footer Grid') }}</h1>
        </div>

        {{-- Title Update Form --}}
        <div class="card card-primary">
            <div class="card-body">
                <ul class="nav nav-tabs" id="titleTab" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="title-tab-{{ $language->lang }}"
                                data-toggle="tab" href="#title-{{ $language->lang }}" role="tab"
                                aria-controls="title-{{ $language->lang }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content tab-bordered" id="titleTabContent">
                    @foreach ($languages as $language)
                        @php
                            $footerGridOneTitle = \App\Models\FooterTitle::where([
                                'key' => 'grid_one_title',
                                'language' => $language->lang,
                            ])->first();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="title-{{ $language->lang }}"
                            role="tabpanel" aria-labelledby="title-tab-{{ $language->lang }}">
                            <div class="card-body">
                                <form action="{{ route('admin.footer-grid-one-title') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">{{ __('Footer Title') }}</label>
                                        <input type="text" value="{{ $footerGridOneTitle->value ?? '' }}"
                                            class="form-control" name="title">
                                        <input type="hidden" value="{{ $language->lang }}" name="language">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Footer Grid One Listing --}}
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Footer Grid One') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.footer-grid-one.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create new') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="gridTab" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="grid-tab-{{ $language->lang }}"
                                data-toggle="tab" href="#grid-{{ $language->lang }}" role="tab"
                                aria-controls="grid-{{ $language->lang }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content tab-bordered" id="gridTabContent">
                    @foreach ($languages as $language)
                        @php
                            $footerGridOne = \App\Models\FooterGridOne::where('language', $language->lang)
                                ->orderByDesc('id')
                                ->get();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="grid-{{ $language->lang }}"
                            role="tabpanel" aria-labelledby="grid-tab-{{ $language->lang }}">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-{{ $language->lang }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Url') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($footerGridOne as $gridOne)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $gridOne->name }}</td>
                                                    <td>{{ $gridOne->url }}</td>
                                                    <td>
                                                        @if ($gridOne->status == 1)
                                                            <span class="badge badge-success">{{ __('Yes') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('No') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.footer-grid-one.edit', $gridOne->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.footer-grid-one.destroy', $gridOne->id) }}"
                                                            method="POST" style="display:inline-block"
                                                            onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger delete-item"
                                                                title="Delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">
                                                        {{ __('No data found.') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        @foreach ($languages as $language)
            $(document).ready(function() {
                $('#table-{{ $language->lang }}').DataTable({
                    "columnDefs": [{
                        "orderable": false,
                        "targets": [3, 4]
                    }]
                });
            });
        @endforeach
    </script>
@endpush
