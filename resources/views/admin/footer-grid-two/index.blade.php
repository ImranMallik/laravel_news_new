@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Footer Grid') }}</h1>
        </div>

        {{-- Footer Grid two --}}
       
        <div class="card card-primary">
            <div class="card-body">

                
                <ul class="nav nav-tabs" id="gridTwoTabs" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                            id="gridtwo-tab-{{ $language->lang }}"
                            data-toggle="tab"
                            href="#gridtwo-{{ $language->lang }}"
                            role="tab"
                            aria-controls="gridtwo-{{ $language->lang }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

            <div class="tab-content tab-bordered" id="gridTwoTabsContent">
                    @foreach ($languages as $language)
                        @php
                            $footerGridTwoTitle = \App\Models\FooterTitle::where([
                                'key' => 'grid_two_title',
                                'language' => $language->lang,
                            ])->first();
                        @endphp

                        <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}"
                            id="gridtwo-{{ $language->lang }}"
                            role="tabpanel"
                            aria-labelledby="gridtwo-tab-{{ $language->lang }}">

                            <div class="card-body">
                                <form action="{{ route('admin.footer-grid-two-title') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>{{ __('Footer Title') }}</label>
                                        <input type="text"
                                            class="form-control"
                                            name="title"
                                            value="{{ $footerGridTwoTitle->value ?? '' }}">
                                        <input type="hidden" name="language" value="{{ $language->lang }}">
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


        {{-- Footer Grid Two --}}
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Footer Grid Two') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.footer-grid-two.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create new') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="gridTwoTabs" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="gridtwo-tab-{{ $language->lang }}"
                                data-toggle="tab" href="#gridtwo-{{ $language->lang }}" role="tab"
                                aria-controls="gridtwo-{{ $language->lang }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $language->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content tab-bordered" id="gridTwoTabsContent">
                    @foreach ($languages as $language)
                        @php
                            $footerGridTwo = \App\Models\FooterGridTwo::where('language', $language->lang)
                                ->orderByDesc('id')
                                ->get();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}"
                            id="gridtwo-{{ $language->lang }}" role="tabpanel"
                            aria-labelledby="gridtwo-tab-{{ $language->lang }}">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="gridtwo-table-{{ $language->lang }}">
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
                                            @foreach ($footerGridTwo as $gridTwo)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $gridTwo->name }}</td>
                                                    <td>{{ $gridTwo->url }}</td>
                                                    <td>
                                                        @if ($gridTwo->status == 1)
                                                            <span class="badge badge-success">{{ __('Yes') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('No') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.footer-grid-two.edit', $gridTwo->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                                        <form
                                                            action="{{ route('admin.footer-grid-two.destroy', $gridTwo->id) }}"
                                                            method="POST" style="display:inline-block"
                                                            onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" title="Delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if ($footerGridTwo->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">
                                                        {{ __('No data found.') }}</td>
                                                </tr>
                                            @endif
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
            // Grid Two Table Init
            $('#gridtwo-table-{{ $language->lang }}').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [3, 4]
                }]
            });
        @endforeach
    </script>
@endpush
