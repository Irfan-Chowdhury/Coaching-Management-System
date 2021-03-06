<div class="table-responsive p-1">
    <table class="table table-striped table-bordered dt-responsive text-center" style="width: 100%;">
        <thead>
        <tr>
            <th>#SL</th>
            <th>Student Name</th>
            <th>Roll</th>
            <th>School</th>
            <th>SMS Mobile</th>
            <th>Student ID</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($attendances as $key => $attendance)                        
        <tr>
            <td>{{ $key+1 }}</td>
            <td class="text-left">{{$attendance->student_name}}</td>
            <td>{{$attendance->roll_no}}</td>
            <td>{{$attendance->school_name}}</td>
            <td>{{$attendance->sms_mobile}}</td>
            <td>{{$attendance->student_id}}</td>
            <td>
                Present <input type="radio" name="attendance[{{$attendance->id}}]" value="1" {{$attendance->attendance== 1 ? 'checked' : ''}}>

                Absent  <input type="radio" name="attendance[{{$attendance->id}}]" value="2" {{$attendance->attendance== 2 ? 'checked' : ''}}>
            </td>
        </tr>
        @endforeach
        @if (count($attendances)>0)
            <tr>
                <td colspan="7">
                    <button type="submit" class="btn btn-block my-btn-submit">Update Attendance</button>
                </td>
            </tr>
        @endif                        
        </tbody>
    </table>
</div>