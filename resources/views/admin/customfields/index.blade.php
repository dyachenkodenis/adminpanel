@extends('admin.layouts.app')


@section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">CustomFields</h1>
            <ol class="breadcrumb mb-4 mt-4">
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.customfields.create') }}"  title="Добавить строку">
                        <button class="btn btn-primary">Add customFields</button>
                    </a>
                </li>
            </ol>
            @if(Session::has('notification'))
                <div class="alert alert-{{ Session::get('notification.alert-type') }}">
                    {{ Session::get('notification.message') }}
                </div>
            @endif
            <div class="card mb-4">

                <div class="card-body">
                    <div class="accordion">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($customfields as $content)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ "_$i" }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ "_$i" }}" aria-controls="collapse{{ "_$i" }}">
                                        {{ ($content->lang ?? "") }}
                                    </button>
                                </h2>
                                <div id="collapse{{ "_$i" }}" class="accordion-collapse collapse " aria-labelledby="heading{{ "_$i" }}">
                                    <div class="accordion-body">
                                       @php
                                       echo "<pre>";
                                       print_r($customfields->toArray());
                                       echo "</pre>";
                                       @endphp
                                    </div>
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
