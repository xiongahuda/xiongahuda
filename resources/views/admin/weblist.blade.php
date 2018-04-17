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
                    <a href="{{url('admin/index')}}">首页</a>
                </li>
                <li class="active"><a href="{{url('admin/webadd')}}">网页基本信息添加</a></li>
                <li class="active"><a href="{{url('admin/weblist')}}">网页基本信息列表</a></li>
            </ul><!-- .breadcrumb -->
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <button><a href="{{url('admin/activityadd')}}">添加网页</a></button>
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
                                <th>活动名称</th>
                                <th>活动简介</th>
                                <th>活动规则</th>
                                <th>活动类型</th>
                                <th>活动时间</th>
                                <th>活动状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activity as $key => $v)
                                <tr>
                                    <td class="center">
                                        <label>
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->desc}}</td>
                                    <td>{{$v->rules}}</td>
                                    <td>{{$v->type}}</td>
                                    <td>{{$v->begin_time}}~{{$v->end_time}}</td>
                                    <?php if($v->status == 1) { ?>
                                    <td>已启用</td>
                                    <?php }else{ ?>
                                    <td>未启用</td>
                                    <?php } ?>
                                    <td><a href="javascript:void(0)" class="delete" data="{{$v->id}}">删除</a> | <a href="{{url('admin/activityupdate/'.$v->id)}}" class="update">修改</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $activity->links() !!}
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
                    url:'activitydel',
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