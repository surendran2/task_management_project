<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>To Do List Page</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('todo_lists.create') }}"> Create New ToDo List</a>
                  
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="{{ url('tasks') }}">Task Index</a>
                </div>
            </div>
        </div>
        <br />

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <table class="table table-bordered" style='text-align:center'>
            <tr>
                <th>No</th>
                <th>Work</th>
                <th>Work Type</th>
                <th>Notes</th>
                <th>Work Start Date</th>
                <th>Work End Date</th>
            </tr>
            @foreach ($toDoLists as $toDoList)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $toDoList->work }}</td>
                <td>{{ $toDoList->type }}</td>
                <td>{{ $toDoList->notes }}</td>
                <td>{{ $toDoList->start_date }}</td>
                <td>{{ $toDoList->end_date }}</td>

            </tr>
            @endforeach
        </table>
    </div>
</div>