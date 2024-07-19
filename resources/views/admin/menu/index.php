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
        <!--div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div-->
        <!--div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div-->
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