@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
        <!--h1 class="mt-4">Admin</h1-->
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.menu.create') }}"  title="Создать menu">
                    <button class="btn btn-primary"> Создать новое меню</button>
                </a>
            </li>
        </ol>
       
        <div class="card mb-4">
           
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название страницы</th>
                                             
                             <th>Опции</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Название страницы</th>
                               
                            <th>Опции</th>
                        </tr>
                    </tfoot>
                    <tbody>
                         @foreach ($menu as $content)
                        <tr>
                             <td>{{ ($content->id ?? "") }}</td>
                            <td>{{ ($content->title ?? "") }}</td>
                                               
                         
                           <td>
                             <a href="{{ route('admin.menu.edit', $content->id) }}">
                                <button class="btn btn btn-primary">Редактировать</button>
                            </a>
                       
                            <form action="{{ route('admin.menu.destroy', $content->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="delete">
                                    Удалить
                                </button>
                            </form>
                           </td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@section('table_script')
<script src="/admin_panel/assets_admin/js/Chart.min.js" ></script> 
@endsection