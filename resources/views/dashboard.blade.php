<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>
    <div class="container">
            
<h1>List of Clients</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNewClient">
  Create New Client
</button>
<form action="{{ route('logout') }}" method="post">
    <button type="submit" class="btn btn-secondary text-right">Log out</button>
</form>

<div class="modal" tabindex="-1" id="createNewClient">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register New Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('createClient') }}" method="post">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" value="mateo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" value="mateo@gmail.com" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Identification</label>
            <input type="text" name="identification"  class="form-control" value="123456" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Address</label>
            <input type="text" name="address"  class="form-control" value="123456" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-success btn-block">SAVE</button>
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Identification</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Options</th>

    </tr>
  </thead>
  <tbody>
    @foreach($clients as $c)
    <tr>
      <th scope="row">{{ $c['id'] }}</th>
      <td>{{ $c['name'] }}</td> 
      <td>{{ $c['identification'] }}</td>
      <td>{{ $c['email'] }}</td>
      <td>{{ $c['address'] }}</td>
      <td>
      <form action="{{ route('deleteClient',$c['id']) }}" method="post">
            @csrf
            @method('delete')
            <a rel="tooltip" class="btn btn-success get-office-list" href="{{ route('editClient', $c['id']) }}" data-original-title="editar" title="editar">EDIT
            </a>
            <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="Eliminar" title="Eliminar" onclick="confirm('{{ __("Are yoy Sure?") }}') ? this.parentElement.submit() : ''">DELETE
            </button>
        </form>
      </td>
    </tr>
    @endforeach
   
  </tbody>
</table>

<h1>List Of Users</h1>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNewUser">
  Create New User
</button>
<br>
    <form action="" method="get">
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
        </div>
    </form>
<div class="modal" tabindex="-1" id="createNewUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('createUser') }}" method="post">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" value="mateo@gmail.com" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="text" name="password"  class="form-control" value="123456" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Role</label>
            <select class="form-control" name="role">
                <option value="">Select a Role: </option>
                <option value="1">Admin</option>
                <option value="2">Seller</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success btn-block">SAVE</button>
        </form>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $u)
    <tr>
      <th scope="row">{{ $u['id'] }}</th>
      <td>{{ $u['email'] }}</td>
      <td>{{ $u['role'] }}</td>
      <td>
        <form action="{{ route('deleteUser',$u['id']) }}" method="post">
            @csrf
            @method('delete')
            <a rel="tooltip" class="btn btn-success get-office-list" href="{{ route('editUser', $u['id']) }}" data-original-title="editar" title="editar">EDIT
            <i class="fas fa-edit" alt="Editar"></i>
            </a>
            <button type="button" rel="tooltip" class="btn btn-danger" data-original-title="Eliminar" title="Eliminar" onclick="confirm('{{ __("Are yoy Sure?") }}') ? this.parentElement.submit() : ''">DELETE

            </button>
        </form>
      </td>
    </tr>
    @endforeach
   
  </tbody>
</table>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</html>
