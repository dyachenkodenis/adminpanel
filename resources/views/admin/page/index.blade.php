@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
        <!--h1 class="mt-4">Admin</h1-->
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.page.create') }}"  title="Создать страницу">
                    <button class="btn btn-primary"> Создать новую страницу</button>
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
                            <th>Статус публикации</th>                         
                            <th>Дата создания</th>                           
                             <th>Опции</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Название страницы</th>
                            <th>Статус публикации</th>                         
                            <th>Дата создания</th>                    
                            <th>Опции</th>
                        </tr>
                    </tfoot>
                    <tbody>
                         @foreach ($pages as $content)
                        <tr>
                             <td>{{ ($content->id ?? "") }}</td>
                            <td>{{ ($content->title ?? "") }}</td>
                            <td>{{ ($content->status ?? "") }}</td>  
                            <td>{{ ($content->created_at ?? "") }}</td>                         
                         
                           <td>
                             <a href="{{ route('admin.page.edit', $content->id) }}">
                                <button class="btn btn btn-primary">Редактировать</button>
                            </a>
                            <a href="{{ route('admin.page.show', $content->id) }}">
                                <button class="btn btn-secondary">Просмотреть</button>
                            </a>
                            <form action="{{ route('admin.page.destroy', $content->id) }}" method="POST" enctype="multipart/form-data">
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