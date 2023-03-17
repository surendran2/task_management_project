<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Task Index Page</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New user</a>
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
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Assign Date</th>
                    <th>Completed Date</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $task->task }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if ($task->status == 1)
                        <h5 style='color:white'><span class="badge bg-danger">Pending</span></h5>
                        @elseif ($task->status == 2)
                        <h5 style='color:black'><span class="badge bg-warning">Work In Progress</span></h5>
                        @elseif ($task->status == 3)
                        <h5 style='color:white'><span class="badge bg-success">Completed</span></h5>
                        @endif
                    </td>
                    <td>{{ $task->assign_date }}</td>
                    <td>{{ $task->completed_date }}</td>

                    <td>
                        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a>

                            <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    {!! $tasks->links() !!}