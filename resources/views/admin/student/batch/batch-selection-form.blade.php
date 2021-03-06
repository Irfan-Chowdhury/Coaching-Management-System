@extends('admin.master')

@section('title','Batch Wise Student List')

@section('main-content')
    <!--Content Start-->
<section class="container-fluid">
    <div class="row content">
        <div class="col-12 pl-0 pr-0">

            @include('admin.includes.alert')


            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">Batch Wise Student List</h4>
                </div>
            </div>

            <div class="row ml-0 mr-0">

                <div class="col">
                    <select name="class_id" class="form-control" id="classId">
                        <option value="">--Select Class--</option>
                        @foreach ($classes as $class)
                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                        @endforeach
                    </select>
                </div> 

                <div class="col">
                    <select name="student_type_id" class="form-control" id="typeId"> <!--Better if you use studentTypeId-->
                        <option value="">--Select Course--</option>
                    </select>
                </div>

                <div class="col">
                    <select name="batch_id" class="form-control" id="batchId">
                        <option value="">--Select Batch--</option>
                    </select>
                </div>
            </div>

            <hr>

            <!--After Select "Batch" then the data show in 'studentList' div-->
            <div class="row ml-0 mr-0">
                <div class="col" id="studentList">

                </div>
            </div>

        </div>
    </div>
</section>
<!--Content End-->
<br><br><br><br><br>



<style>#overlay .loader{display: none}</style>
@include('admin.includes.loader')

<script>

    //for Load 'Student Type' (Course)
    $('#classId').change(function(){
        var classId = $('#classId').val();
        if (classId) 
        {
            $('#overlay .loader').show();
            $.get("{{route('class-student-type')}}",{class_id:classId}, function (data)
            {
                $('#overlay .loader').hide(); //when the view return then loader will be off
                console.log(data);
                $('#typeId').empty().html(data);  //Better if you use "studentTypeId"
            });
        }else{
            $('#typeId').empty().html('<option>--Select Student Type--</option>');
        }
    });
    
    //for Load 'Batch' after select course (Type)
    $('#typeId').change(function(){
        var classId = $('#classId').val();
        var typeId = $(this).val();  // যেটাতে ক্লিক করলে পরেরটা লোড হবে- "this" ব্যবহার করতে হয় || Better if you use "studentTypeId"
        if (classId && typeId) 
        {
            $('#overlay .loader').show();
            $.get("{{route('class-and-type-wise-batch-list')}}",{
                class_id       :classId,
                student_type_id:typeId, //Better if you use "studentTypeId"
            }, function (data) {
                console.log(data);
                $('#batchId').empty().html(data);
                $('#overlay .loader').hide(); //when the view return then loader will be off
            });
        }
    });
    
    //for Showing Batch Wise Student List
    $('#batchId').change(function(){
        var classId = $('#classId').val();
        var typeId  = $('#typeId').val();
        var batchId = $(this).val(); //যেটাতে ক্লিক করলে পরেরটা লোড হবে- "this" ব্যবহার করতে হয় 
        if (classId && typeId && batchId) 
        {
            $('#overlay .loader').show();
            $.get("{{route('batch-wise-student-list')}}",{
                class_id:classId,
                type_id:typeId,
                batch_id:batchId,
            }, function (data) {
                console.log(data);
                $('#studentList').empty().html(data);
                $('#overlay .loader').hide(); //when the view return then loader will be off
            });
        }
    });
</script>


@endsection