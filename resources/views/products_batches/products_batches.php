<br><br>
<div class="container">
<table id="users_table" class="table table-bordered table-striped dataTable"  >
    <thead><tr><th>ID</th>
    <th>NAME</th>
    <th>EMAIL</th>
    <th>USER TYPE</th>
    <th>OPTIONS</th>
    </tr></thead>
    <tbody>
        @foreach($DATA as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->user_type}}</td>
        <td>
            <button class="btn btn-success">Edit</button>
            <button class='btn btn-danger'>Delete</button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</script>
<script>
//let table = new DataTable('#users_table');
$('#users_table').dataTable();
</script>