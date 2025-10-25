@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Footer Grid') }}</h1>
        </div>

        <div class="card card-primary">
    <div class="card-body">
        <ul class="nav nav-tabs" id="gridThreeTabs" role="tablist">
            @foreach ($languages as $language)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                       id="gridthree-tab-{{ $language->lang }}"
                       data-toggle="tab"
                       href="#gridthree-{{ $language->lang }}"
                       role="tab"
                       aria-controls="gridthree-{{ $language->lang }}"
                       aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $language->name }}
                    </a>
                </li>
            @endforeach
        </ul>

       <div class="tab-content tab-bordered" id="gridThreeTabsContent">
            @foreach ($languages as $language)
                @php
                    $footerGridThreeTitle = \App\Models\FooterTitle::where([
                        'key' => 'grid_three_title',
                        'language' => $language->lang,
                    ])->first();
                @endphp

                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}"
                     id="gridthree-{{ $language->lang }}"
                     role="tabpanel"
                     aria-labelledby="gridthree-tab-{{ $language->lang }}">

                    <div class="card-body">
                        <form action="{{ route('admin.footer-grid-three-title') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('Footer Title') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="title"
                                       value="{{ $footerGridThreeTitle->value ?? '' }}">
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

        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Footer Grid Three') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.footer-grid-three.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create new') }}
                    </a>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2" data-toggle="tab"
                                href="#home-{{ $language->lang }}" role="tab" aria-controls="home"
                                aria-selected="true">{{ $language->name }}</a>
                        </li>
                    @endforeach

                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    @foreach ($languages as $language)
                        @php
                            $footerGridThree = \App\Models\FooterGridThree::where('language', $language->lang)
                                ->orderByDesc('id')
                                ->get();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                            id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-{{ $language->lang }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Url') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($footerGridThree as $gridThree)
                                                <tr>
                                                    <td>{{ ++$gridThree->index }}</td>
                                                    <td>{{ $gridThree->name }}</td>
                                                    <td>{{ $gridThree->url }}</td>

                                                    <td>
                                                        @if ($gridThree->status == 1)
                                                            <span class="badge badge-success">{{ __('Yes') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('No') }}</span>
                                                        @endif

                                                    </td>


                                                    <td>
                                                        <a href="{{ route('admin.footer-grid-three.edit', $gridThree->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin.footer-grid-three.destroy', $gridThree->id) }}"
                                                            class="btn  btn-danger delete-item" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach


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
            $("#table-{{ $language->lang }}").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });
        @endforeach
    </script>
@endpush
