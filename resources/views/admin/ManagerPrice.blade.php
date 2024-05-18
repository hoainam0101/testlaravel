<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></link>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>ADD</h2>
                </div>
                <div class="pull-right mb-2">
                    <a href="javascript:void(0)" class="btn btn-success" onclick="add()">Thêm</a>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên phân tích</th>
      <th scope="col">Nhóm khách hàng</th>
      <th scope="col">Khách hàng</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Thành Tiền</th>
      <th scope="col">Ngày Tạo</th>
      <th scope="col">Trạng thái</th>
      <th scope="col">Hành Động</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($managerPrices as $data )
        <tr>
      <th scope="row">{{ $data->id }}</th>
      <td>{{ $data->name }}</td> 
      @if ($data->manager_id == $data->user_group->id)
          <td value="{{ $data->manager_id }}">{{ $data->user_group->name }}</td>
      @endif
          
      
      @if ($data->user_id == $data->user->id)
          <td value="{{ $data->user_id }}">{{ $data->user->name }}</td>
      @endif
      <td>{{ $data->quantity }}</td>
      <td>{{ $data->price }}</td>
      <td>{{ $data->created_at }}</td>
      <td>{{ $data->status? 'Đã duyệt':'Chờ duyệt' }}</td>
      <td>
        <a href="javascript:void(0)" class="btn btn-primary" onclick="edit({{ $data->id }})">Sửa</a>
        <a href="javascript:void(0)" class="btn btn-danger" onclick="del({{ $data->id }})">Xóa</a>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>





<!-- Modal -->
<div class="modal fade" id="modal-manager" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0)" id="form-manager" name="form-manager" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <div class="form-group ">
            <label class="col-sm-5 control-label">Tên Phân Tích</label>
            <div class="col-sm-12 mt-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
            </div>
        </div>

        <div class="form-group ">
            <label class="col-sm-5 control-label">Nhóm khác hàng</label>
            <div class="col-sm-12 mt-10">
                <select name="manager_id" id="manager_id">
                    <option value="">Chọn nhóm khách hàng</option>
                     @foreach ($user_groups as $user_group)
                         <option value="{{ $user_group->id }}"> {{ $user_group->name }}</option>
                     @endforeach
                </select>
            </div>
        </div>
        <div class="form-group ">
            <label class="col-sm-5 control-label">Khác hàng</label>
            <div class="col-sm-12 mt-10">
                <select name="user_id" id="user_id">
                    <option value="">Chọn khách hàng</option>
                    @foreach ($users as $user )
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group ">
            <label class="col-sm-5 control-label">Số lượng</label>
            <div class="col-sm-12 mt-10">
                <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group ">
            <label class="col-sm-5 control-label">Thành Tiền</label>
            <div class="col-sm-12 mt-10">
                <input type="text" class="form-control" name="price" id="price" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group ">
            <label class="col-sm-5 control-label">Trạng Thái</label>
            <div class="col-sm-12 mt-10">
                <input type="radio" class="form-check-input" name="status" id="status" value="0" checked> Chờ Duyệt
                <input type="radio" class="form-check-input" name="status" id="status" value="1"> Đã Duyệt
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
            <button type="submit" id="btn-save" class="btn btn-primary">Lưu</button>
      </div>

        </form>
        
    </div>
  </div>
</div>

<script type="text/javascript">

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


function add(){
    $('#form-manager').trigger("reset");
    $('#exampleModalLabel').html("Add Manager");
    $('#modal-manager').modal('show');
}

function edit(id){
    $.ajax({
        type: "PUT",
        url: "{{ url('edit') }}",
        data: {id: id},
        dataType: "json",
        success: function (response) {
            console.log(response);
            $('#exampleModalLabel').html("Edit Manager");
            $('#modal-manager').modal('show');
            $('#id').val(response.id);
            $('#name').val(response.name);
            $('#manager_id').val(response.manager_id);
            $('#user_id').val(response.user_id);
            $('#quantity').val(response.quantity);
            $('#price').val(response.price);
            $('#status').val(response.status);
        }
    });
}

function del(id){
    $.ajax({
        type: "DELETE",
        url: "{{ url('delete') }}",
        data: {id: id},
        dataType: "json",
        success: function (response) {
            console.log(response);
            location.reload();
        }
    });
}

$('#form-manager').submit(function (e) { 
    e.preventDefault();
    var form = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ url('store') }}",
        data: form,
        cache: false,
        contentType: false,
        processData: false, 
        success:  (data) => {
            console.log(data);            
        },
        error: function (data) {
            console.log(data);
        }
    });
});  
    

</script>
</body>
</html>