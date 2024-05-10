<?php include_once ROOT."/app/views/user/header.php" ?>
<div class="row">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-house"></i> Companies</a>
                <a href="#" id="transportLink" class="list-group-item list-group-item-action"><i class="fa-solid fa-truck"></i> Transport</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-warehouse"></i> Warehouses</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-regular fa-user"></i> Drivers</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-boxes-stacked"></i> Products</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="mt-4">
                <?php if ($_SESSION['user']['role'] == 1): ?>
                    <a href="#" id="createBtn" class="btn btn-primary">Create</a>
                <?php endif;?>
                <div class="container">
                <div class="row">
                <div class="mt-4 col-md-4" id="createForm" style="display: none">
                    <form action="/vehicle/create" id="create" method="post">
                        <div class="form-group row">
                            <label for="inputCreate" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <input type="text" id="type" class="form-control" name="type">
                            </div>
                            <div class="invalid-feedback">Please enter the vehicle type.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="mt-4 col-md-4" id="revisionForm" style="display: none">
                    <form action="/vehicle/revision" method="post">
                        <div class="form-group row">
                            <label for="inputRevision" class="col-sm-3 col-form-label">Revision</label>
                            <div class="col-sm-9">
                                <input type="text" id="revision" value="" class="form-control" name="revision">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-4 col-md-4" id="editForm" style="display: none">
                    <form action="/vehicle/edit" id="edit" method="post">
                        <div class="form-group row">
                            <label for="inputType" class="col-sm-3 col-form-label">Edit</label>
                            <div class="col-sm-9">
                                <input type="text" id="inputType" value="" class="form-control" name="inputType">
                                <input type="text" id="inputId" value="" class="form-control" name="inputId" hidden>
                            </div>
                            <div class="invalid-feedback">Please enter the vehicle type.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
                </div>
                </div>
            </div>
            <?php if (isset($_SESSION['vehicleDataObject']) && !empty($_SESSION['vehicleDataObject'])):?>
            <?php $vehicleData = $_SESSION['vehicleDataObject']; ?>
            <table id="vehicleTable" class="table table-bordered table-hover text-center mt-4" style="display: none">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Vehicle Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($vehicleData->getData() as $item): ?>
                <tr>
                    <td id="identifier"><?=$item['id']?></td>
                    <td id="vehicleType"><?=$item['vehicle_type']?></td>
                    <td>
                        <div class="btn-group dropleft">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item revision" href="#" id="revisionBtn"><i class="fa-regular fa-eye"></i> Revision
                                    <input type="text" value="<?php echo $item['id']; ?>" class="form-control" hidden>
                                </a>
                                <?php if ($_SESSION['user']['role'] == 1): ?>
                                <a class="dropdown-item edit" href="#" id="editBtn"><i class="fa-solid fa-pen"></i> Edit
                                    <input type="text" value="<?php echo $item['id']; ?>" class="form-control" hidden>
                                </a>
                                <a class="dropdown-item delete" href="#" id="deleteBtn"><i class="fa-solid fa-trash"></i> Delete
                                    <input type="text" value="<?php echo $item['id']; ?>" class="form-control" hidden>
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <?php endif;?>
        </div>
        </div>
    </div>
</div>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        //відображення форми додавання типу та таблиці
        $("#createBtn").click(function(){
            $("#createForm").toggle();
        });
        $("#transportLink").click(function(){
            $("#vehicleTable").toggle();
        });

        //відображення поля прегляду
        $('.revision').on('click', function(e){
            e.preventDefault();
            var row = $(this).closest('tr');
            var value = row.find('#vehicleType').text();
            $('#revision').val(value);
            if ($('#revisionForm').is(':visible')) {
                $('#revisionForm').hide();
            } else {
                $('#revisionForm').show();
            }
        });

        // метод видалення типу транспорту
        $('.delete').on('click', function(e){
            e.preventDefault();
            var row = $(this).closest('tr');
            var value = row.find('#identifier').text();
            $.ajax({
                url: "/vehicle/delete",
                method: 'POST',
                data: {id:value},
                success: function(response) {
                    if (response.trim() === '') {
                        window.location.href = '/vehicle/list';
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
        // метод відображення форми редагування типу транспорту
        $('.edit').on('click', function(e){
            e.preventDefault();
            var row = $(this).closest('tr');
            var id = row.find('#identifier').text();
            var type = row.find('#vehicleType').text();
            if ($('#editForm').is(':visible')) {
                $('#editForm').hide();
                $('#inputType').val('');
                $('#inputId').val('');
            } else {
                $('#editForm').show();
                $('#inputType').val(type);
                $('#inputId').val(id);
            }

        });
        // передача відредагованих даних на сервер
        $('#edit').submit(function(e) {
            e.preventDefault();
            var type = $('#inputType').val();
            if (type.trim() === '') {
                $('#inputType').addClass('is-invalid');
            } else {
                $('#inputType').removeClass('is-invalid');
            }
            if (type.trim() !== '') {
                $.ajax({
                    url: "/vehicle/edit",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.trim() === '') {
                            $('#inputType').val('');
                            $("#editForm").hide();
                            window.location.href = '/vehicle/list';
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error ' + error);
                    }
                });
            }
        });
        // передача даних по щойно створеного типу транспорту
        $('#create').submit(function(e) {
            e.preventDefault();
            var type = $('#type').val();
            if (type.trim() === '') {
                $('#type').addClass('is-invalid');
            } else {
                $('#type').removeClass('is-invalid');
            }
            if (type.trim() !== '') {
                $.ajax({
                    url: "/vehicle/create",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.trim() === '') {
                            $('#type').val('');
                            $("#createForm").hide();
                            window.location.href = '/vehicle/list';
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error ' + error);
                    }
                });
            }
        });
    });
</script>