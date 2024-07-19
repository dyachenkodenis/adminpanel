@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
      
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
              <a href="{{ route('admin.page.index') }}" title="Go back">Назад к списку страниц</a>
            </li>
        </ol>
       
        <div class="card mb-12">

            <div class="card-body">
                <pre>
                     {{ print_r($page->toArray(), true); }}
                </pre> 
            </div>
        </div>
    </div>
</main>

@endsection