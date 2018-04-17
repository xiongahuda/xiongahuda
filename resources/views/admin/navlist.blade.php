@extends('header')
@section('content')
    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home home-icon"></i>
                    <a href="{{url('admin/index')}}">导航展示</a>
                </li>
                <li class="active"><a href="{{url('admin/navadd')}}">添加导航</a></li>
                <li class="active"><a href="{{url('admin/navlist')}}">导航列表</a></li>
            </ul><!-- .breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <button><a href="{{url('admin/navadd')}}">添加导航</a></button>
                        <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="center">
                                    <label>
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>编号</th>
                                <th>导航名称</th>
                                <th>导航简介</th>
                                <th>导航链接</th>
                                <th>导航排序</th>
                                <th>状态</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($nav as $key => $v)
                                <tr>
                                    <td class="center">
                                        <label>
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->nav_name}}</td>
                                    <td>{{str_limit($v->nav_desc,10)}}</td>
                                    <td>{{$v->nav_link}}</td>
                                    <td>{{$v->nav_sort}}</td>
                                    <?php if($v->status == 1) { ?>
                                    <td>上线</td>
                                    <?php }else{ ?>
                                    <td>下线</td>
                                    <?php } ?>
                                    <td>{{$v->nav_time}}</td>
                                    <td><a href="javascript:void(0)" class="delete" data="{{$v->id}}">删除</a> | <a href="{{url('admin/navupdate/'.$v->id)}}" class="update">修改</a></td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {!! $nav->links() !!}
                    </div><!-- /.table-responsive -->
                </div><!-- /span -->
            </div><!-- /row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
    <script src="{{asset('admin/js/jquery-2.0.3.min.js')}}"></script>
    <script>
        $(function(){
            $('.delete').click(function(){
                var obj = $(this);
                var id = obj.attr('data');
                $.ajax({
                    url:'navdel',
                    type:'post',
                    data:{'id':id},
                    success:function(e){
                        if(e == 1 ){
                            alert('删除成功');
                            obj.parents('tr').remove();
                        }else{
                            alert('删除失败');
                        }
                    }
                })
            })
        })
    </script>
@stop