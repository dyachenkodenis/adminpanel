@extends('admin.layouts.app')


@section('content')

<main>
    <div class="container-fluid px-4">
        <!--h1 class="mt-4">Admin</h1-->
        <ol class="breadcrumb mb-4 mt-4">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.widget.create') }}"  title="Создать страницу">
                    <button class="btn btn-primary">Создать новый виджет</button>
                </a>
            </li>
        </ol>
      
        <div class="card mb-4">
           
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                               <th>Название языка</th>
                            <th>Код языка</th> 
                             <th>Опции</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Название языка</th>
                            <th>Код языка</th> 
                            <th>Опции</th>
                        </tr>
                    </tfoot>
                    <tbody>
                         @foreach ($widgets as $content)
                        <tr>
                             <td>{{ ($content->id ?? "") }}</td>
                            <td>{{ ($content->name ?? "") }}</td>
                            <td>{{ ($content->code ?? "") }}</td>  
                                          
                         
                           <td>
                             <a href="{{ route('admin.locale.edit', $content->id) }}">
                                <button class="btn btn btn-primary">Редактировать</button>
                            </a>
                            <a href="#">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Просмотреть</button>
                            </a>
                            <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">                               
                                        <div class="modal-body">
                                            <img src="{{ ($content->thumbnail ?? "") }}" class="img-fluid" alt="">
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                    
                                    </div>
                                    </div>
                                </div>
                                </div>

                            <form action="{{ route('admin.widget.destroy', $content->id) }}" method="POST" enctype="multipart/form-data">
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